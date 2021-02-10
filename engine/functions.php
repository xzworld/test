<?php

function status($i) {
  if ($i == 0) {
    return "User";
} elseif ($i == 1) {
    return "Client";
} elseif ($i == 2) {
    return "Admin";
}
}

function actual_link() {
	$act = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."";
if(strpos($act,"php") === false)	
  return $act;
    else
		return dirname($act);
}
 
function error_pdo($s) {
  global $where_i_am;
  $fp = fopen($where_i_am.'/data/logs/pdo_errors.log', 'a');
  fwrite($fp, $s . "\n");
  fclose($fp);
}

function db($query) {
  $result = array(); $z = 0;
  global $where_i_am, $db_host_adress, $db_database_name, $db_database_user, $db_database_password, $db_database_charset;
  try {
      $dsn = "mysql:host=" . $db_host_adress . ";dbname=" . $db_database_name . ";charset=".$db_database_charset."";
	  $db  = new PDO($dsn, $db_database_user, $db_database_password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  
$inst = $where_i_am . "/data/install/db.sql";	  

if(file_exists($inst))
{	
  $q = file_get_contents($inst); $z = 1;
 $rt = $db->query($q);
 $rt = null;
}
 $rt = $db->query($query);
  
 if ($rt) {
	 if(strpos($query,"select") !== false)
     $result=$rt->fetchAll();
 if($z == 1){ rename($inst, $inst.'.instaled.php');echo '</br> <h1> Первая установка!</h1>';}	 	 
 }
 else if(strpos($query,"select") !== false)
 {
// Пишем ошибки в лог, если такие будут.
error_pdo("[" .date("Y.m.d H:i:s")."]  " . __FILE__ . " Если rt! \n # $query");
  }	 
    $db = null;
	$rt = null;
  }
  catch(PDOException $e) 
  {
// Пишем ошибки в лог, если такие будут.
error_pdo("[" .date("Y.m.d H:i:s")."] " . __FILE__ . " \n # $query ". $e->getMessage());
//echo '</br><h1>Не удалось подключится к базе данных, проверьте настройки в файле: '.$where_i_am.'/data/settings.php</h1>';
//echo '</br><h1>Или серверная ошибка!</h1>';
  }
  return $result;
}

?>