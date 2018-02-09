<?php

	require 'vendor/autoload.php';
	
	$mclient = new MongoDB\Client("mongodb://localhost:27017");
	//echo "Connected to DB<br>";
	
	$coll = $mclient->Traffic->Vehicle;
	//echo "Collection set<br>";
	$keys = array(
		"Vehicle",
		"Latitude",
		"Longitude",
		"Speed",
		"Bearing",
		"Address",
		"Date",
		"Time"
	);
	$data = array();
	foreach($keys as $key){
		$data[$key] = $_POST[$key];
	}
	
	$res = $coll -> insertOne($data);
	//echo "Data Inserted ",'{$res -> getInsertedId()}';
	$mclient = null;
	
?>
