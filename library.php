<?php
// Shows the user the games in their library

include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
$api = new ApiGrabber();

// TODO: Replace with actually getting a list of the user's games in their library
$gameIDs = ['124742', '131357'];

?>

<div class="container" style="padding-top: 85px;">

<?php
foreach($gameIDs as $gameID){
    $game = $api->getGameByID($gameID);
    echo "
                <div class='row'>
                    <div class='col'>
                        <div class='card mb-3'>
                            <div class='card-body'>
                                <div>
                                    <h5 class='card-title'>{$game->name}</h5>
                                    <p>Players: {$game->minPlayers} - {$game->maxPlayers}</p>
                                    <p>Ages {$game->minAge}+</p>
                                    <p>Average Playtime: {$game->avgPlaytime} Mins</p>
                                    <form method='get' role='form' action='game_details.php'>
                                        <button type='submit' name='gameID' value='{$gameID}' class='btn btn-outline-dark'>Game Details</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
}
?>

</div>
</body>
