<?php
    $sujets = $result["data"]["sujets"];
    
?>

<h1>Bienvenue sur Forum</h1>

<h2>Forum est un forum de discussions, de débats et d'entraide. </h2>
<br>


<h3>Liste des sujets:</h3>
<table>
    
    <?php
    if(!empty($sujets)){
        foreach($sujets as $sujet){
            ?>
            <tr>
                <td><a href="index.php?ctrl=foruma&action=afficheSujet&id=<?= $sujet->getId() ?>">
                    <?= $sujet->getTitre() ?></a></td>
                <td> par <?= $sujet->getVisiteur()->getPseudonyme() ?></td>
                <td> le <?= $sujet->getDatecreation() ?></td>
                <td> cloturé: <?= $sujet->getVerrouillage() ? "Oui" : "Non" ?></td>
                
                <?php
                if(app\Session::isAdmin() || app\Session::getVisiteur()->getId() == $sujet->getVisiteur()->getId()){
                ?>
                
                <td><a href="index.php?ctrl=foruma&action=supprimeMessage&id=<?= $sujet->getId() ?>">Supprimer</a></td>
                
                <?php
                }
                ?>
                
            </tr>
            <?php
        }
    }
    else echo "Pas de sujets disponibles"; 
    ?>
</table>
<br>
<br>
<a href="index.php?ctrl=foruma&action=ajoutSujet">Nouveau sujet</a>

