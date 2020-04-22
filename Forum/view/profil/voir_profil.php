<?php

	$visiteur = $result['data'];
	
?>


<section id="profil">
	
    <h2>Profil</h2>
    
    <div id="profil-info">
		<dl>
			<dt>Nom d'utilisateur :</dt>
			<?= $visiteur->getPseudonyme()?>
			
			<dt>Adresse e-mail :</dt>
            <dd><?= $visiteur->getAdressemail()?></dd>
            
			<dt>Membre depuis le :</dt>
            <dd><?= $visiteur->getDateinscription()?></dd>
            
            <dt>Rôle :</dt>
            <dd><?= $visiteur->getRole()?></dd>
        </dl>
        
        <?php
		if(app\Session::getVisiteur() == $visiteur){
            ?>
            
			<p>
				<a href="">Modifier mes informations</a>
            </p>
            
		<?php
		                                    }
		    ?>	
	</div>
	
</section>
