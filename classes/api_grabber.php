<?php

require __DIR__.'/../vendor/autoload.php'; //Got rid of for ApiGrabberTest
require 'game_abbrv.php';
require 'game.php';

use GuzzleHttp\Client;

/**
 * Class ApiGrabber
 * Is the class that opens a connection to the API, grabs data as xml, and loads it into model classes
 * API docs: https://boardgamegeek.com/wiki/page/BGG_XML_API2
 * It uses Guzzle to connect to the API and make calls: http://docs.guzzlephp.org/en/stable/
 */
class ApiGrabber {

    public $client;

    /**
     * ApiGrabber constructor.
     * Opens a connection to the API
     */
    public function __construct() {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://www.boardgamegeek.com/xmlapi2/',
        ]);
    }

    /**
     * Searches games using the inputted string
     * Hits the API using the input then parses the returned XML into GameAbbrv objects
     *
     * @param $searchinput String to use in search
     * @return array Made of GameAbbrv objects
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
        return $games;
    }

    /**
     * Uses the given game ID to find more details about the game
     * Hits the API using the id then parses the returned XML into Game objects
     *
     * @param $id String of the number id of the game
     * @return Game|null Game object containing details about the game
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
        return $game;
    }

}

?>
