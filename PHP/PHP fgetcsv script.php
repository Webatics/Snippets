<?php

$databasehost = "localhost";
$databasename = "test";
$databasetable = "db_name";
$databaseusername ="Antonoffplusdotcom";
$databasepassword = "";
$fieldseparator = "~";
$csvfile = "test.csv";

$con = mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
mysql_select_db($databasename) or die(mysql_error());

if(!file_exists($csvfile)) {
    echo "File not found. Make sure you specified the correct path.\n";
    exit;
}

if (($handler = fopen($csvfile, "r")) !== false) {
	while (($data = fgetcsv($handler, 0, $fieldseparator)) !== false) {
		$element = "INSERT INTO {$databasetable} (material_code, description, pick_location, value, quantity, category_manager, stock_controller, supplier) VALUES (";
		$element .= "{$data[0]}, ";
		$element .= "'".mysql_real_escape_string($data[1]) ."', ";
		$element .= "'".mysql_real_escape_string($data[2]) ."', ";
		$element .= "'".mysql_real_escape_string($data[3]) ."', ";
		$element .= "{$data[4]}, ";
		$element .= "'".mysql_real_escape_string($data[5]) ."', ";
		$element .= "'".mysql_real_escape_string($data[6]) ."', ";
		$element .= "'".mysql_real_escape_string($data[7]) ."'";
	
		$element .= ")";
		
		mysql_query($element);
		print_r($data);
	}
}

fclose($handler);

?>
