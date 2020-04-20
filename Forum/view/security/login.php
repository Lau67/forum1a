<a href="index.php?ctrl">Retour à l'accueil</a>

<h2>Se connecter</h2>

<p>Vous n'avez pas de compte ? <a href="index.php?ctrl=security&action=register">S'inscrire</a></p>

    <form method="post" action="index.php?ctrl=security&action=login">

        <p>Nom d'utilisateur</p>
        <input type="text" name="pseudonyme" placeholder="Votre pseudo ou votre e-mail" required><br>

        <p>Mot de passe</p>
        <input type="password" name="pass" placeholder="Votre mot de passe" required><br>
        <br>
        <input type="submit" value="Connexion">
    </form>

