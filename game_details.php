<?php
// Displays the details for a single game
include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
?>

<div class="container" style="padding-top: 85px;">
    <div class="row">
        <div class="col">
            <?php
                $api = new ApiGrabber();
                // TODO: grab id from a post dynamically
                $game = $api->getGameByID("131357");
                $gameOut = "
                    <h1>{$game->name}</h1>
                    <p>{$game->description}</p>
                    <p>Year Published: {$game->yearPublished}</p>
                    <p>Minimum Players: {$game->minPlayers}</p>
                    <p>Maximum Players: {$game->maxPlayers}</p>
                    <p>Average Playtime: {$game->avgPlaytime}</p>
                    <p>Minimum Playtime: {$game->minPlaytime}</p>
                    <p>Maximum Playtime: {$game->maxPlaytime}</p>
                    <p>Min Age: {$game->minAge}</p>
                ";
                echo $gameOut;
            ?>
        </div>
    </div>
</div>
