<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path: log_error.php
// Compare this snippet from backup.php:

if(!function_exists('log_error')){
    function log_error($error){
        $log_file = 'error_log.txt';
        $log = fopen($log_file, 'a');
        fwrite($log, date('Y-m-d H:i:s') . ' ' . $error . PHP_EOL);
        fclose($log);
    }
}


// create dd function
if(!function_exists('dd')){
    function dd(... $data){
        // if console connection
        if(php_sapi_name() == 'cli'){
            foreach($data as $d){

                print_r(PHP_EOL);
                // add color green to output
                print_r("\033[0;32m");
                print_r($d);
                print_r("\033[0m");
                print_r(PHP_EOL);
            }

            print_r(PHP_EOL);
            die();
        }

        
        echo '<pre>';
        foreach($data as $d){
            print_r(PHP_EOL);
            print_r($d);
            print_r(PHP_EOL);
            
        }
        echo '</pre>';
        die();
    }
}