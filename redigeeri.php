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
		echo "Kustutame id ".$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id!
		delete_entry($_GET["delete"]);
	}
	//salvestan andmebaasi uuendused
	if(isset($_POST["save"])){
		
		update_entry($_POST["id"], $input['name'], $input['voit'], $input['kaotus'], $input['vslamm'], $input['ssamm'], $input['ristit']);
	}
$keyword = "";
	
	//aadressireal on keyword
	if(isset($_GET["keyword"])){
		
		//otsin
		$keyword = $_GET["keyword"];
		$data_array = get_Data($keyword);
		
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
		<th>Kustuta</th>
		<th>Muuda</th>
	</tr>
	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0; $i < count($data_array); $i++){
			
			//kasutaja tahab muuta seda rida
			if(isset($_GET["edit"]) && $data_array[$i]->id == $_GET["edit"]){
				
				echo "<tr>";
				echo "<form action='redigeeri.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$data_array[$i]->id."'>";
				echo "<td><input name='name' value='".$data_array[$i]->name."'></td>";
				echo "<td><input name='voit' value='".$data_array[$i]->voit."'></td>";
				echo "<td><input name='kaotus' value='".$data_array[$i]->kaotus."'></td>";
				echo "<td><input name='vslamm' value='".$data_array[$i]->vslamm."'></td>";
				echo "<td><input name='ssamm' value='".$data_array[$i]->ssamm."'></td>";
				echo "<td><input name='ristit' value='".$data_array[$i]->ristit."'></td>";
				echo "<td><a href='redigeeri.php'>cancel</a></td>";
				echo "<td><input type='submit' name='save'></td>";
				echo "</form>";
				echo "</tr>";
				
			}else{
				
				echo "<tr>";
				echo "<td>".$data_array[$i]->id."</td>";
				echo "<td>".$data_array[$i]->name."</td>";
				echo "<td>".$data_array[$i]->voit."</td>";
				echo "<td>".$data_array[$i]->kaotus."</td>";
				echo "<td>".$data_array[$i]->vslamm."</td>";
				echo "<td>".$data_array[$i]->ssamm."</td>";
				echo "<td>".$data_array[$i]->ristit."</td>";
				echo "<td><a href='?delete=".$data_array[$i]->id."'>Kustuta</a></td>";
				echo "<td><a href='edit.php?edit_id=".$data_array[$i]->id."'>Muuda</a></td>";
				echo "</tr>";
				
			}
			
		}
	
	
	?>




