<?php
    namespace Controller;

    use app\Session;
	use model\Managers\VisiteurManager;
	use app\AbstractController;
use App\ControllerInterface;

//define("VIEW_DIR", "security/");
	
	class SecurityController extends AbstractController implements ControllerInterface { 
		
		//private $manager;
		
		//public function __construct(){
		//	$this->manager = new VisiteurManager();
		//}
        
        
		public function index(){
			
			return $this->login();
		}
        
        
		public function login(){

            if(!empty($_POST)){

				$pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_VALIDATE_REGEXP,
					array(
						"options" => array("regexp"=>'/[A-Za-z0-9]{4,}/')
					)
				);
				$pass = filter_input(INPUT_POST, "pass", FILTER_VALIDATE_REGEXP,
					array(
						"options" => array("regexp"=>'/[A-Za-z0-9]{6,32}/')
					)
				);
				
					if($pseudonyme && $pass){
						$manager = new VisiteurManager();
						$dbPass = $manager->retrievePassword($pseudonyme);
						if(password_verify($pass, $dbPass)){
							
							$visiteur = $manager->findByPseudonyme($pseudonyme);
								Session::setVisiteur($visiteur);
								Session::addFlash("success", "Bienvenue" . " " . $visiteur );
								$this->redirectTo("forum", "index");
								//header('Location:index.php?ctrl=forum&action=index');
								//die();
						}
						else{
							Session::addFlash("error", "Le mot de passe est incorrect !");
						} 
					}
					else{
						Session::addFlash("error", "Veuillez remplir tous les champs !");
					}
			}
			
			return array(
				"view"  => VIEW_DIR."security/login.php",
				"data" => ["titre" => "Connexion"]
			);

		}

        
		public function register(){

			if(!empty($_POST)){
				
                $pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{4,}/')
                    )
                );
                $adressemail = filter_input(INPUT_POST, "adressemail", FILTER_VALIDATE_EMAIL);
                $pass = filter_input(INPUT_POST, "pass", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{6,32}/')
                    )
                );
                $passrepeat = filter_input(INPUT_POST, "pass-r", FILTER_SANITIZE_STRING);
				
				
				if($pseudonyme && $adressemail){
					if($pass){
						if($pass !== "" && ($pass === $passrepeat)){
									//embeter la base de données
							$manager = new VisiteurManager();
							if($manager->verifyVisiteurExist($adressemail) == 0){  
							
								$visiteur = [
										"pseudonyme" => strtolower ($pseudonyme),
										"adressemail" => $adressemail,
										"motdepasse" => password_hash($pass, PASSWORD_ARGON2I),
										"role" => json_encode(["ROLE_USER"])
										];
								$manager->add($visiteur); 
								
								Session::addFlash("success", "Inscription réussie, connectez-vous !");
								$this->redirectTo("security", "login");
								//header('Location:index.php?ctrl=security&action=login');
								//die();
							}
							else{
								Session::addFlash("error", "Cet e-mail existe déjà !");
							}
						}
						else{
							Session::addFlash("error", "Les deux mots de passe ne correspondent pas");
						}
					}
					else{
						Session::addFlash("error", "Le mot de passe est invalide");
					}
				}
				else{
					Session::addFlash("error", "Veuillez remplir tous les champs!!");
				}
			}
			
			return array(
				"view"  => VIEW_DIR."security/register.php",
				"data" => ["titre" => "Inscription"]
			);
			
		}
        
        
		public function logout(){
			
			Session::setVisiteur(null);
			Session::addFlash("success", "A bientôt !");
		  	$this->redirectTo("security", "login");
			// header('location: index.php');
            //die();
        }
        
	}