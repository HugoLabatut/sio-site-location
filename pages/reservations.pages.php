<!-- 
========= Site location
========= calendrier.pages.php
========= Template du calendrier
========= Date création : 23 nov. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/reservation.class.php");
require_once("../class/bien.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations - Logérance</title>
</head>

<body>
    <?php include("../template/header.template.php"); ?>
    <main>
        <link href="../css/fullcalendar.css" rel="stylesheet" />
        <link href="../css/fullcalendar.print.css" rel="stylesheet" media="print" />
        <script src="../js/moment.min.js"></script>
        <script src="../js/fullcalendar.js"></script>
        <script type="text/javascript" src="../js/calendrier.js"></script>


        <!-- add calander in this div -->
        <div class="container">
            <div class="row">
                <div id="calendar"></div>

            </div>
        </div>


        <!-- Modal -->
        <div id="createEventModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Créer une réservation : </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <p>Pour le bien [CODER LA FONCTION POUR LES BIENS]</p>
                            <label class="control-label" for="inputPatient">Choisir une période :</label>
                            <div class="field desc">
                                <label for="" class="control-label" id="startTime">Début : </label>
                                <input type="date" id="startTime" />
                                <label for="" class="control-label" id="endTime">Fin : </label>
                                <input type="date" id="endTime" />
                            </div>
                            <label for="" class="control-label">Commentaire : </label>
                            <div class="field desc">
                                <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Réserver</button>
                    </div>
                </div>

            </div>
        </div>


        <div id="calendarModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Event Details</h4>
                    </div>
                    <div id="modalBody" class="modal-body">
                        <h4 id="modalTitle" class="modal-title"></h4>
                        <div id="modalWhen" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID" />
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal-->


        <div style='margin-left: auto;margin-right: auto;text-align: center;'>
        </div>

</body>

</html>
</body>

</html>