<?php

class Ratings {
    private $rating;
    private $gameId;
    private $title;
    private $review;

    public function gameRating(){
        $str = "<h2>Game: {$this->title}</h2>" . 
        "<h3>Rating: {$this->rating}</h3>" . 
        "<h3>Review:</h3>" . 
        "<p class='review'> {this->$review}</p>";
        return $str;
    }
}
