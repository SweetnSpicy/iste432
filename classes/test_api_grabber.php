<?php

require 'api_grabber.php';


$c = new ApiGrabber();
//print_r($c->searchBoardGames("apples")[0]->prettyPrint());
print_r("Test getting all from a search</br>");
$list = $c->searchBoardGames("apples");
foreach($list as $game){
    print_r($game->prettyPrint());
}
print_r("</br>Test Getting A single game by ID</br>");
print_r($c->getGameByID("131357")->prettyPrint());

?>