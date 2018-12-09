<?php
// Search for a boardgame
include "assets/inc/main_header.php";
require_once __DIR__.'/classes/api_grabber.php';
$api = new ApiGrabber();

$games = null;

if (isset($_GET["submit"])) {
    $games = $api->searchBoardGames($_GET["searchText"]);
}
?>

<div class="container" style="padding-top: 85px;">
    <div class="row mb-4">
        <div class="col">
            <h1 class="text-center mb-3">Search Games</h1>
            <form method="get" role="form" action="search.php">
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                            <input type="text" class="form-control" name="searchText" placeholder="Game name">
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" name="submit" value="send" class="btn btn-dark mb-2">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        foreach($games as $game){
            echo "
                <div class='row'>
                    <div class='col'>
                        <div class='card mb-3'>
                            <div class='card-body'>
                                <div>
                                    <h5 class='card-title'>{$game->getName()}</h5>
                                    <p>Year published: {$game->getYrPublished()}</p>
                                    <form method='get' role='form' action='game_details.php'>
                                        <button type='submit' name='gameID' value='{$game->getID()}' class='btn btn-outline-dark'>Game Details</button>
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