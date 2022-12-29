# PHP Pure Script for Auto Backup MySQL DB

This script allow you to doing Auto backup to your MySQL DB.

I run it as a cron job on Windows/Ubuntu servers to make sure we have a latest version of DB daily.

# Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## 1.1 Prerequisites

You need to have PHP installed on your machine.

## 1.2 Installing

1. Clone this repo
2. Open `config.php` file
3. Edit the following variables to match your DB information and backup folder path:

```php
$host = "localhost";  // host name
$user = "root";      // user name
$password = "";     // password
$database = "test"; // database name
$backupFolder =  '/backups/'; // backup folder name
$hasOneDriveFolder = true; // if you have a onedrive folder to save the backup file
$fileName = $database .'-' . date('Y-m-d').'-'. time() . '.sql';
```



## 1.3 How to use

You can run it with below command:

    php backup.php




## 1.4 How to setup cron job on Windows


![image](https://user-images.githubusercontent.com/21352835/209930065-56d23560-4f6a-4ac4-8ef5-bb8011ec0914.png)


You can setup cron job on Windows using schedual with below steps:

1. Open Task Scheduler
2. Click Create a Basic Task
3. Enter a name for the task
4. Select "Run whether user is logged on or not"
5. Check "Run with highest privileges"
6. Click on "Triggers"
7. Click New
8. Select "Daily"
9. Click OK
10. Click on "Actions"
11. Click New
12. Select "Start a program"
13. Enter the path to php.exe in the "Program/script" field
14. Enter the path to backup.php in the "Add arguments" field
15. Click OK


## 1.5 How to setup cron job on Ubuntu

You can setup cron job on Ubuntu using crontab with below steps:

1. Open terminal
2. Run crontab
        
        crontab -e

3. Add the following line to the end of the file:

        0 0 * * * php /path/to/backup.php


4. Save and exit




# License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
