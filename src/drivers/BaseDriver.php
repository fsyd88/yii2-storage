<?php

namespace fsyd88\storage\drivers;

abstract class BaseDriver extends \yii\base\Component {

    public $bucket = '';
    public $accessKey = '';
    public $secretKey = '';

    public function saveFile($localFile, $saveTo) {
        return $this->put($localFile, $saveTo);
    }

    abstract public function put($localFile, $saveTo);
}
