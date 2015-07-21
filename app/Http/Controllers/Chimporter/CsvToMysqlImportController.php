<?php 

namespace App\Http\Controllers\Chimporter;

use Auth;

use DB;
use PDO;

use App\Http\Controllers\Controller;

use App\Csvtomysqlimport;
use App\Sophiosample;
use App\Allbrands;
use App\User;
use Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


use Ddeboer\DataImport\Workflow;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImport\Reader\ArrayReader;
use Ddeboer\DataImport\Writer\CsvWriter;
use Ddeboer\DataImport\Writer\PdoWriter;
use Ddeboer\DataImport\Filter;

use Ddeboer\DataImport\ItemConverter\MappingItemConverter;
use Ddeboer\DataImport\ItemConverter\CallbackItemConverter;


use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class CsvToMysqlImportController extends Controller {

	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		//
		//return view('chimporter/csvtomysql/intro');
		// displays upload form
		$user = Auth::user();
		//return view('home')->with('user',$user);
		return view('chimporter/csvtomysql/add-file')->with('user',$user);
	}

	/**
	 * Lets user add csv file to import and a base table to pair with the csv file.
	 * @return Response
	 */
	public function addFile()
	{
		//
		//return view('chimporter/csvtomysql/add-file');
		$req = Request::all();
		
		/*echo "<pre>";
		print_r($req);
		echo "</pre>";
		exit();*/

		$file = Request::file('filefield');
		if( $file !== null ){
			$extension = $file->getClientOriginalExtension();
			Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

			$entry = new Csvtomysqlimport();
			$entry->mime = $file->getClientMimeType();
			$entry->original_filename = $file->getClientOriginalName();
			$entry->filename = $file->getFilename().'.'.$extension;

			$entry->save();

			// CsvReader
			$filetoread = new \SplFileObject($file);
			$reader = new CsvReader($filetoread);
			$csvarr = $this->csvToArray($reader);
			$reader->setStrict(false);
			$reader->setHeaderRowNumber(0); // if has header


			// get the column names of the selected base table
			$basetable = ucfirst($req['table']);
			$basetablemodel = [];
			$basetablemodel = $this->getBaseTableColNames( $basetable );
			$basetablecolumnheaders = [];
			foreach( $basetablemodel[0] as $k => $col ){
				$basetablecolumnheaders[] = $k;
			}

			// foreach reader as rows, insert it to sophio table
			// parses through the first row, this will serve as the header and at the same time the table fields
			$columnheaders = $reader->getColumnHeaders();
			$csvcolumnheaders = [];
			if( $req['has_headers'] == 'yes' ){
				
				foreach( $columnheaders as $colheader ){
					if( $colheader != '' || $colheader != null ){
						$csvcolumnheaders[] = $colheader;
					}
				}
			}
			else{
				// use the selected base table as its header
				$csvcolumnheaders = $basetablecolumnheaders;
			}
			

			//
			$filetoread = storage_path().'/app/'.$file->getFilename().'.'.$extension;			
			$original_filename = $entry->original_filename;
			if( file_exists($filetoread) ){
				// saves data to table
				$importprocess = $this->importCsvDataAsNewTable($original_filename, $filetoread, $csvcolumnheaders);
			}


			// combine column headers
			$mergedcolumnheaders['csvfilecolheaders'] = $csvcolumnheaders;
			$mergedcolumnheaders['basetablecolheaders'] = $basetablecolumnheaders;
			

			$alldata = [];
			$alldata['columnheaders'] = $mergedcolumnheaders;
			$alldata['csvfile'] = array(
				'filename' => $file->getFilename().'.'.$extension,
				'filetype' => $req['file_type'],
				'basetable' => $basetable
			);
			$alldata['csvarray'] = $csvarr;

			Session::put('alldata', $alldata);

			return Redirect::to('csvtomysql/mapper')->with('csvtomysqlimportdata', $alldata);
			//return view('chimporter/csvtomysql/pair-columns')->with('csvtomysqlimportdata', $alldata);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function mapColumns()
	{
		//echo "oi";
		$all_request = Request::all();
		$all_session = Session::all();

		// all data of uploaded csv
		$all_data_from_csv_upload = $all_session['alldata']['csvarray'];

		return view('chimporter/csvtomysql/pair-columns');
		//return redirect('csvtomysqlimport');
	}

	public function pairColumns()
	{
		//echo 'asdasd';
		$all_request = Request::all();
		$all_session = Session::all();

		$compare_columns = [];
		$csvarray = [];
		if( $all_request ){
			foreach($all_request['column'] as $key => $value){
				if( $value != null || $value != '' ){
					$compare_columns[$key] = $value;
				}
			}
		}
		if( $all_session ){
			$csvarray = $all_session['alldata']['csvarray'];
		}
		/*echo "<pre>";
			print_r($compare_columns);
		echo "</pre>";
		exit();*/
		// array of fields based from base table (Sophio Smaple)
		$datamappings = $compare_columns;
		$all_data_from_csv_upload = $csvarray;
		$new_col_headers_for_csv_data = $all_data_from_csv_upload[0];
		$new_col_headers_for_csv_data_with_keys = [];
		foreach ($new_col_headers_for_csv_data as $key => $value) {
			# code...
			$new_col_headers_for_csv_data_with_keys[ $value ] = $key;
			//$datamappings[]
		}
		/*echo "<pre>";
			print_r($new_col_headers_for_csv_data_with_keys);
		echo "</pre>";
		exit();*/
		//$datamappings[]

		// process the mapped data
		$mapped_table_csv_values = []; // this will hold the mapped data;
		$lent = count($all_data_from_csv_upload);
		foreach($all_data_from_csv_upload as $k => $all_data_from_csv_upload_row){
			if( $k !== 0 ){
				
				foreach( $datamappings as $key => $value ){

					//$converter->addMapping( $key, $all_data_from_csv_upload_row[$value]);
					//$askey = in_array($value, $new_col_headers_for_csv_data);
					//$asd = array_key_exists($, search)
					if( in_array($value, $new_col_headers_for_csv_data) ){
						$askey = $new_col_headers_for_csv_data_with_keys[$value];
						if( isset($all_data_from_csv_upload_row[$askey]) && $all_data_from_csv_upload_row[$askey] !== null ){
							$mapped_table_csv_values[$k][$key] = $all_data_from_csv_upload_row[$askey];
						}
						else{
							$mapped_table_csv_values[$k][$key] = 'NODATA';
						}
						
					}
				}
			}
			// $mapped_table_csv_values[] = $mapped_table_csv_values;
			/*echo "<pre>";
			print_r($mapped_table_csv_values);
			echo "</pre>";*/
			
		}
		/*echo "l--: ". $lent;
		echo "<pre>";
			print_r($mapped_table_csv_values);
			echo "</pre>";*/
		/*echo "<pre>";
			print_r($mapped_table_csv_values);
			echo "</pre>";
		echo "<pre>";
			print_r($datamappings);
		echo '</pre>';
		echo "<pre>";
			print_r( $new_col_headers_for_csv_data_with_keys );
		echo "</pre>";*/ 


		$alldata['mapped_table_csv_values'] = $mapped_table_csv_values;
		$alldata['basetable'] = $_POST['_basetable'];
		$alldata['csvfilename'] = $_POST['_csvfilename'];
		return view('chimporter/csvtomysql/data-tables-result')->with('mapped_data', $alldata);
		//return Redirect::to('csvtomysql/importdata')->with('mapped_data', $alldata);		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	
	public function importData()
	{
		
		//
		//return view('chimporter/csvtomysql/data-tables-result');
		//$importdata_session = Session::get('csvtomysql');
		$allrequest = Request::all();

		print_r( $allrequest );exit();
	    $paired_columns = $_POST['column'];
	    $post_alldata = json_decode( $_POST['alldata'] );
	    //$csvfile = $post_alldata->csvfile->;
	    //$csvfilename = $csvfile;
	    $uploaded_path = storage_path().'/app/'.$post_alldata->csvfile->filename;
	    $uploaded_file = File::get( $uploaded_path );
	    $filetoread = new \SplFileObject($uploaded_path);
		$reader = new CsvReader($filetoread);
		$reader->setStrict(false);
		$reader->setHeaderRowNumber(0);
		
	    $csvtoarraydata = $this->csvToArray($reader, $paired_columns);
	    
	    $alldata = array(
	    	'csvtoarraydata' => $csvtoarraydata,
	    	'reader'		=> $reader,
	    	'paired_columns' => $paired_columns
	    );

		return view('chimporter/csvtomysql/data-tables-result')->with('importedcsvdata', $alldata);
	}

	/**
	 * Accepts table name and returns its headers
	 *
	 * @param  $basetablename str
	 * @return Response
	 */
	public function csvToArray($reader){
		$csv_arr = [];
		foreach( $reader as $k => $row ){
				$csv_arr[] = $row;
		}

		return $csv_arr;
	}

	/**
	 * Accepts table name and returns its headers
	 *
	 * @param  $basetablename str
	 * @return Response
	 */
	public function getBaseTableColNames( $basetablename ){
		// get the column names of the selected base table
		switch ($basetablename) {
			case 'Sophiosample':
				# code...
				$basetablemodel = Sophiosample::get()->toArray();
				break;
			case 'Allbrands':
				# code...
				$basetablemodel = Allbrands::get()->toArray();
				break;
			default:
				# code...
				$basetablemodel = Sophiosample::get()->toArray();
				break;
		}
		return $basetablemodel;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($mappings, $tablename)
	{
		// process here

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
     * Creates TABLe for each csv import.
     *
     * @return Response
     */
    public function importCsvDataToExistingTable($csvfilename, $existingtablename)
    {
		$databasehost = "localhost"; 
		$databasename = "chimporter"; 
		$databasetable = $existingtablename; 
		$databaseusername="root"; 
		$databasepassword = "asd123"; 
		$fieldseparator = ","; 
		$lineseparator = "\n";
		//$csvfile = "filename.csv";
		//$csvfile = storage_path().'/app/'.$csvfilename;
		$csvfile  = $csvfilename;

		if(!file_exists($csvfile) && !is_writable($csvfile)) {
		    die("File not found. Make sure you specified the correct path.");
		}

		try {
		    $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename", 
		        $databaseusername, $databasepassword,
		        array(
		            //PDO::MYSQL_ATTR_LOCAL_INFILE => true,
		            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		        )
		    );
		} catch (PDOException $e) {
		    die("database connection failed: ".$e->getMessage());
		}

		$affectedRows = $pdo->exec("
		    LOAD DATA INFILE ".$pdo->quote($csvfile)." INTO TABLE `$databasetable`
		      FIELDS TERMINATED BY ".$pdo->quote($fieldseparator)."
		      LINES TERMINATED BY ".$pdo->quote($lineseparator));

		echo "Loaded a total of $affectedRows records from this csv file.\n";
    }


    /**
	* 
	* creates table and inserts data for every new csv upload
	*/
	public function importCsvDataAsNewTable($newtable, $uploadedfile, $csvcolumnheaders){
		$newtable = 'new_tbl_'.(string)$newtable;
		$newtable = str_replace('.', '_', $newtable);
		$fields = '';
		$vals = '';
		$newtablefields = '';
		foreach ($csvcolumnheaders as $key => $value) {
			$value = (string)$value;
			$newval = str_replace(' ', '', $value);
			$newval = str_replace('#', 'num', $value);
			$newval = strtolower($newval);
			$pos_date = strpos($newval, 'date');
			$pos_dec = strpos($newval, 'price');
			$pos_num = strpos($newval, 'num');
			$pos_salary = strpos($newval, 'salary');
			
			# code...
			
			if( $pos_date !== false ){
				$newtablefields .= ', `'.$newval.'` TIMESTAMP';
			}
			elseif( $pos_dec !== false || $pos_salary !== false ){
				$newtablefields .= ', `'.$newval.'` DECIMAL(10, 2)';
			}
			elseif( $pos_num !== false ){
				$newtablefields .= ', `'.$newval.'` INT';
			}
			else{
				$newtablefields .= ', `'.$newval.'` VARCHAR(255)';	
			}

			// 
			if( $key == 0 ){
				$fields .= $newval;
				$vals .= '?';
			}
			else{
				$fields .= ', '.$newval;
				$vals .= ', ?';
			}
		}

		
		// process here
		$pdo = new PDO('mysql:host=localhost;dbname=chimporter', 'chimporter', 'chimporter');
		try {
		    $pdo = new PDO("mysql:host=localhost;dbname=chimporter", 
		        'chimporter', 'chimporter',
		        array(
		            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		        )
		    );
		    $pdo->query('CREATE TABLE IF NOT EXISTS '.$newtable.' (id INT AUTO_INCREMENT PRIMARY KEY '.$newtablefields.')');

		    // after creating the table, calls another method
		    $this->importCsvDataToExistingTable($uploadedfile, $newtable);

		} catch (PDOException $e) {
		    die("database connection failed: ".$e->getMessage());
		}	
	}

	/*public function csvExportAction(){
        $conn = $this->get('database_connection');

        $stmt = $conn->prepare('SELECT * FROM test');
        $stmt->execute();

        $response = new StreamedResponse();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv');
        $response->setCallback(function() use($stmt) {
            $config = new ExporterConfig();
            $exporter = new Exporter($config);

            $exporter->export('php://output', new PdoCollection($stmt->getIterator()));
        });
        $response->send();

        return $response;
    }*/




}

class CsvImporter 
{ 
    private $fp; 
    private $parse_header; 
    private $header; 
    private $delimiter; 
    private $length; 
    //-------------------------------------------------------------------- 
    function __construct($file_name, $parse_header=false, $delimiter="\t", $length=8000) 
    { 
        $this->fp = fopen($file_name, "r"); 
        $this->parse_header = $parse_header; 
        $this->delimiter = $delimiter; 
        $this->length = $length; 
        //$this->lines = $lines; 

        if ($this->parse_header) 
        { 
           $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
        } 

    } 
    //-------------------------------------------------------------------- 
    function __destruct() 
    { 
        if ($this->fp) 
        { 
            fclose($this->fp); 
        } 
    } 
    //-------------------------------------------------------------------- 
    function get($max_lines=0) 
    { 
        //if $max_lines is set to 0, then get all the data 

        $data = array(); 

        if ($max_lines > 0) 
            $line_count = 0; 
        else 
            $line_count = -1; // so loop limit is ignored 

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) 
        { 
            if ($this->parse_header) 
            { 
                foreach ($this->header as $i => $heading_i) 
                { 
                    $row_new[$heading_i] = $row[$i]; 
                } 
                $data[] = $row_new; 
            } 
            else 
            { 
                $data[] = $row; 
            } 

            if ($max_lines > 0) 
                $line_count++; 
        } 
        return $data;
    } 
    //-------------------------------------------------------------------- 

}




