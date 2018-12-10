<?php
// Shows the user the games in their library

include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
require_once('DB.class.php');
session_start();
if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Normie'){
    header("Location: login.php");
}

$api = new ApiGrabber();
$db = new PDO_DB();
$gameIDs = $db->getLibrary($_SESSION['username']);

?>

<div class="container" style="padding-top: 85px;">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">My Library</h1>
        </div>
    </div>

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
