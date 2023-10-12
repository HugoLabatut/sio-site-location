<!--
    ===========================================
    =========== SIO SITE LOCATION =============
    ====== Date de début : 14 sept. 2023 ======
    ===== Développement Front-end : CVt =======
    ====== Développement Back-end : HLt =======
    ========= Développement BDD : EQy =========
    ===========================================
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<body>
    <div th:fragment="header">
        <nav class="navbar navbar-expand-sm navbar-light bg-light" th:if="${AUTHENTIFIE}">  
            <a class="navbar-brand mb-0 h1" src="../res/logo/logérance-logo.png" th:href="@{/main}">Logérance</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        href="#" 
                        id="navbarDropdownUser" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false" 
                        th:text="${USER_NAME != null ? USER_NAME : 'Connecté'}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" th:href="test">Modifier une association</a>
                        <a class="dropdown-item" th:href="#">Création d'un utilisateur</a>
                        <a class="dropdown-item" th:href="#">Modifier mon compte</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" th:href="#">Liste des patient</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" th:href="#">Déconnexion</a>
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalSupAccount">
                            Suppression de vôtre compte
                        </button>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</body>

<footer th:fragment="footerfiles">
        <script src="lib/jquery/jquery-3.5.1.min.js"></script>
        <script src="lib/bootstrap/popper.min.js"></script>
        <script src="lib/bootstrap/bootstrap.min.js"></script>
        <script>
            function showHidePwd(idPwd, idBtn) {
                const input = document.getElementById(idPwd);
                const btn = document.getElementById(idBtn);
                
                btn.addEventListener("mousedown", e => {
                    input.setAttribute("type", "text");
                    btn.className = "fa fa-eye fa-lg";
                });
                
                window.addEventListener("mouseup", e => {
                    if(Object.is(input.getAttribute("type"), "text")) {
                        input.setAttribute("type", "password");
                        btn.className = "fa fa-eye-slash fa-lg";
                    }
                });
            }
        </script>
    </footer>