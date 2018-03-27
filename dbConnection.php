<?php

    function getDB(){
	require 'vendor/autoload.php';	
	$mclient = new MongoDB\Client("mongodb://localhost:27017");
	return $mclient -> TrafficData;
    }
    $baseURL = "http://localhost:8081/Trafficmonitor/";