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
            'runtime'  => 0.0943300724029541,
            'status'  => 0,
            'fileinfo'  => array(
               'wa_user'  => '1',
               'wa_stranscoder'  => '4',
               'compatible_id'  => '',
               'oformat'  => 100,
               'confirmator'  => null,
               'wa_storage'  => '9',
               'created'  => '2014-01-24 10 =>44 =>18.18321+02',
               'laststate'  => 'stra_t_queued',
               'url2'  => null,
               'infohash'  => null,
               'updated'  => '2014-01-24 10 =>44 =>18.18321+02',
               'id'  => '3081',
               'category'  => 'vod',
               'url1'  => null
            ),
            'errno'  => 'All OK',
            'command'  => 'status'
        )));
        
        // replace response
        $plugin = new \Guzzle\Plugin\Mock\MockPlugin;
        $plugin->addResponse($response);
        
        $wa
            ->getConnection()
            ->addSubscriber($plugin);
        
        $response = $wa
            ->createCommand('status')
            ->setCategory(\GoWeb\Wa\Command\Status::CATEGORY_VOD)
            ->setFileId(3081)
            ->setIp('4.4.4.4')
            ->send();
        
        $this->assertEquals(
            'stra_t_queued',
            $response->getLastState()
        );
        
    }
}