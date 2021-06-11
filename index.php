
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </html><link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    
    <?php
/**
 * todo liste des 5 derniers tickets
 */
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
echo '<h1>Mon super blog !</h1>';
echo '<p><b>Derniers ticket du blog</b> :</p>';
$requete = $bdd->query('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date FROM tickets ORDER BY date DESC');
while($donnees = $requete->fetch()){
    echo '<div class=\'news\'><h3>'.htmlspecialchars($donnees['titre']).' <i>Le '.htmlspecialchars($donnees['date']).'</i> par '. htmlspecialchars($donnees['auteur']).'</h3><p>'.htmlspecialchars($donnees['contenu']).'<br><a href="commentaires.php?id_billet='.htmlspecialchars($donnees['id']).'"><i>Commentaires</i></a></p></div>';
}
?>
</body>
</html>