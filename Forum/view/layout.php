<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title><?= $title ?></title>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
</head>

<body>
 <!--template principale-->
    <div id="wrapper"> 
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 id="message" style="color: red">
                <?= App\Session::getFlash("error") ?>
            </h3>
            <h3 id="message" style="color: green">
                <?= App\Session::getFlash("success") ?>
            </h3>
            <header id="bandeau">
                <nav>
                    <h1>
                        <a href="index.php">Accueil</a>
                    </h1>

                    <?php
                        if(App\Session::getVisiteur()){
                    ?>
                            <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                    <?php
                        }
                        else{
                    ?>
                            <a href="index.php?ctrl=security&action=login">Connexion</a>
                            <a href="index.php?ctrl=security&action=register">Inscription</a>
                    <?php
                        }
                        if(App\Session::isAdmin()){
                    ?>
                    <a href="index.php?ctrl=forum&action=users">Voir la liste des utilisateurs</a>
                   
                    <?php
                        }
                    ?>
                
                        <span><?= App\Session::getVisiteur()?></span>

                </nav>
            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>

        <footer>
            <p>&copy; 2020 - Forum- <a href="index.php?control=forum&action=cgu">Mentions Légales</a>
                                    <a href="index.php?control=forum&action=cgu">Netiquette</a></p>
        </footer>
    </div>
    
    
</body>
</html>