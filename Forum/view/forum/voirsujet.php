<?php

$sujet = $result["data"]["sujet"];
$messages = $result["data"]["messages"];
?>

<h1><?=$sujet->getTitre()?></h1>

<?php
if(!empty($messages)){
    foreach($messages as $message){
?>

<p><?=$message->getTexte()?></p> par <?=$message->getVisiteur()?> le <?=$message->getDatecreation()?>

<?php      
    }
}
else echo "Pas de messages disponibles"; 
?>

<h3>Participer au sujet</h3>

<form action="index.php?ctrl=foruma&action=ajoutMessage&id=<?= $sujet->getId()?>" method="post">
    
    <p><label for="message">Message:</label></p>
    <p><textarea id="newpost" name="texte" placeholder="Tapez votre message" rows="6"></textarea></p><br>

    <p>
        <input id="valid" type='submit' value="Ajouter le Message">
    </p>
</form>