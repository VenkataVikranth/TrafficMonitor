<?php

	require 'vendor/autoload.php';
	require_once "PHPExcel/Classes/PHPExcel.php";
	
	$mclient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	echo "Connected to DB<br>";
	
	//$coll = $mclient->Traffic->Vehicle;
	echo "Collection set<br>";
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
	
	$phpExcel = new PHPExcel();
	$phpExcel->setActiveSheetIndex(0);
	
	$i = 65;
	foreach($keys as $key){
		$phpExcel->getActiveSheet()->SetCellValue(chr($i++)."1", $key);
		echo $key, "<br>";
	}
	$query = new MongoDB\Driver\Query(['Date' => '2018-02-07']);
	$result = $mclient->executeQuery('Traffic.Vehicle', $query);
	$i = 2;
	foreach ($result as $entity){
		$entry = json_decode(json_encode($entity), true);
		//echo $entry['_id'], "<br>";
		/*echo "<br>Vehicle : ", $entry['Vehicle'], "<br>"
			."Latitude : ", $entry['Latitude'], "<br>"
			."Longitude : ", $entry['Longitude'], "<br>"
			."Speed : ", $entry['Speed'], "<br>"
			."Bearing : ", $entry['Bearing'], "<br>"
			."Altitde : ", $entry['Altitude'], "<br>"
			."Accuracy : ", $entry['Accuracy'], "<br>"
			."Time : ", $entry['Time'], "<br>";
			$i += 1;
		
		/*print_r($entry);
		echo "<br><br><br>";*/
		echo "<br>";
		$j = 65;
		foreach($keys as $key){
			echo $key, " : ", $entry[$key],"<br>";
			$phpExcel->getActiveSheet()->SetCellValue(chr($j++).$i, $entry[$key]);
		}
		$i++;
	}
	for($i = 65; $i<73; $i++){
		$phpExcel->getActiveSheet()->getColumnDimension(chr($i))->setAutoSize(true);
	}
	//echo $i;
	
	$objWriter = new PHPExcel_Writer_Excel2007($phpExcel);
	//$date = date("Y-m-d H:i:s");
	//$date = explode(" ", $date);
	$objWriter->save("AddressDataToday.xlsx");
	
    
?>