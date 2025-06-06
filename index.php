<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire Upload Maison</title>
</head>
<body>
    <h1>Formulaire upload</h1>
    <?php
        if(isset($_GET['error']))
        {
            echo "<div class='error'>Une erreur est survenue (code erreur:".$_GET['error'].")</div>";
        }
        if(isset($_GET['uypload'])&& $_GET['upload']=="success")
        {
            echo "<div class='succes'>Votre produit< a bien été ajouté/div>";
        }
    ?>
    <form action="traitement.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">nom : </label>
            <input type="text" name="nom" id="nom">
        </div>
        <div class="form-group">
            <label for="description">Description : </label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="200000">
            <label for="image">Image: </label>
            <input type="file" name="image" id="image">
        </div>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>