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
        echo $response->getStatusCode();
        echo $response->getBody();
    }

    public function getGameByID($id) {
        $response = $this->client->request('GET', 'thing?id='.$id);
        echo $response->getStatusCode();
        echo $response->getBody();
    }

}

$c = new ApiGrabber();
$c->searchBoardGames("apples");
$c->getGameByID("131357");
?>
