
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
  <title>Ajout d'un thème</title>
</head>
<body>
  <?php
  include 'connexion.php';

  $req_verif_theme_supprime = 'SELECT * FROM themes WHERE nom = "'.$_POST['nom'].'" and supprime = 1 ';
  $verif_theme_supprime = mysqli_query($connect, $req_verif_theme_supprime);
  if (empty($_POST['nom']) || empty($_POST['descriptif']) ) 
  {
    echo "Le formulaire est incomplet ! ";
    echo "<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Réessayer d'ajouter un thème' />";
    exit();
  }
  if (!empty($verif_theme_supprime)) { // si le thème a été supprimé dans le passé
    $req_reactivation_theme = 'UPDATE themes SET supprime = 0 WHERE nom = "'.$_POST['nom'].'"'; // on ressuscite le thème supprimé
    $reactivation_theme = mysqli_query($connect, $req_reactivation_theme);
    if (!$$req_reactivation_theme) echo "<br>Erreur: ".mysqli_error($connect);
    else {
      echo <<< EOT
      <br>
      <p> Le thème a été réactivé ! </p>
      <table>
        <tr>
          <td> <input type='button' onclick=\"window.location='ajout_theme.html'\" value='Ajouter un autre thème' /> </td>
          <td> <input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' /> </td>
        </tr>
      </table>
      EOT;
    }
  }
  else {
  $req_ajout_theme = 'insert into themes values ( NULL,"'.$_POST['nom'].'", 0 , "'.$_POST['descriptif'].'")'; // Requête pour ajouter un thème
  $ajout_theme = mysqli_query($connect, $req_ajout_theme);
  if (!$ajout_theme)  
  {
    echo "La requête a échoué. <br> Erreur : <br>".mysqli_error($connect);
    echo "<br> <input type='button' onclick=\"window.location='ajout_theme.html'\" value='Réessayer d'ajouter un thème' />";
    exit();
  }
  else {
    echo <<< EOT
    <br>
    <p> Le thème a été ajouté ! </p>
    <table>
        <tr>
          <td> <input type='button' onclick=\"window.location='ajout_theme.html'\" value='Ajouter un autre thème' /> </td>
          <td> <input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' /> </td>
        </tr>
      </table>
    EOT;
  }
}
  mysqli_close($connect);
    ?>
</body>

</html>
