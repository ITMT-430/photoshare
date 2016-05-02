<?php
/**
 * Created by PhpStorm.
 * User: Marilyn
 * Date: 4/24/2016
 * Time: 12:01 AM
 */

   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'photoshare_430');
   global $db;
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
