<?php

include('../template/header.template.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

</head>

<body>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../php/pdo.inc.php");

        $mail = $_POST["mail"];
        $password = $_POST["password"];

        // Préparer la requête SQL de vérification
        $query = "SELECT * FROM client WHERE mail_client = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($password, $user['password_client'])) {
            session_start();
            $_SESSION['user_id'] = $user['id_client'];
            $_SESSION['user_role'] = $user['role_client'];
            if ($_SESSION['user_role'] === 'Admin') {
                header("Location: client.pages.php");
            } else {
                header("Location: inscription.pages.php");
            }
            exit();
        }

        echo "";
    } else {
        echo "";
    }

    ?>

    <br>

    <div class="container">
        <div class="card">
            <h2 class="card-header">Connexion</h2>
            <form class="card-body" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class='form-control' type="email" name="mail" placeholder="Votre Email" required><br>
                <input class='form-control' type="password" name="password" placeholder="Votre Mot de passe"
                    required><br>
                <input class='btn btn-primary' type="submit" value="Se connecter">
            </form>
            <div class="card-footer">
                <p>Vous n'avez pas de compte ? <a href="inscription.pages.php">Inscrivez-vous ici</a>.</p>
            </div>
        </div>
    </div>
</body>

</html>