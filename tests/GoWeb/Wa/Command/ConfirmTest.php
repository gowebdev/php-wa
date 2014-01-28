<?php

namespace GoWeb\Wa\Command;

class StatusTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testSend()
    {
        $wa = new \GoWeb\Wa;
        $wa
            ->setServer('http://example.com')
            ->setCredentials('login@server.com', 'p4ssword')
            ->setToken('==token==');
        
        // prepare response
        $response = new \Guzzle\Http\Message\Response(200);
        $response->setBody(json_encode(array(
            'queryparams' => array(
                'exp' => '1390566182',
                'qid' => '3081',
                'uid' => '1',
                'sign' => 'NZGpQbGmiUaoRaOAVtnjLg'
             ),
             'status' => 0,
             'errno' => 'All OK',
             'command' => 'confirm'
        )));
        
        // replace response
        $plugin = new \Guzzle\Plugin\Mock\MockPlugin;
        $plugin->addResponse($response);
        
        $wa
            ->getConnection()
            ->addSubscriber($plugin);
        
        $response = $wa
            ->createCommand('confirm')
            ->setCategory(\GoWeb\Wa\Command\Status::CATEGORY_VOD)
            ->setFileId(3081)
            ->setIp('4.4.4.4')
            ->send();
        
        $this->assertEquals(
            '0',
            $response->getStatus()
        );
        
    }
}