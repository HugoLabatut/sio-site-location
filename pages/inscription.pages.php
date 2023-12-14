<?php

include('../template/header.template.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../include/pdo.inc.php");

        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $rue = $_POST["rue"];
        $codePostal = $_POST["code_postal"];
        $ville = $_POST["ville"];
        $mail = $_POST["mail"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $query = "INSERT INTO client (nom_client, prenom_client, rue_client, cop_client, ville_client, mail_client, password_client, statue_client, valid_client) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0)";

        $stmt = $con->prepare($query);
        $stmt->execute([$nom, $prenom, $rue, $codePostal, $ville, $mail, $password]);

        echo "Inscription réussie !";
    }
    ?>

    <br>

    <div class="container">
        <div class="card">
            <h2 class='card-header'>Inscription</h2>
            <form class='card-body' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="return registerUser()">
                <input class='form-control' type="text" name="nom" placeholder="Votre Nom" required><br>
                <input class='form-control' type="text" name="prenom" placeholder="Votre Prénom" required><br>
                <input class='form-control' type="text" name="rue" placeholder="Votre Adresse" required><br>
                <input class='form-control' type="text" name="code_postal" id="codePostal" oninput="autocompleteVille()"
                    placeholder="Votre Code Postal" required><br>
                <input class='form-control' type="text" name="ville" id="ville" placeholder="Votre Ville" required>
                <div id="villeAutocomplete"></div>
                <br>
                <input class='form-control' type="email" name="mail" placeholder="Votre Email" required><br>
                <input class='form-control' type="password" name="password" id="password"
                    placeholder="Votre Mot de passe" required><br>
                <input class='form-control' type="password" id="password2"
                    placeholder="Veuillez ressaisir votre Mot de passe" required>
                <div id="passwordError" style="color: red;"></div>
                <br>
                <input class="form-control btn btn-primary" type="submit" value="Créer le compte">
            </form>
            <div class="card-footer">
                <input class='btn btn-primary' type="button" id="loginButton"
                    value="Déjà inscrit ? Identifiez-vous ici !">
            </div>
        </div>
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

        document.getElementById("loginButton").addEventListener("click", function () {
            window.location.href = "connexion.pages.php";
        });
    </script>

</body>

</html>