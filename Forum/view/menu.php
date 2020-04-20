<?php 
    if(app\Session::getVisiteur()){
    ?>
            
			<nav id="menu-in">

				<span class="visiteur">
	                <strong><?= app\Session::getVisiteur()?></strong>
                </span>
                
				<a href="index.php?ctrl=voir_profil">Visiteur</a>
                
				<a href="index.php?ctrl=security&action=logout">Déconnexion</a>
            
            </nav>
            
<?php
	                    } 
	else{
    ?>
			<nav id="menu-out">

                <a class="" href="index.php?ctrl=security&action=login">Connexion</a>
                
				<a class="" href="index.php?ctrl=security&action=register">Inscription</a>
            
            </nav>
            
<?php
		}
	?>