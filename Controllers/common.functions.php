<?php 
	
	/*
	include("../dbcon/dbconn.php");
	include("../dbcon/dbconn_local.php");
	include("../dbcon/dbconn_local_reservation.php");
	*/
	
	
	function getData($dbCon, $table, $dataCol,$suffix)
	{
		
		$fetchData=$dbCon->prepare("SELECT * FROM ". $table. " ".$suffix );
		$fetchData->execute();
		$dataRow = $fetchData->fetch();
		return $dataRow[$dataCol];
	}
	
	
	function countData($dbCon, $table, $suffix)
	{
		
		$sql = "SELECT count(*) FROM ".$table." ".$suffix; 
		$result = $dbCon->prepare($sql); 
		$result->execute(); 
		$number_of_rows = $result->fetchColumn();						
		if($number_of_rows>0) return true; else return false;
	}
	
	
	function giveCount($dbCon, $table, $suffix)
	{
		
		$sql = "SELECT count(*) FROM ".$table." ".$suffix; 
		$result = $dbCon->prepare($sql); 
		$result->execute(); 
		return $result->fetchColumn();
	}
	
	
	function decimalPlaces($str)
	  {
		  $transFixed="";
		  if (strpos($str,'.') !== false) 
		  $transFixed=$str;							
		  else
		  $transFixed=$str.".00";
			return $transFixed;
	  }
 
	
	function date_YMD($str)//Convert d-m-Y to Y-m-d
	 {
		 $dateARR = explode("-", $str);
		 return $dateARR[2]."-".$dateARR[1]."-".$dateARR[0];
	 }
 
 
	function date_DMY($str)//Convert Y-m-d to d-m-Y
	 {
		 $dateARR = explode("-", $str);
		 return $dateARR[2]."/".$dateARR[1]."/".$dateARR[0];
	 }
 
	
	
	
	
	
?>