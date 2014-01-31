<?php

namespace GoWeb\Wa;

class CommandTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testGetCommandName()
    {
        $uploadCommand = new \GoWeb\Wa\Command\Upload(new \GoWeb\Wa);
        
        $this->assertEquals('upload', $uploadCommand->getCommandName());
    }
}