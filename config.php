
<?php

// Path: config.php
// this file contains all the configuration for the backup script

$host = "localhost";  // host name
$user = "root";      // user name
$password = "";     // password
$database = "test"; // database name
$backupFolder =  '/backups/'; // backup folder name
$hasOneDriveFolder = true; // if you have a onedrive folder to save the backup file
$fileName = $database .'-' . date('Y-m-d').'-'. time() . '.sql';
