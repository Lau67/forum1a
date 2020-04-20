<?php
	namespace app;
	
	class Autoloader{

		public static function register(){
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		public static function autoload($class){

			//$class = model\Managers\SujetManager (FullyQualifiedClassName)   ?ou?MessageManager?
			//namespace = model\Managers, nom de la classe = SujetManager

			// on explose notre variable $class par \
			$parts = preg_split('#\\\#', $class);
			//$parts = ['Model', 'Managers', 'SujetManager']

			// on extrait le dernier element 
			$className = array_pop($parts);
			//$className = SujetManager

			// on créé le chemin vers la classe
			// on utilise DS car plus propre et meilleure portabilité entre les différents systèmes (windows/linux) 

			$path = strtolower(implode(DS, $parts));
			//$path = 'model/managers'
			$file = $className.'.php';
			//$file = SujetManager.php

			$filepath = BASE_DIR.$path.DS.$file;
			//$filepath = model/managers/SujetManager.php
			if(file_exists($filepath)){
				require $filepath;
			}
			
		}
	}