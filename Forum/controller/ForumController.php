<?php
    namespace Controller;

    use app\Session;
    use model\Managers\SujetManager;
    use model\Managers\MessageManager;
    use model\Managers\VisiteurManager;
    use app\AbstractController;
use App\ControllerInterface;

class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

           $this->redirectTo("foruma");
        }

       

        public function users(){
            if(Session::isAdmin()){
            $manager = new VisiteurManager();
            $visiteurs = $manager->findAll(["pseudonyme", "DESC"]);

            return [
                "view" => VIEW_DIR."profil/liste_visiteurs.php",
                "data" => [
                    "visiteurs" => $visiteurs
                ]
            ];
            }   
            else {
                $this->redirectTo();
                //header("location: index.php");
            //die();
            }
        }


        public function user(){
           
            $id = Session::getVisiteur() -> getId() ;
            $manager = new VisiteurManager();
            $visiteur = $manager->findOneById($id);

            return [
                "view" => VIEW_DIR."profil/voir_profil.php",
                "data" => [
                    "visiteur" => $visiteur
                ]
            ];
           
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

        public function voir($id){
            
            $man = new SujetManager();

            $sujet = $man->findOneById($id);

            return [
                "view" => VIEW_DIR."forum/voir.php",
                "data" => $sujet
            ];
        }


        public function afficheSujets(){

            $sman = new SujetManager();
                
            $sujets = $sman->findAll();


            return [
                "view" => VIEW_DIR."forum/liste_sujet.php",
                "data" => [
                    "sujet" => $sujets,
                    
                ]
            ];
        }




        public function newSujet(){

            if(!empty($_POST)){

                $data["titre"] = $_POST["titre"];
                $data["texte"] = $_POST["texte"];
                $data["visiteur_id"] = Session::getVisiteur()->getId();

                if( $data["titre"] !== ""){
                    
                    $sman = new SujetManager();

                    //si l'ajout s'effectue correctement (càd que le DAO a renvoyé l'id de ce qu'on a inséré en base
                    if($idNewSujet = $sman->add($data)){
                        //on met un message de succès en session
                        Session::addFlash("success", "NOUVEAU SUJET AJOUTE AVEC SUCCES !");
                        //et on redirige (via une redirect 302 serveur) vers une toute nouvelle requète
                        //pour ne plus avoir de refresh de POST
                        header("Location:index.php?ctrl=forum&action=voir&id=".$idNewSujet);
                        //TRES IMPORTANT, il faut arrêter l'exécution de la suite du script !
                        //même si on a fait une redirection, le script s'exécute jusqu'au bout...
                        die();
                    }
                    else{
                        //on met un message d'erreur en session (cas où l'ajout ne s'est pas effectué en base)
                        Session::addFlash("error", "UN PROBLEME EST SURVENU !!!");
                    }
                }
                else{
                    //on met un message d'erreur en session (cas où le formulaire n'est pas bien rempli)
                    Session::addFlash("error", "LES CHAMPS OBLIGATOIRES SONT VIDES !!!");
                }
            }
            //s'il n'y a pas eu de redirection, on va jusqu'à l'affichage du formulaire quoi qu'il arrive
           
            $sman = new SujetManager();
            $sujets = $sman->findAll();

            return [
                "view" => VIEW_DIR."forum/ajoutSujet.php",
                "data" => $sujets
            ]; 
            
        } 

     
        public function newMessage(){

            if(!empty($_POST)){

                $data["texte"] = $_POST['texte'];
                $data["datecreation"] = $_POST['datecreation'];
                $data["visiteur_id"] = $_POST['visiteur'];
                $data["sujet_id"] = $_POST['sujet'];
                
                if( $data["texte"] !== ""){
                    
                    $mman = new MessageManager();

                    //si l'ajout s'effectue correctement (càd que le DAO a renvoyé l'id de ce qu'on a inséré en base
                    if($idNewMessage = $mman->add($data)){
                        //on met un message de succès en session
                        Session::addFlash("success", "MESSAGE AJOUTE AVEC SUCCES !");
                        //et on redirige (via une redirect 302 serveur) vers une toute nouvelle requète
                        //pour ne plus avoir de refresh de POST
                        header("Location:index.php?ctrl=forum&action=voir&id=".$idNewMessage);
                        //TRES IMPORTANT, il faut arrêter l'exécution de la suite du script !
                        //même si on a fait une redirection, le script s'exécute jusqu'au bout...
                        die();
                    }
                    else{
                        //on met un message d'erreur en session (cas où l'ajout ne s'est pas effectué en base)
                        Session::addFlash("error", "UN PROBLEME EST SURVENU !!!");
                    }
                }
                else{
                    //on met un message d'erreur en session (cas où le formulaire n'est pas bien rempli)
                    Session::addFlash("error", "LES CHAMPS OBLIGATOIRES SONT VIDES !!!");
                }
            }
            //s'il n'y a pas eu de redirection, on va jusqu'à l'affichage du formulaire quoi qu'il arrive
            
            $mman = new MessageManager();
            $messages = $mman->findAll();

            return [
                "view" => VIEW_DIR."forum/ajoutMessage.php",
                "data" => $messages
            ]; 
        }

        public function listeParSujet($idsujet){
            
            $sman = new SujetManager();
            $mman = new MessageManager();

           
            $sujet = $sman->findOneById($idsujet);
            $messages = $mman->findBySujet($idsujet);

            return [
                "view" => VIEW_DIR."forum/liste_sujet.php",
                "data" => [
                    "sujet" => $sujet,
                    "messages" => $messages
                ]
            ];
        }


        
    }
