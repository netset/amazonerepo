<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   if (!function_exists('exportCSV')) {
	function exportCSV($data, $col_headers = array(),$header_colm = array(),$return_string = false)  
{  
    $stream = ($return_string) ? fopen ('php://temp/maxmemory', 'w+') : fopen ('php://output', 'w');  
    $col_headers .=  header("Content-type: text/csv");  
    $col_headers .= header("Cache-Control: no-store, no-cache");  
    if (!empty($col_headers))  
    {  
        fputcsv($stream, $col_headers);  
    }  

		fputcsv($stream,$header_colm);  
		
    foreach ($data as $record)  
    {  
        fputcsv($stream, $record);  
    }  
	
    if ($return_string)  
    {  
        rewind($stream);  
        $retVal = stream_get_contents($stream);  
        fclose($stream); 
        return $retVal;  
    }  
    else  
    {  
        fclose($stream);  
    }  
}  

}

