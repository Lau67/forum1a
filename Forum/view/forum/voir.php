<?php
    $sujet = $result["data"]["titre"];
    $message = $result["data"]["texte"];
?>
    <article class="sujet">
        <h4><?= $sujet->getSujet()->getTitre()?></h4>
        <p><?= $sujet->getVisiteur()->getPseudonyme()?></p>
        <p><?= $sujet->getDatecreation()?></p>


        <p><?= $message->getTexte()?></p>
    </article>