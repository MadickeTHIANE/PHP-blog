<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO commentary(id_billet, auteur, commentaire, date_commentaire) VALUES (:billet, :pseudo, :commentaire, NOW())');
    
    $req->bindValue(':billet', $_GET['id']);
    $req->bindValue(':pseudo', $_POST['pseudo']);
    $req->bindValue(':commentaire',$_POST['commentaire']);
    $req->execute();
    
    // header('location:commentaires.php?id_billet='.$_GET['id'].'');
    // var_dump($_GET['id']);
    ?>
</body>

</html>