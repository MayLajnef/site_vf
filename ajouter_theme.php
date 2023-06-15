<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <?php
    //Sanity checks
    $nom = $_POST['name']; // a condition que 'nom' soit le bon 'name'! expliquez.
    $descriptif = $_POST['descriptif'];

    if (empty($nom) or empty($descriptif))  {
      die("Le formulaire est incomplet");
    } ?>
Les informations du nouveau thème sont
<ul>
  <li> <?php echo $_POST['name'] ?></li>
</ul>
<ul>
  <li> <?php echo $_POST['descriptif'] ?></li>
</ul>
<?php
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");

include ('connexion.php');


echo "<br> le nom saisie est : $nom";
$query = "insert into themes values (null,'$nom','0','$descriptif')";
// Est-ce que cela fonctionne ? Pourquoi ?
// ci-dessous autre requete prete a etre testee ensuite voir sujet de TP
// $query = "insert into eleves values (NULL, 'Blanche', 'Neige', '1800-01-01', "."'$date'".")";

echo "<br>$query<br>";
// important echo a faire systematiquement, c'est impose !

$result = mysqli_query($connect, $query);
// $query utilise comme parametre de mysqli_query
// le test ci-dessous est desormais impose pour chaque appel de :
// mysqli_query($connect, $query);
if (!$result)
{
  echo "<br>pas bon ".mysqli_error($connect);
  exit;
}
mysqli_close($connect);
?>

  </body>
</html>
