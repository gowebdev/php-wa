<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;

class Upload extends Response
{
    public function getUploadUrl()
    {
        return $this->get('upload.url');
    }
}