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
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getYrPublished() {
        return $this->yrpublished;
    }

    public function prettyPrint() {
        return "ID: " . $this->id . "Name: " . $this->name . "Year Published: " . $this->yrpublished . "</br>";
    }

}

?>
