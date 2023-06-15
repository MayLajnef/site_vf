<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <?php
  $choix = $_POST['choix'];
  if (!isset($choix) || $choix == 1) {
    include('connexion.php');

    $nom_echap = mysqli_real_escape_string($connect, $nom);
    $prenom_echap = mysqli_real_escape_string($connect, $prenom);

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d')

    $requete_ajout_eleve = "insert into eleves values (null,'$nom_echap','$prenom_echap','$dateNaiss', '$date')";


    echo "<br>$requete_ajout_eleve<br>";


    $ajout_eleve = mysqli_query($connect, $requete_ajout_eleve);
    // $query utilise comme parametre de mysqli_query
    // le test ci-dessous est desormais impose pour chaque appel de :
    // mysqli_query($connect, $query);
    if (!$result)
    {
      echo "<br>Impossible d'ajouter l'élève. La requête a échoué. <br>  ".mysqli_error($connect);
      exit;
    }
    mysqli_close($connect);
  }
    else {
      echo "<br><br><subtitle>Redirection vers l'accueil ...</subtitle><br><br><br>";
			echo "<META HTTP-EQUIV='refresh' CONTENT=5;URL='accueil.html'>";
      exit;
    }
  ?>
 // Tableau récapitulatif des informations de l'élève
  </body>
</html>
