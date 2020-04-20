<?php
   $sujet = $result["data"]["sujet"];
   $messages = $result["data"]["message"];

    echo "<h1>Messages du sujet ", $sujet, "</h1>";

    if(!empty($messages)){
        foreach($messages as $m){

            echo "<p>",
                    "<a href='?ctrl=forum&action=voir&id=", $m->getId(), "'>", $m, "</a>",
                "</p>";
        }
    }
    else echo "<p>Pas de messages disponibles...</p>";
       