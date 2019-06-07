<?php

  class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('data/zftutorial.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }
   
   
   $sql = "SELECT * FROM `album`  limit 3 , 1   " ;
   
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "ID = ". $row['id'] . "\n<br>";
      echo "NAME = ". $row['title'] ."\n<br>";
      echo "ADDRESS = ". $row['artist'] ."\n<br>";
    }
    
   
   
   
   
   
   
   $db->close();

 