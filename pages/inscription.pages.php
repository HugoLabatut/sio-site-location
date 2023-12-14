<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $rue = $_POST["rue"];
    $codePostal = $_POST["code_postal"];
    $ville = $_POST["ville"];
    $mail = $_POST["mail"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO client (nom_client, prenom_client, rue_client, cop_client, ville_client, mail_client, password_client, statue_client, valid_client) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$nom, $prenom, $rue, $codePostal, $ville, $mail, $password]);

    echo "Inscription réussie !";
}
?>

<div class="container">
    <h2>Inscription</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return registerUser()">
        <input type="text" name="nom" placeholder="Votre Nom" required><br>
        <input type="text" name="prenom" placeholder="Votre Prénom" required><br>
        <input type="text" name="rue" placeholder="Votre Adresse" required><br>
        <input type="text" name="code_postal" id="codePostal" oninput="autocompleteVille()" placeholder="Votre Code Postal" required><br>
        <input type="text" name="ville" id="ville" placeholder="Votre Ville" required>
        <div id="villeAutocomplete"></div>
        <br>
        <input type="email" name="mail" placeholder="Votre Email" required><br>
        <input type="password" name="password" id="password" placeholder="Votre Mot de passe" required><br>
        <input type="password" id="password2" placeholder="Veuillez ressaisir votre Mot de passe" required>
        <div id="passwordError" style="color: red;"></div>
        <input type="submit" value="Créer le compte">
        <input type="button" id="loginButton" value="Déjà inscrit ? Identifiez-vous ici !">
    </form>
</div>

<script>
function registerUser() {
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var passwordError = document.getElementById("passwordError");

    var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{12,}$/;

    if (!passwordPattern.test(password)) {
        passwordError.textContent = "Le mot de passe ne respecte pas les règles de sécurité. Le mot de passe doit être composé d'au moins 12 caractères, de majuscules, minuscules, caractères spéciaux ainsi que des chiffres.";
        return false;
    } else {
        passwordError.textContent = ""; 
    }

    if (password !== password2) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }

    return true; 
}

document.getElementById("loginButton").addEventListener("click", function() {
    window.location.href = "connexion.pages.php";
});
</script>

</body>
</html>