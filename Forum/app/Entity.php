<?php
    namespace app;

    abstract class Entity{

        protected function hydrate($data){

            foreach($data as $field => $value){

                //field = sujet_id
                //fieldarray = ['sujet','id']
                $fieldArray = explode("_", $field);

                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                    $manName = ucfirst($fieldArray[0])."Manager";
                    $FQCName = "model\Managers".DS.$manName;
                    
                    $man = new $FQCName();
                    $value = $man->findOneById($value);
                }
                
                $method = "set".ucfirst($fieldArray[0]);
                if(method_exists($this, $method)){
                    $this->$method($value);
                }

            }
        }

        public function getClass(){
            return get_class($this);
        }
    }



