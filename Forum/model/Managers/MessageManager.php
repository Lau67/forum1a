<?php
    namespace model\Managers;
        
    use app\Manager;
    use app\DAO;
    use model\Entities\Message;

    class MessageManager extends Manager{

        protected $className = "model\Entities\Message";
        protected $tableName = "message";

        public function __construct(){
            parent::connect();
        }

        /*public function findAll(){
            return parent::findAll();
        }

        public function findOneById($id){
            return parent::findOneById($id);
        }*/

        public function getMessage($messageId){
            $messages = "SELECT id_message, texte, DATE_FORMAT(datecreation, \'%d/%m/%Y à %Hh%imin%ss\') AS datecreation
                        FROM ".$this->tableName."
                        WHERE sujet_id = ? 
                        ORDER BY datecreation DESC
                        ";

            $messages->execute(array($messageId));
    
            return $messages;
        }
    
        public function ajoutMessageA($sujetId, $pseudonyme, $texte){
            $messages = "INSERT INTO message(sujet_id, pseudonyme, texte, datecreation)
                        VALUES(?, ?, ?, NOW())
                        ";

            $affectedLines = $messages->execute(array($sujetId, $pseudonyme, $texte));
    
            return $affectedLines;
        }

    

    public function findBySujet($idSujet){
        $sql = "SELECT *
                FROM ".$this->tableName." 
                WHERE sujet_id = :idsujet
                ";

        return $this->getMultipleResults(
            DAO::select($sql, ['idsujet' => $idSujet]), 
            $this->className
        );
    }


    public function modifMessage($id, $texte){
        
        $sql= "UPDATE message SET texte = :texte WHERE id_message = :id";

            return DAO::update($sql, ["texte" => $texte, "id" => $id]);

    }


    }