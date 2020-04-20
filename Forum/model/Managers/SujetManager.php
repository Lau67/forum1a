<?php
    namespace model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Sujet;

    class SujetManager extends Manager{

        protected $className = "model\Entities\Sujet";
        protected $tableName = "sujet";

        public function __construct(){
            parent::connect();
        }

        /*
        public function findAll(){
            return parent::findAll();
        }
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
        */

        

        public function getSujets(){
            $req = "SELECT id_sujet, titre, DATE_FORMAT(datecreation, \'%d/%m/%Y à %Hh%imin%ss\') AS datecreation
                    FROM '.$this->tableName.' 
                    ORDER BY datecreation DESC LIMIT 0, 15
                    ";

            return $req;
        }


        public function getSujet($sujetId){                      
            $req = "SELECT id_sujet, titre, texte, DATE_FORMAT(datecreation, \'%d/%m/%Y à %Hh%imin%ss\') AS datecreation
                    FROM '.$this->tableName.' 
                    WHERE id_sujet = ?
                    ";

            $req->execute(array($sujetId));
            $sujet = $req->fetch();
        
            return $sujet;
        }


    }


        
    