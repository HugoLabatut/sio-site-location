<!--
    ===========================================
    =========== SIO SITE LOCATION =============
    ====== Date de début : 14 sept. 2023 ======
    ===== Développement Front-end : CVt =======
    ====== Développement Back-end : HLt =======
    ========= Développement BDD : EQy =========
    ===========================================
-->

<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">

<head>
    <title>Accueil - Logérance</title>
</head>

<body>
    <?php include("template/header.template.php"); ?>
    <div class="container-fluid" style="margin-top:1em">
        <div class="row">
            <div class="col-12 col-lg-2" id="formSection">
                <!-- formulaire d'edition des clients -->
                <form class="card" th:action="@{/sauvegardecompte}" method="post" th:if="${COMPTE_SELECTIONNEE != null}">
                    <div class="card-header">
                        <h2 text align="center" th:text="${COMPTE_SELECTIONNEE != null && COMPTE_SELECTIONNEE.nomclientPresent()} ? ${COMPTE_SELECTIONNEE.nomclient} + ' ' + ${COMPTE_SELECTIONNEE.prenomclient} : ''">
                        </h2>
                    </div>
                    <div class="card-body" id="compteForm">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert" th:if="${ENREGISTREMENT_OK}">
                                        L'enregistrement s'est bien effectué
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="alert alert-danger" role="alert" th:if="${MSG_ERREUR != null}" th:text="${MSG_ERREUR}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-12">
                                <label for="nomclient">Nom du client *</label>
                                <input type="text" class="form-control" id="nomclient" name="nomclient" autocomplete="off" th:value="${COMPTE_SELECTIONNEE != null} ? ${COMPTE_SELECTIONNEE.nomclient} : ''">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-12">
                                <label for="prenomclient">Prénom du client *</label>
                                <input type="text" class="form-control" id="prenomclient" name="prenom" autocomplete="off" th:value="${COMPTE_SELECTIONNEE != null} ? ${COMPTE_SELECTIONNEE.prenom} : ''">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-12">
                                <label for="numeroclient">Téléphone *</label>
                                <input type="text" class="form-control" id="numeroclient" name="numeroclient" autocomplete="off" th:value="${COMPTE_SELECTIONNEE != null} ? ${COMPTE_SELECTIONNEE.numeroMobile} : ''">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-12">
                                <label for="emailCompte">Adresse mail *</label>
                                <input type="text" class="form-control" id="emailCompte" name="email" autocomplete="off" th:value="${COMPTE_SELECTIONNEE != null} ? ${COMPTE_SELECTIONNEE.email} : ''">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="sessionBloquee" id="compteActif" name="sessionBloquee" style="width:15px;height:15px" th:checked="${COMPTE_SELECTIONNEE != null} ? ${COMPTE_SELECTIONNEE.isSessionBloquee()} : false">
                                    <label class="form-check-label" for="compteActif">
                                        Utilisateur bloqué
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-10" id="comptesSection">
                <div class="card">
                    <div class="card-header">
                        <h1 align="center">Liste des clients</h1>
                    </div>
                    <form th:action="@{/search}">
                        <div class="card-header">
                            <table>
                                <thead>
                                    <tr>
                                        <h3>Nom / Prenom Email Téléphone</h3>
                                        <th>
                                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Rechercher un client" th:value="${keyword}" required />
                                        </th>
                                        <th>
                                            <button type="submit" value="Search" class="btn btn-primary">Rechercher</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="list-group" style="overflow-y:auto" id="listeCompte">
                                        <th:block th:each="comptePatient : ${COMPTES}" th:field="${l}">
                                            <td class="list-group-item list-group-item-action" th:classappend="${comptePatient.selectionne} ? active : ''">
                                                <a th:text="${comptePatient.nomclient}+ ' ' + ${comptePatient.prenom}" th:href="@{/listecompte(compteId=${comptePatient.idCompte})}" th:class="${comptePatient.selectionne} ? text-light : ''">
                                                </a>
                                                <a th:text="${comptePatient.email}" th:href="@{/listecompte(compteId=${comptePatient.idCompte})}" th:class="${comptePatient.selectionne} ? text-light : ''">
                                                </a>
                                                <a th:text="${comptePatient.numeroMobile}" th:href="@{/listecompte(compteId=${comptePatient.idCompte})}" th:class="${comptePatient.selectionne} ? text-light : ''">
                                                </a>
                                            </td>
                                        </th:block>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>