<?php

$sujet = $result["data"]["sujet"];
$messages = $result["data"]["messages"];
$messageModif = $result["data"]["messageModif"];
?>

<a href="index.php?ctrl=foruma">Retour à la liste des sujets</a>

<h1><?=$sujet->getTitre()?><?= $sujet->getVerrouillage() ? " - (Cloturé)" : ""?></h1> 
<h4>
    Par <?= $sujet->getVisiteur()->getPseudonyme()?> le <?= $sujet->getDatecreation()?> -
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

<h3>Messages du sujet:</h3>

<table>

<?php
if(!empty($messages)){
    foreach($messages as $message){
?>

<tr>
    <td>
        <?php
            if($message->getId() === $messageModif){
        ?>
                <form action="index.php?ctrl=foruma&action=modifMessage&id=<?= $message->getId()?>" method="post">
                    <textarea name="nouveauTexte" id="" cols="60" rows="6"><?=$message->getTexte()?></textarea>
                    <p><input id="valid" type='submit' value="Modifier le Message"></p>
                </form>
        <?php       
            }
            else{
        ?>
            <?=$message->getTexte()?>
        <?php       
            }
        ?>   
    </td>
    <td> par <?=$message->getVisiteur()?></td>
    <td> le <?=$message->getDatecreation()?></td>
    <td><a href="index.php?ctrl=foruma&action=modifMessage&id=<?= $message->getId()?>">Modifier</a></td>
</tr>

<?php      
    }
}
else echo "Pas de messages disponibles"; 
?>

</table>

<?php
    if($sujet->getVerrouillage()){
?>        
            <p><strong> Sujet Verrouillé <strong></p>
<?php           
    }
    else{
?>

<h3>Participer au sujet:</h3>

<form action="index.php?ctrl=foruma&action=ajoutMessage&id=<?= $sujet->getId()?>" method="post">
    
    <p><label for="message">Message:</label></p>
    <p><textarea id="newmessage" name="texte" placeholder="Tapez votre message" cols="30" rows="6"></textarea></p><br>

    <p>
        <input id="valid" type='submit' value="Ajouter le Message">
    </p>
</form>

<?php
        }
?>