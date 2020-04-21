<?php

$sujet = $result["data"]["sujet"];
$messages = $result["data"]["messages"];
?>

<h1><?=$sujet->getTitre()?></h1> <?= $sujet->getVerrouillage() ? "- (Verrouillé)" : ""?>
<h4>
    Par <?= $sujet->getVisiteur()->getPseudonyme()?> -
<?php
    if(App\Session::isAdmin() || App\Session::getVisiteur()->getAdressemail() === $sujet->getVisiteur()->getAdressemail()){
?>
<a href="index.php?ctrl=foruma&action=verrouillageSujet&id=<?= $sujet->getId()?>">
    <?= $sujet->getVerrouillage() ? "Déverrouiller" : "Verrouiller"?>
</a>
<?php
    }
?>
    
</h4>

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

<?php
    if($sujet->getVerrouillage()){
?>        
            <p>Sujet Verrouillé</p>
<?php           
    }
    else{
?>

<h3>Participer au sujet</h3>

<form action="index.php?ctrl=foruma&action=ajoutMessage&id=<?= $sujet->getId()?>" method="post">
    
    <p><label for="message">Message:</label></p>
    <p><textarea id="newmessage" name="texte" placeholder="Tapez votre message" rows="6"></textarea></p><br>

    <p>
        <input id="valid" type='submit' value="Ajouter le Message">
    </p>
</form>

<?php
        }
?>