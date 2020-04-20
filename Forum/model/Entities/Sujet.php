<?php
    namespace model\Entities;

    use app\Entity;

    final class Sujet extends Entity{

        private $id;
        private $titre;
        private $datecreation;
        private $verrouillage; 
        private $visiteur;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        protected function setId($id){

            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of titre
         */ 
        public function getTitre()
        {
            return $this->titre;
        }

        /**
         * Set the value of titre
         * 
         * @return  self
         */ 
        public function setTitre($titre)
        {
            $this->titre = $titre;

            return $this;
        }


        /**
         * Get the value of datecreation
         */ 
        public function getDatecreation()
        {
                $formatDate = $this->datecreation->format("d/m/Y, H:i:s");
                return $formatDate;
        }

        /**
         * Set the value of datecreation
         *
         * @return  self
         */ 
        public function setDatecreation($datecreation)
        {
                //$this->dateajout = $datecreation;
                $this->datecreation = new \DateTime($datecreation);
                return $this;
        }

        /**
        * 
         * Get the value of verrouillage
         */ 
        public function getVerrouillage()
        {
                return $this->verrouillage;
        }

        /**
         * Set the value of verouillage
         *
         * @return  self
         */ 
        public function setVerrouillage($verrouillage)
        {
                $this->verrouillage = $verrouillage;

                return $this;
        }


        /**
         * Get the value of visiteur
         */ 
        public function getVisiteur()
        {
                return $this->visiteur;
        }

        /**
         * Set the value of visiteur
         *
         * @return  self
         */ 
        public function setVisiteur($visiteur)
        {
                $this->visiteur = $visiteur;

                return $this;
        }
        
        public function __toString(){

            return $this->titre." - ".$this->visiteur->getVisiteur()." ".$this->datecreation;
        }

    }