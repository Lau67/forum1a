<?php
    $sujet = $result["data"]["sujet"];
?>


<h2>Titre sujet<?= $sujet?></h2>

<h3>Participer au sujet</h3>

<form action="index.php?ctrl=forum&action=newMessage&id=<?= $sujet->getId()?>" method="post">
    
    <p><label for="message">Message:</label></p>
    <p><textarea id="newmessage" name="texte"></textarea></p><br>

    <p>
        <input id="valid" type='submit' value="Ajouter le Message">
    </p>
</form>