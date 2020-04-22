<?php
    $sujets = $result["data"]["sujet"];
    $messages   = $result["data"]["message"];
?>

<h1>Liste des sujets:</h1>

<?php
    if(!empty($sujets)){
        foreach($sujets as $s){
?>

<a href='?ctrl=forum&action=listeParSujet&id=", $s->getId(), "'> sujet "</a>&nbsp;";

<div class="">
        <h4>
            <?=($sujet->getTitre()) ?>
             Créé par <?= $sujet->getVisiteur()->getPseudonyme() ?>
             le <?= $sujet->getDatecreation() ?>
        </h4>
        
        <p>
            <?=($sujet->getTexte()) ?>
            <br />
            <em><a href="index.php?ctrl=forum&amp;action=afficheMessages&amp;id=<?= $topic->getId() ?>">Messages</a></em>
        </p>
</div>


<?php      
        }
    }
    else echo "Pas de sujets disponibles"; 
?>





<?php
    echo "<h1> Derniers messages - tous sujets</h1>";
    if(!empty($messages)){
        foreach($messages as $m){

            echo "<p>",
                    "<a href='?ctrl=forum&action=voir&id=", $m->getId(), "'>", $m, "</a>",
                "</p>";
        }
    }
    else echo "<p>Pas de messages disponibles</p>";

    