<!DOCTYPE html>
<html>
<link rel="stylesheet" href="themes.css">
<head>
	<meta charset="utf-8"/>
</head>

<body>
	<titres>Noter les élèves</titres></br></br>
	<subtitle>Confirmation de votre ajout :</subtitle></br></br>
	<?php
		date_default_timezone_set('Europe/Paris');
		$date_actuelle = date("Ymd");

		$seance = $_POST['seance'];

    include ('connexion.php');

		$infos_inscription_seance = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance"); //Requête pour obtenir les lignes de la table inscription où cette séance apparaît

		foreach ($infos_inscription_seance as $eleve_inscrit)
		{
			$note_eleve_inscrit = $eleve_inscrit['note'];
			$erreur = $_POST[$note_eleve_inscrit];
			$note = 40 - $erreur;

			if ($erreur <= 40 && $erreur >= 0) // On vérifie que la note est comprise entre 0 et 40
			{
				$changer_note = mysqli_query($connect,"UPDATE `inscription` SET note_eleve = $note WHERE ideleve = $eleve_inscrit['ideleve'] and idseance = $seance;"); // On entre la note si c'est le cas
				if(!$changer_note)
				{
					echo "<br> Impossible de changer la note. La requête a échoué : <br>".mysqli_error($connect);
				}
			}
			else {
				echo "Vous avez spécifié un nombre d'erreurs supérieur à 40 ou inférieur à 0. Les notes de ces élèves ne seront pas changées."; // Sinon on ne rentre rien
		}

		echo "<table>";

		$confirmation = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance"); //Pour confirmer que tout a été mis à jour, on redemande les infos de la séance modifiée

		while ($confirmer = mysqli_fetch_array($confirmation, MYSQL_NUM))
		{
			$id_dun_etu = $confirmer[1];
			$nom_etudiant_query = mysqli_query($connection,"SELECT * FROM eleves WHERE idetu = $id_dun_etu"); //requête pour obtenir les infos des élèves inscrits à cette séance
			$nom_etudiant = mysqli_fetch_array($nom_etudiant_query, MYSQL_NUM);

			if ($confirmer[2] == 50) //Si on ne rentre pas de note, alors sa note est restée à 50. On considère qu'il n'est pas noté
			{
				echo "<br><tr><td>".$nom_etudiant[1]." ".$nom_etudiant[2]." : </td><td>Non noté</td></tr>";
			}
			else //Si la note a changé, on récapitule
			{
				echo "<br><tr><td>".$nom_etudiant[1]." ".$nom_etudiant[2]." : </td><td>".$confirmer[2]." points sur 40</td></tr>";
			}
		}

		echo "</table>";
		mysqli_close($connection);
	?>


</body>
</html>
