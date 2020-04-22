<?php

    $visiteurs = $result['data']['visiteurs'];
    
?>
<h1>Liste des utilisateurs</h1>
<ul>
<?php
    foreach($visiteurs as $visiteur){
        echo "<li>", $visiteur->getPseudonyme(), ", inscrit depuis le ", $visiteur->getDateinscription(), " >>> adresse mail: ", $visiteur->getAdressemail(), "</li>";
    }
    
?>
</ul>