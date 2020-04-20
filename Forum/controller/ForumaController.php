<?php
    namespace Controller;

    use app\Session;
    use model\Managers\SujetManager;
    use model\Managers\MessageManager;
    use app\AbstractController;

    class ForumaController extends AbstractController{

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


        public function afficheSujet($id){

            $this->restrictTo("ROLE_USER");
           
            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();

             return [
                 "view" => VIEW_DIR."forum/voirsujet.php",
                 "data" => [
                     "sujet"=> $sujetManager->findOneById($id),
                     "messages"=> $messageManager->findBySujet($id)
                 ]
             ];
             }


        public function ajoutSujet(){

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

            if(!empty($_POST)){
               
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_STRING);

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

            }
                         
            $this->redirectTo("foruma");
        }

    }