<?php
    namespace app;

    //require_once("./model/Entities/Visiteur");

    class Session{

        /**
        *   ajoute un message en session, dans la catégorie $categ
        */
        public static function addFlash($categ, $msg){
			
            $_SESSION[$categ] = $msg;
        }


        /**
        *   renvoie un message de la catégorie $categ, s'il y en a !
        */
        public static function getFlash($categ){

            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

		
		/**
        *   met un user dans la session (pour le maintenir connecté)
        */
        public static function setVisiteur($visiteur){

				$_SESSION["visiteur"] = $visiteur;
		}
        

		public static function getVisiteur(){
			
			return (isset($_SESSION["visiteur"])) ?$_SESSION["visiteur"] : false;
		}
        
/*
        public static function authenticationRequired(){

           /* if(!self::getVisiteur()){
                self::addFlash("notice", "Veuillez vous connecter SVP !");
                header("Location:index.php?ctrl=security&action=login");
                die();
            } */
/*           if(!self::getVisiteur()){
                self::addFlash("notice", "Veuillez vous connecter SVP !");
                return false;
            }
            return true;
        }
        
*/
        
/*
		public static function Admin(){
			if(isset($_SESSION["visiteur"]) && $_SESSION["visiteur"]->getRole() === "ADMIN"){
				return true;
			}
			return false;
        }
*/       

        public static function isAdmin(){
            if(self::getVisiteur() && self::getVisiteur()->hasRole("ROLE_ADMIN")){
                return true;
            }
            return false;
        }


    }