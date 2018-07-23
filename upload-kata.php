<?php 

$data_to_write = $_POST['str'];

if ( !file_exists("text") )
    mkdir("text");

$file_handle = fopen('kata-kata.txt', 'a+'); 
fwrite($file_handle, $data_to_write.'<br/>');
fclose($file_handle);

 ?>