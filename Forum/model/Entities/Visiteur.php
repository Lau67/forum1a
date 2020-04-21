<?php
    namespace model\Entities;

    use app\Entity;

    final class Visiteur extends Entity{

        private $id;
        private $pseudonyme;
        private $adressemail;
        private $dateinscription;
        private $role;

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
         * Get the value of pseudonyme
         */ 
        public function getPseudonyme()
        {
            return ucfirst($this->pseudonyme);
        }

        /**
         * Set the value of pseudonyme
         * 
         * @return  self
         */ 
        public function setPseudonyme($pseudonyme)
        {
            $this->pseudonyme = $pseudonyme;

            return $this;
        }


        /**
         * Get the value of adressemail
         */ 
        public function getAdressemail()
        {
                return $this->adressemail;
        }

        /**
         * Set the value of adressemail
         *
         * @return  self
         */ 
        public function setAdressemail($adressemail)
        {
                $this->adressemail = $adressemail;

                return $this;
        }

        /**
        * 
         * Get the value of dateinscription
         */ 
        public function getDateinscription($format = null)
        {
                $format = ($format) ? $format : "d/m/Y, H:i:s" ;
                $formatDate = $this->dateinscription->format($format);
                return $formatDate;
        }

        /**
         * Set the value of dateinscription
         * @return  self
         */ 
        public function setDateinscription($dateinscription)
        {
                $this->dateinscription = new \DateTime($dateinscription);

                return $this;
        }


        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                if($role == null){
                        $this->role[]="ROLE_USER";
                }
                else $this->role = json_decode($role);

                return $this;
        }


        public function hasRole($role){
                return in_array($role, $this->getRole());
            }

            
        public function __toString()
        {
                return $this->getPseudonyme();
        }

    }