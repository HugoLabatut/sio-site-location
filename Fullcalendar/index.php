<?php
session_start();
include("database.php");

// Informations de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=Fullcalendar';
$username = 'root';
$password = '';

try {
    // Création de l'objet de connexion PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = session_id();
    }

    $uid = $_SESSION['user'];
    $datetime_string = date('c', time());

    if (isset($_POST['action']) or isset($_GET['view'])) {
        if (isset($_GET['view'])) {
            header('Content-Type: application/json');
            $start = $_GET["start"];
            $end = $_GET["end"];

            $stmt = $pdo->prepare("SELECT `id`, `start`, `end`, `title` FROM `events` WHERE (DATE(start) >= :start AND DATE(start) <= :end) AND uid = :uid");
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();

            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($events);
            exit;
        } elseif ($_POST['action'] == "add") {
            $title = $_POST["title"];
            $start = date('Y-m-d H:i:s', strtotime($_POST["start"]));
            $end = date('Y-m-d H:i:s', strtotime($_POST["end"]));

            $stmt = $pdo->prepare("INSERT INTO `events` (`title`, `start`, `end`, `uid`) VALUES (:title, :start, :end, :uid)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();

            header('Content-Type: application/json');
            echo '{"id":"' . $pdo->lastInsertId() . '"}';
            exit;
        } elseif ($_POST['action'] == "update") {
            $start = date('Y-m-d H:i:s', strtotime($_POST["start"]));
            $end = date('Y-m-d H:i:s', strtotime($_POST["end"]));
            $id = $_POST["id"];

            $stmt = $pdo->prepare("UPDATE `events` SET `start` = :start, `end` = :end WHERE uid = :uid AND id = :id");
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            exit;
        } elseif ($_POST['action'] == "delete") {
            $id = $_POST["id"];

            $stmt = $pdo->prepare("DELETE FROM `events` WHERE uid = :uid AND id = :id");
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "1";
            }
            exit;
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>jQuery Fullcalendar Integration with Bootstrap, PHP & MySQL | PHPLift.net</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <style type="text/css">
        img {border-width: 0}

        * {font-family: 'Lucida Grande', sans-serif;}
    </style>
</head>
<body>
    <hr/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/fullcalendar.css" rel="stylesheet"/>
    <link href="css/fullcalendar.print.css" rel="stylesheet" media="print"/>
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>

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
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Event</h4>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label" for="inputPatient">Event:</label>
                        <div class="field desc">
                            <input class="form-control" id="title" name="title" placeholder="Event" type="text"
                                   value="">
                        </div>
                    </div>

                    <input type="hidden" id="startTime"/>
                    <input type="hidden" id="endTime"/>

                    <div class="control-group">
                        <label class="control-label" for="when">When:</label>
                        <div class="controls controls-row" id="when" style="margin-top:5px;">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
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
                <input type="hidden" id="eventID"/>
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
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-21769945-4', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>