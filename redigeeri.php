<?php

echo"Tere tulemast redigeeri lehele";

if(isset($msqly)){
	die('Püüad mind häkkida');
}
	if(!isset($_SESSION["id"])){
		header("id");
	}
	if(isset($_GET["logout"])){
		//aadressireal on olemas muutuja logout
		
		//kustutame kõik session muutujad ja peatame sessiooni
		session_destroy();
		
		header("Location: login.php");
	}
?>
<p>
<a href="?logout=1"> Logi välja <a> 
</p>
 <?php
 require_once("functions.php");
 
 
		// kas kustutame
	if(isset($_GET["delete"])){
		//echo "Kustutame id ".$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id!
		delete_entry($_GET["delete"]);
	}
	//salvestan andmebaasi uuendused
	if(isset($_POST["save"])){
		
		update_entry($_POST["id"], $input['name'], $input['voit'], $input['kaotus'], $input['vslamm'], $input['ssamm'], $input['ristit']);
	}
	$keyword = "";
	$id= "";
	
	//aadressireal on keyword
	if(isset($_GET["keyword"])){
		
		//otsin
		$keyword = $_GET["keyword"];
		$data_array = get_Data($keyword,$id);
		
	}else{
		
		// küsin kõik andmed
		
		//käivitan funktsiooni
		$data_array = get_Data();
	}
	//trükin välja esimese auto
	//echo $array_of_cars[0]->id." ".$array_of_cars[0]->plate;
	
?>
<h2>Tabel</h2>

<form action="redigeeri.php" method="get" >
	<input type="search" name="keyword" value="<?=$keyword;?>" >
	<input type="submit">
</form>
<h2>Tabel</h2>
<table border=1 >
	<tr>
		<th>id</th>
		<th>Nimi</th>
		<th>Võite</th>
		<th>Kaotus</th>
		<th>Väikse slämm</th>
		<th>Suur slämm</th>
		<th>Kaks ristit</th>
		<th>Lisamis aeg</th>
		<th>Kustuta</th>
		<th>Muuda</th>
	</tr>
	<?php
	$voite ="" ;
	$kaotus ="";
	$vslamm ="";
	$ssamm ="";
	$ristit="";
	$name="";
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0; $i < count($data_array); $i++){
			
			//kasutaja tahab muuta seda rida
			//if(isset($_GET["edit"]) && $data_array[$i]->id == $_GET["edit"]){
				
				
			
				
			//}else{
				
				$voite = $voite + $data_array[$i]->voit;
				$kaotus= $kaotus + $data_array[$i]->kaotus;
				$vslamm= $vslamm + $data_array[$i]->vslamm;
				$ssamm= $ssamm + $data_array[$i]->ssamm;
				$ristit= $ristit + $data_array[$i]->ristit;
				$name=$data_array[$i]->name;
				
				
				echo "<tr>";
				echo "<td>".$data_array[$i]->id."</td>";
				echo "<td>".$data_array[$i]->name."</td>";
				echo "<td>".$data_array[$i]->voit."</td>";
				echo "<td>".$data_array[$i]->kaotus."</td>";
				echo "<td>".$data_array[$i]->vslamm."</td>";
				echo "<td>".$data_array[$i]->ssamm."</td>";
				echo "<td>".$data_array[$i]->ristit."</td>";
				echo "<td>".$data_array[$i]->aeg."</td>";
				echo "<td><a href='?delete=".$data_array[$i]->id."'>Kustuta</a></td>";
				echo "<td><a href='edit.php?edit_id=".$data_array[$i]->id."'>Muuda</a></td>";
				echo "</tr>";
				
			//}
			}
			if ($keyword){
		echo"<tr>";
		echo"<tr>";
		echo "<th colspan='10'>Tulemused kokku<th>";
		echo"</tr>";
		echo "<td>";
		echo "<td><span style='text-transform:uppercase'>".$name."</span></td>";
		echo "<td><span style='color:red' >".$voite."</span></td>";
		echo "<td><span style='color:red' >".$kaotus."</span></td>";
		echo "<td><span style='color:red' >".$vslamm."</span></td>";
		echo "<td><span style='color:red' >".$ssamm."</span></td>";
		echo "<td><span style='color:red' >".$ristit."</span></td>";
		echo"</tr>";
			}	
		

	?>




