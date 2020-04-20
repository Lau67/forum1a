<a href="index.php?ctrl">Retour à l'accueil</a>

<h2>S'inscrire</h2>

<p>Utilisateur existant? <a href="index.php?ctrl=security&action=login">Se connecter</a></p>

    <form method="post" action="index.php?ctrl=security&action=register" enctype="multipart/form-data">
    
        <p>Nom d'utilisateur *</p>
        <input type="text" name="pseudonyme" placeholder="Votre pseudo" required><br>

        <p>Adresse mail *</p>
		<input type="email" name="adressemail" placeholder="Votre E-mail" required><br>
        
        <p>Mot de passe *<span>(Le mot de passe doit comporter au moins 6 caractères, seuls les lettres et les chiffres sont autorisés)</span></p>
        <input type="password" name="pass" placeholder="Votre mot de passe" required><br>
        
        <p>Confirmer le mot de passe *</p>
		<input type="password" name="pass-r" placeholder="Répétez le mot de passe" required><br>
		<br>
        <input type="checkbox" name="netiquette" value="yes" />Je suis d'accord avec les conditions d'utilisation et la politique de confidentialité<br>
        <br>
        <input type="submit" value="Créer mon compte">
        
    </form>
    

