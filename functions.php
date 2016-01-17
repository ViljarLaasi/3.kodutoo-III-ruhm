<?php
require_once("../config.php");
function delete_entry($id){
		
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 
			$stmt = $mysqli->prepare("UPDATE users2 SET del=NOW() WHERE ID=?");
			if(!$stmt){
					die("juhtus viga delete_entry".$mysqli->error);
			}
			$stmt->bind_param("i", $id);
			if($stmt->execute()){	
			header("Location: redigeeri.php");
		}
			$stmt->close();
		$mysqli->close();
}
		
function update_entry($id, $name, $voit, $kaotus, $vslamm, $ssamm, $ristit){
	
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 
		
		$stmt = $mysqli->prepare("UPDATE users2 SET name=?, voit=?, kaotus=?, vslamm=?, ssamm=?, ristit=?, time=now() WHERE ID=?");
		if(!$stmt){
			die("juhtus viga update_entry".$mysqli->error);
		}
		$stmt->bind_param("ssssss", $input['name'], $input['voit'], $input['kaotus'], $input['vslamm'], $input['ssamm'], $input['ristit']);
		if($stmt->execute()){
			header("Location: redigeeri.php");
		}
			$stmt->close();
		$mysqli->close();
}
		
function get_Data($keyword=""){
		$search = "%%";
		//kas otsisõna on tühi
		//if($keyword == ""){
			//ei otsi midagi
			//echo "Ei otsi";
		//}else{
			//otsin
			//echo "Otsin ".$keyword;
			$search = "%".$keyword."%";
		
		
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 				
		$stmt = $mysqli->prepare("SELECT ID, name, voit, kaotus, vslamm, ssamm, ristit, time from users2 WHERE del IS NULL AND name LIKE ?  ");
		if(!$stmt){
			die("juhtus viga get_Data".$mysqli->error);
		}
		$stmt->bind_param("s", $search);
		$stmt->bind_result($id, $name, $voit, $kaotus, $vslamm, $ssamm, $ristit, $aeg);
		$stmt->execute();
		
		// tekitan tühja massiivi, kus edaspidi hoian objekte
		$data_array = array();
		
		//tee midagi seni, kuni saame ab'ist ühe rea andmeid
		while($stmt->fetch()){
			// seda siin sees tehakse 
			// nii mitu korda kui on ridu
			// tekitan objekti, kus hakkan hoidma väärtusi
			$data = new StdClass();
			$data->id = $id;
			$data->name = $name;
			$data->voit = $voit;
			$data->kaotus = $kaotus;
			$data->vslamm = $vslamm;
			$data->ssamm = $ssamm;
			$data->ristit = $ristit;
			$data->aeg = $aeg;
		
			//lisan massiivi ühe rea juurde
			array_push($data_array, $data);
		}
		//tagastan massiivi, kus kõik read sees
		return $data_array;
			$stmt->close();
		$mysqli->close();
}
function getEditData($id){
		
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ;
		
		$stmt = $mysqli->prepare("SELECT name, voit, kaotus, vslamm, ssamm, ristit from users2 WHERE ID=? AND del IS NULL");
		$stmt->bind_param("i",$id);
		$stmt->bind_result($name, $voit, $kaotus, $vslamm, $ssamm, $ristit);
		$stmt->execute();
		
		//object
		$data = new StdClass();
		
		// kas sain ühe rea andmeid kätte
		//$stmt->fetch() annab ühe rea andmeid
		if($stmt->fetch()){
			//sain
			$data->name = $name;
			$data->voit = $voit;
			$data->kaotus = $kaotus;
			$data->vslamm = $vslamm;
			$data->ssamm = $ssamm;
			$data->ristit = $ristit;
			
			
		}else{
			// ei saanud
			// id ei olnud olemas, id=123123123
			// rida on kustutatud, deleted ei ole NULL
			header("Location: redigeeri.php");
		}
		
		return $data;
		
		
		$stmt->close();
		$mysqli->close();
		
	}
function update_data($id, $name, $voit, $kaotus, $vslamm, $ssamm, $ristit){
		
		
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ;
		$stmt = $mysqli->prepare("UPDATE users2 SET name=?, voit=?, kaotus=?, vslamm=?, ssamm=?, ristit=?, time=now() WHERE id=? ");
		if(!$stmt){
			die("juhtus viga get_Data".$mysqli->error);
		}
		$stmt->bind_param("ssssssi", $name, $voit, $kaotus, $vslamm, $ssamm, $ristit, $id);
		if($stmt->execute()){
			// sai uuendatud
			// kustutame aadressirea tühjaks
			header("Location: redigeeri.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
	}
?>