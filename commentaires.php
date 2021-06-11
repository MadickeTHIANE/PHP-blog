<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    

    <?php
/**
 * todo affichage du billet sélectionné et de ses commentaires
 * todo lien de retour vers les ticket
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
echo'<a href="index.php">Retour à la liste des ticket</a>';
//? affichage du billet sélectionné
$requete = $bdd->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date FROM tickets WHERE id=? ORDER BY date DESC');
$requete->execute(array($_GET['id_billet']));
$donnees = $requete->fetch();
    echo '<div class=\'news\'><h3>'.htmlspecialchars($donnees['titre']).' <i>Le '.htmlspecialchars($donnees['date']).'</i> par '. htmlspecialchars($donnees['auteur']).'</h3><p>'.htmlspecialchars($donnees['contenu']).'<br></p></div>';

echo'<h2>Commentaires</h2>';
//? affichage des commentaires sur ce billet
$requete = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'le %d/%m/%Y à %Hh%imin%ss\') AS date FROM commentary WHERE id_billet=? ORDER BY date DESC');
$requete->execute(array($_GET['id_billet']));
while($donnees = $requete->fetch()){
    echo '<p><b>'.htmlspecialchars($donnees['auteur']).'</b> <i>'.htmlspecialchars($donnees['date']).'</i></p><p>' .htmlspecialchars($donnees['commentaire']).'</p>';
}
?>
<div class="formulaire">
    <form action="commentaires_post.php?id=<?php echo $_GET['id_billet'];?>" method="POST">
        <label for="pseudo">Votre pseudo : <input type="text" name="pseudo" id="pseudo"></label>
        <label for="commentaire">Veuillez écrire votre commentaire : </label><textarea name="commentaire" id="commentaire" cols="30" rows="5" placeholder="N'oubliez pas de rester courtois !"></textarea>
        <input type="submit" value="Envoyer">
    </form>
</div>
</body>
</html>