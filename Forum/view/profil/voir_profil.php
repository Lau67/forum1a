<?php

	$user = $result['data']['visiteur'];
	
?>


<section id="profil">
	
    <h2><?= $user ?></h2>
    
    <div id="profil-info">
		<dl>
			<dt>Nom d'utilisateur :</dt>
			<dd><?= $user->getPseudonyme()?></dd>
			
			<dt>Adresse e-mail :</dt>
            <dd><?= $user->getAdressemail()?></dd>
            
			<dt>Membre depuis le :</dt>
            <dd><?= $user->getDateinscription()?></dd>
            
            <dt>Rôle :</dt>
            <dd><?= $user->getRole()?></dd>
        </dl>
        
        <?php
		if(Session::getVisiteur() == $user){
            ?>
            
			<p>
				<a href="">Modifier mes informations</a>
            </p>
            
		<?php
		                                    }
		    ?>	
	</div>
	
</section>
