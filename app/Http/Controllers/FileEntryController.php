<?php 

namespace App\Http\Controllers;

use Auth;

use App\Http\Controllers\Controller;
use App\Fileentry;
use App\User;
use App\Inventory;
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
use Ddeboer\DataImport\Writer\AbstractStreamWriter;


class FileEntryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
            
		$entries = Fileentry::all();

		return view('fileentries.index', compact('entries'))->with('user',$user);
	}

	
		
	// pair columns
	public function pair()
	{
		$req = Request::all();
		
		return view('fileentries.paircolumns', compact('columns'));
	}

	// upload csv file and choose base table
	public function add() {
		
		$req = Request::all();
		
		$file = Request::file('filefield');
		if( $file !== null ){
			$extension = $file->getClientOriginalExtension();
			Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
			$entry = new Fileentry();
			$entry->mime = $file->getClientMimeType();
			$entry->original_filename = $file->getClientOriginalName();
			$entry->filename = $file->getFilename().'.'.$extension;

			$entry->save();

			// CsvReader
			$filetoread = new \SplFileObject($file);
			$reader = new CsvReader($filetoread);
			$reader->setStrict(false);
			$reader->setHeaderRowNumber(0); // if has header
			$columnheaders = $reader->getColumnHeaders();
			$csvcolumnheaders = [];
			foreach( $columnheaders as $colheader ){
				if( $colheader != '' || $colheader != null ){
					$csvcolumnheaders[] = $colheader;
				}
			}
	//		echo "<pre>"; print_r( $csvcolumnheaders ); echo "</pre>"; exit();
			// store csv rows to an array
			/*$csvarray = [];
			foreach( $reader as $k => $row ){
				//if( $row != '' ){
					$csvarray[] = $row;
					
				//}
			}*/
	//		print_r($csvcolumnheaders);
	//		echo "<pre>";
	//		print_r($csvarray);
	//		echo "</pre>";exit();
			// get the headers of the imported file; returns array
			//$columnheaders = $reader->getColumnHeaders();
			//$csvcolumnheaders = explode(",", $columnheaders[0]);

			// get the column names of the selected base table
			$basetable = ucfirst($req['table']);
			$basetablemodel = [];
			$basetablemodel = $this->getBaseTableColNames( $basetable );
			$basetablecolumnheaders = [];
			foreach( $basetablemodel[0] as $k => $col ){
				$basetablecolumnheaders[] = $k;
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
			//$alldata['csvarray'] = $csvarray;

			Session::put('alldata', $alldata);
			
			return Redirect::to('paircolumns')->with('csvtomysql', $alldata);

		}
		
		
	}

	// filentry/pair
	public function paircolumns(){
		$req = Request::all();


		// verify if alldata has been put to session
		if( Session::has('csvtomysql') ){
			$alldata = Session::get('csvtomysql');
		}
		else{
			$alldata = Session::get('alldata');
		}

		return view('fileentries.paircolumns');
		//return redirect('csvtomysqlimport');
	}
	// returns an array result from a csvreader input
	public function csvToArray($reader, $paired_columns){
		$csv_arr = [];
		//print_r( $reader );print_r( $paired_columns );
		//foreach( $paired_columns as $k => $paired_column ){
			//$arr =[];
		foreach( $reader as $kk => $val ){
			$arr = [];
			foreach($paired_columns as $k => $paired_column){
				$arr[$k] = $val[$paired_column] ? $val[$paired_column] : '';

			}
			// /Inventory::insert(());
			Inventory::insert(
				array('linecode' => $arr['linecode']),
				array('sku' => $arr['sku']),
				array('descript' => $arr['descript']),
				array('cost' => $arr['cost']),
				array('coreprice' => $arr['coreprice']),
				array('minqty' => $arr['minqty']),
				array('qtyavail' => $arr['qtyavail'])
				
			);
			//Inventory::insert( array($arr));
			//Inventory::disableQueryLog();
			$csv_arr[] = $arr;
		}
		$reader = new ArrayReader($csv_arr);
			
		return $csv_arr;
	}

	

	public function getBaseTableColNames( $basetablename ){
		// get the column names of the selected base table
		//$basetable = ucfirst($basetablename);
		///basetablemodel = Inventory::all()->toArray(); //default
		switch ($basetablename) {
			case 'User':
				# code...
				$basetablemodel = Inventory::get(array('linecode','sku','descript','cost','coreprice','minqty','qtyavail'))->toArray();
				break;
			case 'Inventory':
				# code...
				$basetablemodel = Inventory::get(array('linecode','sku','descript','cost','coreprice','minqty','qtyavail'))->toArray();
				break;
			case 'Fileentry':
				# code...
				$basetablemodel = Inventory::get(array('linecode','sku','descript','cost','coreprice','minqty','qtyavail'))->toArray();
				break;
			default:
				# code...
				$basetablemodel = Inventory::get(array('linecode','sku','descript','cost','coreprice','minqty','qtyavail'))->toArray();
				break;
		}
		return $basetablemodel;
	}

	// filentry/import
	public function importdata(){
		


		$importdata_session = Session::get('csvtomysql');
		$allrequest = Request::all();
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

		//return redirect('csvtomysqlimport');
		//return view('fileentries.csvtomysqlimport');
		/*return Redirect::to('csvtomysqlimport')->with('importedcsvdata', $csvtoarraydata);*/
		return view('fileentries.csvtomysqlimport')->with('importedcsvdata', $alldata);
	}

	public function get($filename){


		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('local')->get($entry->filename);

		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);

	}
}
