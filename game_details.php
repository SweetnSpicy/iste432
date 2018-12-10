<?php
// Displays the details for a single game
include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
require_once('DB.class.php');
session_start();
if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Normie'){
    header("Location: login.php");
}
$db = new PDO_DB();

$api = new ApiGrabber();

$game = null;
$gameID = null;

if (isset($_GET["gameID"])) {
    $game = $api->getGameByID($_GET["gameID"]);
    $gameID = $_GET["gameID"];
}

if (isset($_POST['removeGame'])){
    $db->deleteFromLibrary($_SESSION['username'], $_POST['removeGame']);
    $game = $api->getGameByID($_POST['removeGame']);
    $gameID = $_POST['removeGame'];
}
if (isset($_POST['addGame'])){
    $db->insertGameIntoLibrary($_SESSION['username'], $_POST['addGame']);
    $game = $api->getGameByID($_POST['addGame']);
    $gameID = $_POST['addGame'];
}

?>

<div class="container" style="padding-top: 85px;">
    <div class="row mb-4">
        <div class="col">
            <?php
                echo "<img src='{$game->image}' alt='{$game->name}' class='img-fluid mx-auto d-block'>";
            ?>
        </div>
        <div class="col">
            <?php
                echo "
                    <h1>{$game->name}</h1>
                    <h3>Players: {$game->minPlayers} - {$game->maxPlayers}</h3>
                    <h3>Ages {$game->minAge}+</h3>
                    <h3>Playtime: {$game->minPlaytime} - {$game->maxPlaytime}</h3>
                    <h3>Average Playtime: {$game->avgPlaytime} Mins</h3>
                    <h3>Year Published: {$game->yearPublished}</h3>
                ";
                if ($db->getInUsersLibrary($_SESSION['username'], $gameID)){
                    echo "
                        <form method='post' role='form' action='game_details.php'>
                            <button type='submit' name='removeGame' value='{$gameID}' class='btn btn-danger'>Remove from Library</button>
                        </form>
                    ";
                }
                else {
                    echo "
                        <form method='post' role='form' action='game_details.php'>
                            <button type='submit' name='addGame'  value='{$gameID}' class='btn btn-dark'>Add to Library</button>
                        </form>
                    ";
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Description: </h2>
            <?php
                echo "<p>{$game->description}</p>";
            ?>
        </div>
    </div>
</div>
