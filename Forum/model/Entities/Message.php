<?php
    namespace model\Entities;

    use app\Entity;

    final class Message extends Entity{

        private $id;
        private $texte;
        private $sujet;
        private $datecreation;
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
         * Get the value of texte
         */ 
        public function getTexte()
        {
                return $this->texte;
        }

        /**
         * Set the value of texte
         *
         * @return  self
         */ 
        public function setTexte($texte)
        {
                $this->texte = $texte;

                return $this;
        }
        
        /**
         * Get the value of sujet
         */ 
        public function getSujet()
        {
                return $this->sujet;
        }

        /**
         * Set the value of sujet
         *
         * @return  self
         */ 
        public function setSujet($sujet)
        {
                $this->sujet = $sujet;

                return $this;
        }


        /**
         * Get the value of datecreation
         */ 
        public function getDatecreation()
        {
                return $this->datecreation;
        }

        /**
         * Set the value of datecreation
         *
         * @return  self
         */ 
        public function setDatecreation($datecreation)
        {
                $this->datecreation = $datecreation;

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

            return $this->texte;
        }

    }
