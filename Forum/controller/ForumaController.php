<?php
    namespace Controller;

    use app\Session;
    use model\Managers\SujetManager;
    use model\Managers\MessageManager;
    use app\AbstractController;
use App\ControllerInterface;

class ForumaController extends AbstractController implements ControllerInterface{

        public function index(){
          // if(Session::authenticationRequired()){
           $this->restrictTo("ROLE_USER");
           
           $sujetManager = new SujetManager();

            return [
                "view" => VIEW_DIR."forum/forum.php",
                "data" => [
                    "sujets"=> $sujetManager->findAll(["datecreation", "DESC"])
                ]
            ];
            }


        public function afficheSujet($id, $idMessage = null){

            $this->restrictTo("ROLE_USER");
           
            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();

             return [
                 "view" => VIEW_DIR."forum/voirsujet.php",
                 "data" => [
                     "sujet"=> $sujetManager->findOneById($id),
                     "messages"=> $messageManager->findBySujet($id),
                     "messageModif"=> $idMessage
                     ]
             ];
             }


        public function ajoutSujet(){

            $this->restrictTo("ROLE_USER");

            if(!empty($_POST)){
                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_STRING);

                if($titre && $texte){

                    $iduser = Session::getVisiteur()->getId();

                    $sujetManager = new SujetManager();

                    if($idSujet = $sujetManager->add([
                        "titre" => $titre,
                        "visiteur_id" => $iduser
                        ]
                    ));
                    
                    
                    $messageManager = new MessageManager();

                    $messageManager->add([
                        "texte" => $texte,
                        "visiteur_id" => $iduser,
                        "sujet_id" => $idSujet
                        ]
                    );

                    $this->redirectTo("foruma", "afficheSujet", $idSujet);

                }

            }
                         
            return [
                "view" => VIEW_DIR."forum/ajoutSujet.php",   
            ];
        }

        public function ajoutMessage($idSujet){

            $this->restrictTo("ROLE_USER");

            $sujetManager = new SujetManager();

            if(!empty($_POST) && !$sujetManager->fermer($idSujet)){
               
                $texte = filter_input(INPUT_POST, "texte", FILTER_UNSAFE_RAW);

                if($texte && !$this->detectTags($texte)){

                    $iduser = Session::getVisiteur()->getId();

                    $messageManager = new MessageManager();

                    $messageManager->add([
                        "texte" => $texte,
                        "visiteur_id" => $iduser,
                        "sujet_id" => $idSujet
                        ]
                    );

                    $this->redirectTo("foruma", "afficheSujet", $idSujet);

                }
                else Session::addFlash("error", "Syntaxe incorrect");
            }
                         
            $this->redirectTo("foruma");
        }


        public function verrouillageSujet($idSujet){

            $this->restrictTo("ROLE_USER");

            $sujetManager = new SujetManager();

            $sujet = $sujetManager->findOneById($idSujet);

            if(Session::isAdmin() || $sujet->getVisiteur()->getAdressemail() === Session::getVisiteur()->getAdressemail()){

                 $verrouillageNumber = ($sujet->getVerrouillage() == 1) ? "0" : "1";
           
                 if($sujetManager->verrouillage($idSujet, $verrouillageNumber));
                 $messageV = ($verrouillageNumber == 1) ? "verrouillé" : "déverrouillé";
                    Session::addFlash("success", "Sujet $messageV ");
            }
            else{
                    Session::addFlash("error", "Une erreur est survenue");
            }
            
            $this->redirectTo("foruma", "afficheSujet", $idSujet);

        }


        public function supprimeMessage($idSujet){
           
            $this->restrictTo("ROLE_USER");
            
            $sujetManager = new SujetManager();

            if($sujetManager->delete($idSujet)){
                Session::addFlash("success", "Sujet supprimé");
            }
            $this->redirectTo("foruma");
            
        }

        
        public function modifMessage($idMessage){
           
            $messageManager = new MessageManager();
            $message = $messageManager->findOneById($idMessage);
            $idSujet = $message->getSujet()->getId();

            if(!empty($_POST)){
                $nouveauTexte = filter_input(INPUT_POST, "nouveauTexte", FILTER_UNSAFE_RAW);
                $messageManager->modifMessage($idMessage, $nouveauTexte);
                Session::addFlash("success", "Message modifié");
                $this->redirectTo("foruma", "afficheSujet", $idSujet);
            }

            

            return $this->afficheSujet($idSujet, $idMessage);
        }


    }