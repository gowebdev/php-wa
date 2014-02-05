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
            'runtime'  =>  0.101509809494019,
            'strerror' => 'All OK',
            'fileinfo' => array(
                array(
                    'wa_user' => '18',
                    'oformat' => 300,
                    'compatible_id' => '',
                    'wa_stranscoder' => '5',
                    'confirmator' => '18',
                    'wa_storage' => '11',
                    'created' => '2014-02-03 13 =>17 =>20.531903+02',
                    'laststate' => 'user_t_remove',
                    'infohash' => null,
                    'url2' => 'http =>//sto8.ytv.su/000000/003/ysocsf_300_3350.ts',
                    'category' => 'socs',
                    'id' => '3350',
                    'updated' => '2014-02-03 13 =>51 =>30.330934+02',
                    'url1' => '/data/mediafiles/0008/000000/003/ysocsf_300_3350.ts'
                ),
                array(
                    'wa_user' => '18',
                    'oformat' => 300,
                    'compatible_id' => '',
                    'wa_stranscoder' => '5',
                    'confirmator' => null,
                    'wa_storage' => '11',
                    'created' => '2014-02-03 13 =>53 =>49.245074+02',
                    'laststate' => 'user_t_ready',
                    'infohash' => null,
                    'url2' => 'http =>//sto8.ytv.su/000000/003/ysocsf_300_3351.ts?exp=1391596128&uid=18&sign=ObPiHzaPW5ziXm56TJaaHg',
                    'category' => 'socs',
                    'id' => '3351',
                    'updated' => '2014-02-03 13 =>56 =>03.804132+02',
                    'url1' => '/data/mediafiles/0008/000000/003/ysocsf_300_3351.ts'
                )
            ),
            'status' => 0,
            'command' => 'mstatus'
        )));
        
        // replace response
        $plugin = new \Guzzle\Plugin\Mock\MockPlugin;
        $plugin->addResponse($response);
        
        $wa
            ->getConnection()
            ->addSubscriber($plugin);
        
        $response = $wa
            ->createCommand('mstatus')
            ->setCategory(\GoWeb\Wa\Command\Status::CATEGORY_VOD)
            ->setFileIdList(array(3350, 3351))
            ->setIp('4.4.4.4')
            ->send();
        
        $this->assertEquals(
            'user_t_remove',
            $response->getIterator()->current()->getLastState()
        );
        
    }
}