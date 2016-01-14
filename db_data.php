<?php
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


$errors = array();
$input = array();
$show_form = False ; 
if($_SERVER["REQUEST_METHOD"] == "POST") {
	//defineerime array ja käime kogu tsükli läbi muutujan fild for loop.
	foreach(array('name','voit', 'kaotus','vslamm','ssamm','ristit') as $field){
	
			if ( empty($_POST['name'])) { 
				
				$errors[$field] = "See väli on kohustuslik";
				
			}else{
		
				$input[$field] = cleanInput($_POST[$field]);
			}
		}
		if(empty($errors)){
			
					//Salvestame AB'i
					$stmt = $mysqli->prepare("INSERT INTO users2 (name, voit, kaotus, vslamm, ssamm, ristit) VALUES (?,?,?,?,?,?)");
					if(!$stmt){
					die("juhtus viga".$mysqli->error);
				}
					$stmt->bind_param("ssssss", $input['name'], $input['voit'], $input['kaotus'], $input['vslamm'], $input['ssamm'], $input['ristit']);
					$stmt->execute();
					$stmt->close();
				$_SESSION['lisa']=True;
				$show_form = True ;
				
				
			
			
		}
		
	}
	?>
	
	<html>
<head>
<meta charset="UTF-8">
  <title>Mängude andmebaas</title>
</head>
<body>
	<?php if($show_form){
		echo '<span style="color:green"> Andmed on edastatud edukalt </span> ';
	}	
?>

	<h2> Lisa mängitud mängu andmed andmebaasi</h2>
  <form action="index.php?action=registreeri" method="post" >
	<input name="name" type="name" placeholder="Mängija nimi" value="<?php if(isset($input['name'])){echo $input['name'];} ?>">
	<span style="color:red" ><?php if(isset($errors['name'])){echo $errors['name'];} ?> </span><br><br>
  
  	<input name="voit" type="number" placeholder="Võit" value="<?php if(isset($input['voit'])){echo $input['voit'];} ?>">
	<br><br>
	<input name="kaotus" type="number" placeholder="Kaotus"value="<?php if(isset($input['kaotus'])){echo $input['kaotus'];} ?>"> 
	<br><br>
	<input name="vslamm" type="number" placeholder="Väike slämm" value="<?php if(isset($input['vslamm'])){echo $input['vslamm'];} ?>">
	<br><br>
	<input name="ssamm" type="number" placeholder="Suur slämm" value="<?php if(isset($input['ssamm'])){echo $input['ssamm'];} ?>">
	<br><br>
	<input name="ristit" type="number" placeholder="Kaks ristit" value="<?php if(isset($input['ristit'])){echo $input['ristit'];} ?>">
	<br><br>
	<input type="submit" name="create" value="Lae Andmed">
	<a href="redigeeri.php">Siin saad registreerida</a>
  </form>
<body>
<html>


	
	




