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
use Ddeboer\DataImport\Writer\CsvWriter;
use Ddeboer\DataImport\Filter;


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

		return view('fileentries.index', compact('entries'))->with('user',$user);;
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
		$filename = Request::file('filefield');
		$file = new \SplFileObject($filename);
		$reader = new CsvReader($file);
		$reader->setStrict(false);
		$reader->setHeaderRowNumber(0); // if has header
		$columnheaders = $reader->getColumnHeaders();
 //               $csvcolumnheaders = explode(",", $columnheaders[0]);
		$csvcolumnheaders = $columnheaders;

		// store csv rows to an array
		$csvarray = [];
		foreach( $reader as $k => $row ){
			//if( $row != '' ){
				$csvarray[] = $row;
				
			//}
		}
//		print_r($csvcolumnheaders);
//		echo "<pre>";
//		print_r($csvarray);
//		echo "</pre>";exit();
		// get the headers of the imported file; returns array
		//$columnheaders = $reader->getColumnHeaders();
		//$csvcolumnheaders = explode(",", $columnheaders[0]);

		// get the column names of the selected base table
		$basetable = ucfirst($req['table']);
		$basetablemodel = User::all()->toArray();
		if( $basetable == 'Users' || $basetable == 'User'){
			$basetablemodel = User::all()->toArray();	
		}
		elseif( $basetable == 'Inventory' || $basetable == 'inventory' ){
			$basetablemodel = Inventory::all()->toArray();
		}
		elseif( $basetable == 'Fileentries' || $basetable == 'fileentry' ){
			$basetablemodel = Fileentry::all()->toArray();
		}
		// make the table field names into an array
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
		);
		$alldata['csvarray'] = $csvarray;

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

	// filentry/import
	public function importdata(){
		
		//return redirect('csvtomysqlimport');
		return view('fileentries.csvtomysqlimport');
	}

	public function get($filename){


		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('local')->get($entry->filename);

		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);

	}


	public function readfile($filename){

		// CsvReader
		$file = new \SplFileObject($filename);
		$reader = new CsvReader($file);
		$reader->setStrict(false);
		$reader->setHeaderRowNumber(0); // if has header

		// get the headers of the imported file; returns array
		$columnheaders = $reader->getColumnHeaders();
		$columnheaders = explode(',', $columnheaders[0]);


		// convert csv to array 
		$csvarray = array();
		
	}
}
