<?php

require '../vendor/autoload.php';
require 'game_abbrv.php';

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
        //$xml=simplexml_load_string($response->getBody()) or die("Error: Cannot create object");
        //print_r($xml);
    }

}

$c = new ApiGrabber();
$c->searchBoardGames("apples");
$c->getGameByID("131357");
?>
