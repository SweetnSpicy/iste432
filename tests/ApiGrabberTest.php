<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../classes/api_grabber.php';

class ApiGrabberTest extends TestCase {

    private $grabber;

    public function setUp() {
        $this->grabber = new ApiGrabber();
    }

    /**
     * Tests retrieving search results for a game I know exists
     * @throws Exception
     */
    public function testSearchWithKnownGame() {
        $this->assertNotEmpty($this->grabber->searchBoardGames("coup"));
    }

    /**
     * Tests getting a single game with a vild ID
     * @throws Exception
     */
    public function testGetSingleGame() {
        $game = $this->grabber->getGameByID("131357");
        $this->assertSame("Coup",$game->name, "Known game to exist, retrieves wrong name");
    }

    /**
     * Tests getting a single game with an invalid ID
     * @throws Exception
     */
    public function testGetSingleGameNotValid() {
        $game = $this->grabber->getGameByID('-1');
        $this->assertEmpty($game, "Should be empty because the id in invalid");
    }


}
