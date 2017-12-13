<?php

define("TITLE","jaPRO - WebApp");
define("NAME","jaPRO");
define("VERSION","v.0.2");
define("DATABASE_ROUTE","/usr/share/nginx/html/web/japro/data.db");
define("COLOR","#ffffff,#000000");
define("LANG","EN");

set_time_limit(45); //?

class MyDB extends SQLite3 {
   function __construct() {
      $this->open(DATABASE_ROUTE, SQLITE3_OPEN_READONLY);
   }
}
$db = new MyDB();
if(!$db) {
   echo $db->lastErrorMsg();
} else {
   //echo "Opened database successfully\n";
}
   
function sql2arr2($results){ //For prepared statements that needed to be bound
  while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
      $arrayResult[]=$row;
  }
  if ($arrayResult) {
    return $arrayResult;
  } else {
    return false;
  }
}

function sql2arr($sql){
   global $db;
   $arrayResult = null;
   $results = $db->query($sql);
   while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
      $arrayResult[]=$row;
   }
   if ($arrayResult) {
      return $arrayResult;
   } else {
      return false;
   }
}

?>
