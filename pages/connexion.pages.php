<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C6D3F3;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            padding-top: 5%;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, 0.3);
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        input[type="submit"],
        input[type="button"] {
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, 0.3);
            width: 100%;
            padding: 10px;
            background-color: #6F7BD9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }

        input[type="submit"] {
            margin-bottom: 20px;
        }

        #villeAutocomplete {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }

        #villeAutocomplete div {
            padding: 10px;
            cursor: pointer;
        }

        #villeAutocomplete div:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("config.php");

    $mail = $_POST["mail"];
    $password = $_POST["password"];

    // Préparer la requête SQL de vérification
    $query = "SELECT * FROM client WHERE mail_client = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Avant la vérification if ($user && password_verify($password, $user['password_client'])) {
echo "Mot de passe saisi : " . $password . "<br>";
echo "Mot de passe haché dans la base de données : " . $user['password_client'] . "<br>";
echo "Résultat de password_verify : " . var_export(password_verify($password, $user['password_client']), true) . "<br>";


    if ($user && password_verify($password, $user['password_client'])) {
        echo "Connexion réussie !";
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>

<div class="container">
    <h2>Connexion</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="email" name="mail" placeholder="Votre Email" required><br>
        <input type="password" name="password" placeholder="Votre Mot de passe" required><br>
        <input type="submit" value="Se connecter">
    </form>
    <p>Vous n'avez pas de compte ? <a href="inscription.pages.php">Inscrivez-vous ici</a>.</p>
</div>
