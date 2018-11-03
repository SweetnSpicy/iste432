<?php

class Game {

    // just use primary name for sanity
    public $name;
    public $image;
    public $description;
    public $yearPublished;
    public $minPlayers;
    public $maxPlayers;
    public $avgPlaytime;
    public $minPlaytime;
    public $maxPlaytime;
    public $minAge;

    // these are all links with the name of the var as the type
    // The links need to be collected together into strings available for display
    // should be arrays with strings in them
    public $boardGameCategories;
    public $boardGameMechanics;
    public $boardGameDesigners;
    public $boardGamePublishers;


    public function __construct($name, $image, $description, $yearPublished, $minPlayers, $maxPlayers, $avgPlaytime, $minPlaytime, $maxPlaytime, $minAge) {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->yearPublished = $yearPublished;
        $this->minPlayers = $minPlayers;
        $this->maxPlayers = $maxPlayers;
        $this->avgPlaytime = $avgPlaytime;
        $this->minPlaytime = $minPlaytime;
        $this->maxPlaytime = $maxPlaytime;
        $this->minAge = $minAge;

        $this->boardGameCategories = null;
        $this->boardGameMechanics = null;
        $this->boardGameDesigners = null;
        $this->boardGamePublishers = null;
    }

}

?>
