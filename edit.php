<?php
require_once("functions.php");

if(isset($_POST["update_plate"])){
		// vajutas salvesta nuppu
		// numberplate ja color tulevad vormist
		// aga id varjatud väljast
		update_data($_POST["id"], $_POST["name"], $_POST["voit"], $_POST["kaotus"], $_POST["vslamm"],$_POST["ssamm"],$_POST["ristit"]);
	}
 	
if(isset($_GET["edit_id"])){
		//echo $_GET["edit_id"];
		
		// id oli aadressireal
		// tahaks ühte rida kõige uuemaid andmeid kus id on $_GET["edit_id"]
		
		$data = getEditData($_GET["edit_id"]);
		//var_dump($data);
		
		
	}else{
		// ei olnud aadressireal 
		echo "VIGA";
		// die - edasi lehte ei laeta
		//die();
		
		header("Location: redigeeri.php");
		
	}





?>
</table>
<h2>Muuda Andmeid</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["edit_id"];?>">
	<label for="name" >Nimi</label><br>
	<input id="name" name="name" type="text" value="<?=$data->name;?>"><br><br>
	<label for="voit">Värv</label><br>
	<input id="voit" name="voit" type="text" value="<?=$data->voit;?>"><br><br>
	<label for="kaotus">Kaotus</label><br>
	<input id="kaotus" name="kaotus" type="text" value="<?=$data->kaotus;?>"><br><br>
	<label for="vslamm">väike slämm</label><br>
	<input id="vslamm" name="vslamm" type="text" value="<?=$data->vslamm;?>"><br><br>
	<label for="ssamm">Suur slämm</label><br>
	<input id="ssamm" name="ssamm" type="text" value="<?=$data->ssamm;?>"><br><br>
	<label for="ristit">Kaks ristit</label><br>
	<input id="ristit" name="ristit" type="text" value="<?=$data->ristit;?>"><br><br>
	<input type="submit" name="update_plate" value="Salvesta">
</form>