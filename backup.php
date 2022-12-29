<?php 

require 'helpers.php';
require 'config.php';

try{
    
    // create DB connection 
    $dir = dirname(__FILE__) . $backupFolder . $fileName;
  
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        // add error to log
        
        log_error("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    // create dump of DB
    exec("mysqldump --user={$user} --password={$password} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

    // create backup file from dump
    // add backup file to zip archive
    $zip = new ZipArchive();
    $zip_name = dirname(__FILE__) . '/backup-' .$fileName . '.zip';
    if($zip->open($zip_name, ZipArchive::CREATE) !== TRUE){
        log_error("cannot open <$zip_name>");
        exit("cannot open <$zip_name>");
    }

    $zip->addFile($dir, $fileName);
    $zip->close();


    // remove old backups (older than 7 days)
    $files = glob(dirname(__FILE__) . $backupFolder . '*'); // get all file names
    foreach($files as $file){ // iterate files
        // dd($files, $file, time() - filemtime($file));
        if(is_file($file) && time() - filemtime($file) >= 60*60*24*7) // if file is older than 7 days 60*60*24*7
            unlink($file); // delete file
    }

    if($hasOneDriveFolder){

        // add backup file to one drive (using onedrive local folder)
        $onedrive = dirname(__FILE__) . '/onedrive/';
        $backup = dirname(__FILE__) . '/backup-' .$fileName . '.zip';
        copy($backup, $onedrive . $fileName . '.zip');
        
        // remove backup file from server
        unlink($backup);


        // remove old backups from one drive (older than 7 days)
        $files = glob(dirname(__FILE__) . '/onedrive/*'); // get all file names
        foreach($files as $file){ // iterate files
            // dd($files, $file, time() - filemtime($file));
            if(is_file($file) && time() - filemtime($file) >= 60*60*24*7) // if file is older than 7 days
                unlink($file); // delete file
        }
    }

  
    // success message
    echo 'Backup created successfully';
    echo PHP_EOL;
    exit(1);
}catch(Exception $e){
    log_error($e->getMessage());
    die($e->getMessage());
}