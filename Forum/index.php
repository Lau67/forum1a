<?php

    namespace app;

    define('DS', DIRECTORY_SEPARATOR); // le caractère séparateur de dossier (/ ou \)
    // meilleure portabilité sur les différents systêmes.
    define('BASE_DIR', dirname(__FILE__).DS); // pour se simplifier la vie
    define('VIEW_DIR', BASE_DIR."view/");     //le chemin où se trouvent les vues
    define('PUBLIC_DIR', BASE_DIR."public/");     //le chemin où se trouvent les fichiers publics (CSS, JS, IMG)
    define('DEFAULT_CTRL', 'forum');//nom du contrôleur par défaut
    
    require("app/Autoloader.php");
    
    Autoloader::register();

//démarre une session ou récupère la session actuelle
    session_start();
//et on intègre la classe Session qui prend la main sur les messages en session
    use app\Session as Session;

//---------REQUETE HTTP INTERCEPTEE-----------

    $ctrlname = DEFAULT_CTRL;//on prend le controller par défaut
    //ex : index.php?ctrl=forum
    if(isset($_GET['ctrl'])){
        $ctrlname = $_GET['ctrl'];
    }
    //on construit le namespace de la classe Controller à appeller
    $ctrlNameSpace = "Controller\\".ucfirst($ctrlname)."Controller";
    //on vérifie que le namespace pointe vers une classe qui existe
    if(!class_exists($ctrlNameSpace)){
        //si c'est pas le cas, on choisit le namespace du controller par défaut
        $ctrlNameSpace = "Controller\\".DEFAULT_CTRL."Controller";
        //Controller/ForumController
    }
    $ctrl = new $ctrlNameSpace();

    $action = "index";//action par défaut de n'importe quel contrôleur
    //si l'action est présente dans l'url ET que la méthode correspondante existe dans le ctrl
    if(isset($_GET['action']) && method_exists($ctrl, $_GET['action'])){
        //la méthode à appeller sera celle de l'url
        $action = $_GET['action'];
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else $id = null;
    //ex : ForumController->users(null)
    $result = $ctrl->$action($id);
    
    /*--------CHARGEMENT PAGE----------*/
    
    if($action == "ajax"){//si l'action était ajax
        echo $result;//on affiche directement le return du contrôleur (càd la réponse HTTP sera uniquement celle-ci)
    }
    else{
        ob_start();//démarre un buffer (tampon de sortie)
        /*le contenu à voir s'affiche dans le buffer qui devra être inséré
        au milieu du template*/
        include($result['view']);
        /*je mets cet affichage dans une variable*/
        $page = ob_get_contents();
        /*j'efface le tampon*/
        ob_end_clean();
        /*j'affiche le template principal*/
        include VIEW_DIR."layout.php";
    }