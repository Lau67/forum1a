<?php

    namespace App;

    abstract class AbstractController{

        protected static function redirectTo($ctrl = null, $action = null, $id = null){

            $url = "index.php";
            $url.= ($ctrl) ? "?ctrl=".$ctrl : "?ctrl=forum";
            $url.= ($action) ? "&action=".$action : "";
            $url.= ($id) ? "&id=".$id : "";
            header("Location: $url");
            die();
        }

        protected static function restrictTo($role){
            if(!Session::getVisiteur() || !Session::getVisiteur()->hasRole($role)){
                self::redirectTo("security", "login");
            }
        }

        protected static function detectTags($texte){

            $forbidden = ["<", ">", ";"];

            foreach($forbidden as $char){
                if(strpos($texte, $char) !== false){
                    return true;
                }
            }
            return false;
        }

    }