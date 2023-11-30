<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C6D3F3;
            text-align: center;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            padding-top: 100px;
        }

        input[type="email"],
        input[type="password"] {
            box-shadow: 3px 3px 5px 0 rgba(0,0,0,0.3);
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-sizing: border-box; /* pour inclure le padding et border dans la largeur totale */
        }

        input[type="submit"],
        input[type="button"] {
            box-shadow: 3px 3px 5px 0 rgba(0,0,0,0.3);
            width: 100%;
            padding: 10px;
            background-color: #6F7BD9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }

        h2 {
            font-size: 96%;
            color: #333;
            text-align: center;
            margin-top: 6%;
        }
    </style>
</head>
<body>
<?php
session_start();

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la configuration de la base de données et établir la connexion PDO
    include("config.php");

    // Récupérer les données du formulaire
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    // Requête SQL pour récupérer l'utilisateur avec l'adresse e-mail fournie
    $query = "SELECT * FROM client WHERE mail_client = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe correspond
    if ($user && password_verify($password, $user["password_client"])) {
        // Connexion réussie, redirigez l'utilisateur vers la page d'accueil ou autre
        $_SESSION["user_id"] = $user["id_client"]; // Stockez l'ID de l'utilisateur dans la session par exemple
        header("Location: accueil.php");
        exit();
    } else {
        // Échec de la connexion, affichez un message d'erreur par exemple
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>
<div class="container">
    <h2>Connexion</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="email" name="mail" placeholder="Votre Email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="submit" value="Se connecter"> <br> <br>
        <input type="button" id="loginbutton" value="Pas de compte ? Créez en un juste ici !"> <br> <br>
    </form>
    <a class="link" href="Reinitialisation.html"> Mot de passe oublié ? Réinitialiser le ici !</a>
</div>
<script>
    document.getElementById("loginbutton").addEventListener("click", function() {
    // Rediriger l'utilisateur vers la page "inscription.pages.php"
    window.location.href = "inscription.pages.php";
});
</script>
</body>
</html>
