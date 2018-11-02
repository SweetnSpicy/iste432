<?php

// Abbreviated game info that shows up with a search
class GameAbbrv {

    private $id;
    private $name;
    private $yrpulished;

    public function __construct($id, $name, $yrpublished) {
        $this->id = $id;
        $this->name = $name;
        $this->yrpublished = $yrpublished;
    }

    public function getID() {
        return $id;
    }

    public function getName() {
        return $name;
    }

    public function getYrPublished() {
        return $yrpublished;
    }

    public function prettyPrint() {
        return "ID: " . $id . "Name: " . $name . "Year Published: " . $yrpublished . "</br>";
    }

}

?>
