<?php
    namespace model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Visiteur;

    class VisiteurManager extends Manager{

        protected $className = "model\Entities\Visiteur";
        protected $tableName = "visiteur";

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
        

        public function findByVisiteur($idvisiteur){
            $sql = "SELECT *
                    FROM ".$this->tableName." v WHERE v.visiteur_id = :id
                    ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $idvisiteur]), 
                $this->className
            );
        }
*/

    public function verifyVisiteurExist($adressemail){
        $sql = "SELECT COUNT(id_visiteur)
                FROM ".$this->tableName." 
                WHERE adressemail = :adressemail
                ";

        return $this->getSingleScalarResult(
             DAO::select($sql, ['adressemail' => $adressemail], false)
        );
    }


    public function retrievePassword($pseudonyme){
        $sql = "SELECT motdepasse
                FROM ".$this->tableName." 
                WHERE pseudonyme = :pseudonyme
                ";

        return $this->getSingleScalarResult(
             DAO::select($sql, ['pseudonyme' => $pseudonyme], false)
        );
    }


    public function findByPseudonyme($pseudonyme){

        $sql = "SELECT *
                FROM ".$this->tableName." 
                WHERE pseudonyme = :pseudonyme
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudonyme' => $pseudonyme], false), 
            $this->className
        );
    }

/*
    public function findAll($pseudonyme){

        $sql = "SELECT *
                FROM ".$this->tableName." 
                WHERE pseudonyme = :pseudonyme
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudonyme' => $pseudonyme], false), 
            $this->className
        );
    }
*/

    public function findByEmail($adressemail){

        $sql = "SELECT id_visiteur, pseudonyme, adressemail, dateinscription
                FROM ".$this->tableName." 
                WHERE adressemail = :adressemail
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['adressemail' => $adressemail], false), 
            $this->className
        );
    }



    
    public function verifyVisiteur($login){
        $result = parent::connect(
            "SELECT COUNT(id_visiteur) AS nb
            FROM visiteur
            WHERE adressemail = :pseudonyme
            OR pseudonyme = :pseudonyme", 
            array("pseudonyme" => $login)
        );
        
        return $result['nb'];
    }

    

    public function getVisiteur($login){
        $data = parent::connect(
            "SELECT id_visiteur, pseudonyme, adressemail, dateinscription, role
            FROM visiteur
            WHERE adressemail = :pseudonyme
            OR pseudonyme = :pseudonyme", 
            array("pseudonyme" => $login)
        );
        
        return parent::getOneOrNullResult($data, "Visiteur");
    }

    public function getById($id){
        $data = parent::connect(
            "SELECT id_visiteur, pseudonyme, adressemail, dateinscription, role
            FROM visiteur
            WHERE id_visiteur = :id_visiteur", 
            array("id_visiteur" => $id)
        );
        
        return parent::getOneOrNullResult($data, "pseudonyme");
    }

    public function getMotdepasse($id){
        $data = parent::connect(
            "SELECT motdepasse
            FROM visiteur
            WHERE id_visiteur = :id_visiteur", 
            array("id_visiteur" => $id)
        );
        
        return $data['motdepasse'];
    }

    public function insertVisiteur($pseudonyme, $adressemail, $hash){
        return parent::connect(
            "INSERT INTO visiteur (pseudonyme, adressemail, motdepasse)
            VALUES (:pseudonyme, :adressemail, :motdepasse)", 
            array(
                "pseudonyme" => $pseudonyme,
                "adressemail" => $adressemail,					
                "motdepasse" => $hash,
            )
        );
        
    }

}
    