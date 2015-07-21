<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Csvtomysqlimport extends Model {

	/**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public static function createnew($csvfile)
    {
    	$newtable = $csvfile->filename;
  
    }
	//
	public function newtable($csvfile){
    	Schema::dropIfExists($tablename);

    	Schema::create($tablename, function($table)
		{
		    $table->increments('id');
		    foreach($fields as $field){
		    	$table->string($field, 50)->nullable();
		    }
		});

		return true;
    }

    public function saveimport($file, $tablename, $filefields){
    	
    	$databasehost = "localhost"; 
		$databasename = "chimporter"; 
		$databasetable = $tablename; 
		$databaseusername="chimporter"; 
		$databasepassword = "chimporter"; 
		$fieldseparator = ","; 
		$lineseparator = "\n";
		//$csvfile = "filename.csv";
		$csvfile = storage_path().'/app/'.$csvfilename;

		if(!file_exists($csvfile)) {
		    die("File not found. Make sure you specified the correct path.");
		}

		try {
		    $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename", 
		        $databaseusername, $databasepassword,
		        array(
		            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
		            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		        )
		    );
		} catch (PDOException $e) {
		    die("database connection failed: ".$e->getMessage());
		}

		$affectedRows = $pdo->exec("
		    LOAD DATA LOCAL INFILE ".$pdo->quote($csvfile)." INTO TABLE `$databasetable`
		      FIELDS TERMINATED BY ".$pdo->quote($fieldseparator)."
		      LINES TERMINATED BY ".$pdo->quote($lineseparator));

		echo "Loaded a total of $affectedRows records from this csv file.\n";

    }

}
