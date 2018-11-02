<?php

class Game {

    // just use primary name for sanity
    public $name;
    public $image;
    public $description;
    public $yearpublished;
    public $minplayers;
    public $maxplayers;
    public $avgplaytime;
    public $minplaytime;
    public $maxplaytime;
    public $minage;

    // these are all links with the name of the var as the type
    // The links need to be collected together into strings available for display
    // should be arrays with strings in them
    public $boardgamecategories;
    public $boardgamemechanics;
    public $boardgamedesigners;
    public $boardgamepublishers;

}

?>
