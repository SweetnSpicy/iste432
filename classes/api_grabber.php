<?php

require '../vendor/autoload.php';
require 'game_abbrv.php';
require 'game.php';

use GuzzleHttp\Client;

class ApiGrabber {

    public $client;

    public function __construct() {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://www.boardgamegeek.com/xmlapi2/',
        ]);
    }
    
    public function searchBoardGames($searchinput) {
        $response = $this->client->request('GET', 'search?query='.$searchinput);
        //echo $response->getStatusCode();
        //echo $response->getBody();
        $xml = new SimpleXMLElement($response->getBody());
        $games = array();
        foreach($xml->{'item'} as $item) {
            $id = (string) $item->attributes()->{'id'};
            $name = (string) $item->{'name'}->attributes()->{'value'};
            $yrpublished = "Unknown";
            if (count($item) > 1) {
                $yrpublished = (string) $item->{'yearpublished'}->attributes()->{'value'};
            }
            $games[] = new GameAbbrv($id, $name, $yrpublished);
        }
        print_r($games);
    }

    public function getGameByID($id) {
        $response = $this->client->request('GET', 'thing?id='.$id);
        //echo $response->getStatusCode();
        //echo $response->getBody();
        $xml = new SimpleXMLElement($response->getBody());
        $game = null;
        foreach($xml->{'item'} as $item) {
            $name = "";
            $primary = $item->xpath('//name[@type="primary"]');
            if ($primary){
                $name = (string) $primary[0]->attributes()->{'value'};
            }
            $image = (string) $item->{'image'};
            $description = (string) $item->{'description'};
            $yearPublished = (string) $item->{'yearpublished'}->attributes()->{'value'};
            $minPlayers = (string) $item->{'minplayers'}->attributes()->{'value'};
            $maxPlayers = (string) $item->{'maxplayers'}->attributes()->{'value'};
            $avgPlaytime = (string) $item->{'playingtime'}->attributes()->{'value'};;
            $minPlaytime = (string) $item->{'minplaytime'}->attributes()->{'value'};
            $maxPlaytime = (string) $item->{'maxplayers'}->attributes()->{'value'};
            $minAge = (string) $item->{'minage'}->attributes()->{'value'};
            $game = new Game($name, $image, $description, $yearPublished, $minPlayers, $maxPlayers, $avgPlaytime, $minPlaytime, $maxPlaytime, $minAge);
        }
        print_r($game);
    }

}

$c = new ApiGrabber();
//$c->searchBoardGames("apples");
$c->getGameByID("131357");
?>
