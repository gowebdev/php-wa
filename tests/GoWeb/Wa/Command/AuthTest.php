<?php

namespace GoWeb\Wa\Command;

class AuthTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testSend()
    {
        $wa = new \GoWeb\Wa;
        $wa
            ->setServer('http://example.com')
            ->setCredentials('login@server.com', 'p4ssword');
        
        // prepare response
        $response = new \Guzzle\Http\Message\Response(200);
        $response->setBody(json_encode(array(
            'uid'       => 1,
            'runtime'   => 0.0883100032806396,
            'status'    => 0,
            'token'     => '073772ed002e7fcb975aafeb6346f6d0',
            'errno'     => 'All OK',
            'login'     => 'pasha',
            'command'   => 'auth',
        )));
        
        // replace response
        $plugin = new \Guzzle\Plugin\Mock\MockPlugin;
        $plugin->addResponse($response);
        
        $wa
            ->getConnection()
            ->addSubscriber($plugin);
        
        $response = $wa->createCommand('auth')->send();
        
        $this->assertEquals('073772ed002e7fcb975aafeb6346f6d0', $response->token);
        
    }
}