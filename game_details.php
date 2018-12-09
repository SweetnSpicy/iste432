<?php
// Displays the details for a single game
include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
$api = new ApiGrabber();

$game = null;

if (isset($_GET["gameID"])) {
    $game = $api->getGameByID($_GET["gameID"]);
}

//$game = $api->getGameByID("131357");

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
