<!DOCTYPE html>
<html>
<link rel="stylesheet" href="themes.css">
<head>
	<meta charset="utf-8"/>
</head>

<body>
	<title>Noter les élèves</title></br></br></br>

	<?php
		$seance_a_noter = $_POST['seance'];

		date_default_timezone_set('Europe/Paris');
		$date_actuelle = date("Ymd");

		include ('connexion.php');
		$infos_inscription_seance = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance_a_noter"); // On sélectionne les lignes de la table inscription comportant la séance selectionnée

		// Formulaire pour noter les élèves inscrits à la séance

		echo "<table>";

		echo "<FORM METHOD='POST' ACTION='noter_eleves.php' >";
		echo "<tr><td><subtitles>Notez le nombre d'erreurs faites par chaque élève (champ vide = 0 fautes) :</td></tr><br>";

		foreach ($infos_inscription_seance as $seance)
		{
			$id_eleve_a_noter = $seance['ideleve'];
			$nom_etudiant_query = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve = $ideleve_en_question"); // On selectionne les infos de l'élève en question
			$nom_etudiant = mysqli_fetch_array($nom_etudiant_query, MYSQLI_ASSOC);

			echo "<br><tr><td>".$nom_etudiant[1]." : </td><td><input type='number' name=$nom_etudiant[0]></td></tr>";
		}
		echo "<input type='hidden' name='seance' value=".$seance_a_noter.">";

		echo "<tr><td><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
