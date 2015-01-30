<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('create_pdf')) {

    function create_pdf($html_data, $file_name = "") {
        if ($file_name == "") {
            $file_name = 'report' . date('dMY');
        }
        require 'mpdf/mpdf.php';
        $mypdf = new mPDF();
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_name . 'pdf', 'D');
    }

}
if (!function_exists('create_store_pdf')) {

    function create_store_pdf($html_data, $file_name = "") {
        if ($file_name == "") {
            $file_name = 'report' . date('dMY');
        }
        require 'mpdf/mpdf.php';
        $mypdf = new mPDF();
        $mypdf->WriteHTML($html_data);
	$config=$_SERVER['DOCUMENT_ROOT']."/savaria/public/uploads/";
        $mypdf->Output($config.$file_name.".pdf",'F');
    }

}