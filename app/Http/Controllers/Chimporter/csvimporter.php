<?php
/**
* Here is a OOP based importer similar to the one posted earlier. However, this is slightly more flexible in that you can import huge files without running out of memory, you just have to use a limit on the get() method 
*/

/**
*Sample usage for small files:- 
*------------------------------------- 
* 
*$importer = new CsvImporter("small.txt",true); 
*$data = $importer->get(); 
*print_r($data); 
*/ 

/**
*Sample usage for large files:- 
*------------------------------------- 
*
*$importer = new CsvImporter("large.txt",true); 
*while($data = $importer->get(2000)) 
*{ 
*    print_r($data); 
*} 
*/




/**
* And heres the class:- 
* ------------------------------------- 
*/

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
        $this->lines = $lines; 

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