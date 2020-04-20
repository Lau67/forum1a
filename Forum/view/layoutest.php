<!DOCTYPE html>

<html>

// structure de la page

    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="./public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div id="wrapper"> 
            <header id="bandeau">
				
				<h1 >
					<a href="index.php">Accueil</a>
                </h1>
                
				<?php
					include("menu.php");
				?>
					
			</header>

        <main>
            <?= $page ?>
        </main>

        <footer>
            <p>&copy; 2020 - Forum - <a href="index.php?control=forum&action=cgu">Mentions Légales</a>
                                     <a href="index.php?control=forum&action=cgu">Netiquette</a></p>
	    </footer>

        </div>
    </body>
</html>

