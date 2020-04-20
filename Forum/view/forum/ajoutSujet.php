

<h1>Créer un nouveau sujet</h1>

<h3>Détails du sujet</h3>

<form action="index.php?ctrl=foruma&action=ajoutSujet" method="post">
    
    <p><label for="titre">Titre :</label></p>
    <p><input type="text" name="titre" placeholder="Tapez votre titre" required></p><br>
    
    <p><label for="message">Message:</label></p>
    <p><textarea id="newmessage" name="texte" placeholder="Tapez votre message" rows="6" ></textarea></p><br>
    
    <p>
        <input class="" id="valid" type='submit' value="Créer le sujet">
    </p>
</form>


