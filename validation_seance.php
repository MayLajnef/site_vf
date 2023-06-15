<!DOCTYPE html>
<html>
<link rel="stylesheet" href="themes.css">
<head>
	<meta charset="utf-8"/>
</head>

<body>
	<titres>Noter les élèves</titres></br></br></br>

	<?php
		date_default_timezone_set('Europe/Paris');
		$date_actuelle = date("Ymd");

    include('connexion.php');

		$liste_seances = mysqli_query($connect,"SELECT * FROM seances WHERE DateSeance < $date_actuelle");	 // Requête SQL qui sélectionne toutes les séances du passé

		// Formulaire pour choisir une séance à valider

		echo "<table>";

		echo "<FORM METHOD='POST' ACTION='valider_seance.php' >";
		echo "<tr><td><label for="choix_seance">Sélectionnez une séance</label></td>";
    echo "<td><select id="choix_seance" name='seance' BORDER='1'>";


		foreach ($seances as $seance) {

      $id_theme = $seance['Idtheme'];
  		$theme_seance_query = mysqli_query($connect,"SELECT * FROM themes WHERE idtheme = $id_theme;"); //requête pour obtenir les infos du thème de la séance
  		$theme_seance = mysqli_fetch_array($theme_seance_query, MYSQLI_ASSOC);

  		echo "<option value=".$seances['idseance']."> Séance de ".$theme_seance['nom']." du ".$seance['DateSeance']."</option>";
    }

		echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
