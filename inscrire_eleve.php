<!DOCTYPE html>
<html>
<link rel="stylesheet" href="themes.css">
<head>
	<meta charset="utf-8"/>
</head>

<body>
	<subtitle>Confirmation de votre ajout :</subtitle></br></br></br>

	<?php
		$eleve=strtoupper($_POST['eleve']);
		$seance=strtoupper($_POST['seance']);
    include ("connexion.php");

		


		$liste_eleves_de_seance = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance");// requête pour avoir les lignes de la table inscription avec l'id de la séance choisie
		$verif_nombre_eleves = mysqli_fetch_row($liste_eleves_de_seance);

		$verif_max_seance_query = mysqli_query($connect,"SELECT * FROM seance WHERE idseance = $seance"); //requête pour obtenir les infos de la séance choisie
		$verif_max_seance = mysqli_fetch_array($verif_max_seance_query, MYSQLI_ASSOC);

		effectif_seance = mysqli_num_rows($verif_nombre_eleves);

		if(!$seance)
		{
			echo "Erreur : aucune séance n'a été sélectionnée / n'est disponible.</br>";
		}
		else
		{
			if ($verif_max_seance['EffMax'] <= $effectif_seance) // On compare le nombre d'élèves déjà inscrits à l'effectif max
			{
				echo "Erreur : la séance est complète.</br>";
			}
			else
			{
				if (!$eleve)
				{
					echo "Erreur : aucun élève n'a été sélectionné / n'est disponible.</br>";
				}
				else
				{
					$deja_inscrit_query = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance and ideleve = $eleve"); // On sélectionne la ligne de la table inscription qui lie l'élève à la séance pour voir si il est déjà inscrit
					$deja_inscrit = mysqli_fetch_row($deja_inscrit_query);

					if (!$deja_inscrit)
					{
						$requete_inscription = "INSERT INTO inscription2 values ('$seance', '$eleve', '50');"; // Si il n'y est pas encore inscrit, on l'y inscrit via cette requête

						$inscription = mysqli_query($connect, $requete_inscription);

						if(!$inscription)
						{
							echo "<br> Inscription impossible. La requête a échoué : <br>".mysqli_error($connect);
              exit;
						}

						$eleve_query = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve = '$eleve';"); //requête pour obtenir les informations de l'élève choisi
						$eleve_en_question = mysqli_fetch_array($eleve_query, MYSQLI_ASSOC);

						$seance_query = mysqli_query($connect,"SELECT * FROM seance WHERE idseance = '$seance';"); //requête pour obtenir les informations de la séance choisie
						$seance_en_question = mysqli_fetch_array($seance_query, MYSQLI_ASSOC);

						$theme_seance_query = mysqli_query($connect,"SELECT * FROM themes WHERE idtheme = $seance_en_question['Idtheme'];");//requête pour obtenir les infos du thème de cette séance
						$theme_seance_en_question = mysqli_fetch_array($theme_seance_query, MYSQLI_ASSOC);

						// Affichage du récapitulatif

						echo "L'élève .$eleve_en_question['prenom']. .$eleve_en_question['nom']. a été inscrit à la séance du .$seance_en_question['DateSeance']. de .$theme_seance_en_question['nom']..</subtitle>";
					

						mysqli_close($connect);
					}
					else
					{
						die("Erreur : cet élève est déjà inscrit à cette séance. </br>");
					}
				}
			}
		}

	?>


</body>
</html>
