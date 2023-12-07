<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
</head>
<body>

<?php
session_start();


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de configuration de la base de données
    require_once "config2.php";

    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Préparer la requête SQL
    $sql = "SELECT * FROM clients WHERE email = ? AND password = ?";
    
    // Utiliser des requêtes préparées pour éviter les injections SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe dans la base de données
    if ($user) {
        // Enregistrez l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];

        // Rediriger vers le tableau de bord ou une autre page sécurisée
        header("Location: inscription.pages.php");
        exit();
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>

<h2>Connexion</h2>
<form method="post" action="">
    <label for="username">Votre mail:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Se connecter">
</form>

</body>
</html>
