<?php

require '../vendor/autoload.php';

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
        $xml=simplexml_load_string($response->getBody()) or die("Error: Cannot create object");
        //print_r($xml);
        
    }

    public function getGameByID($id) {
        $response = $this->client->request('GET', 'thing?id='.$id);
        //echo $response->getStatusCode();
        //echo $response->getBody();
        $xml=simplexml_load_string($response->getBody()) or die("Error: Cannot create object");
        //print_r($xml);
    }

}

$c = new ApiGrabber();
$c->searchBoardGames("apples");
$c->getGameByID("131357");
?>
