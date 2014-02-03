<?php

namespace GoWeb\Wa\Command;

class UploadTest extends \Guzzle\Tests\GuzzleTestCase
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
            'runtime' => 0.117000102996826,
            'progress' => array(
                'url' => 'http =>//stra3.ytv.su/up1/progress?sign=0XaAsq19woSAum1k4RFbog&exp=1390861636&uid=18&X-Progress-ID=r47DXbVJ65pwnJM7g8vV'
            ),
            'status' => 0,
            'upload' => array(
                'extended_post_params' => array(
                    'stra_id' => '4',
                    'uid' => '18',
                    'stor_id' => '10',
                    'category' => 'vod'
                ),
                'url' => 'http://stra4.ytv.su/up1/upload?exp=1391431337&stra_id=5&uid=18&stor_id=11&category=socs&X-Progress-ID=dTDiadBB6rmBzocOXEIS&sign=Yp0AxbcCYjx8UNm5d_r-_g'
            ),
            'errno' => 'All OK',
            'command' => 'upload'
        )));
        
        // replace response
        $plugin = new \Guzzle\Plugin\Mock\MockPlugin;
        $plugin->addResponse($response);
        
        $wa
            ->getConnection()
            ->addSubscriber($plugin);
        
        $response = $wa
            ->createCommand('upload')
            ->setCategory(\GoWeb\Wa\Command\Upload::CATEGORY_VOD)
            ->setIp('4.4.4.4')
            ->send();
        
        $this->assertEquals(
            'http://stra4.ytv.su/up1/upload?exp=1391431337&stra_id=5&uid=18&stor_id=11&category=socs&X-Progress-ID=dTDiadBB6rmBzocOXEIS&sign=Yp0AxbcCYjx8UNm5d_r-_g',
            $response->getUploadUrl()
        );
        
    }
}