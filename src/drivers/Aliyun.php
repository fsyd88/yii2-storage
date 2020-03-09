<?php

namespace fsyd88\storage\drivers;

use OSS\OssClient;
use OSS\Core\OssException;

class Aliyun extends BaseDriver {

    public $isCName = false;
    public $endPoint = '';

    /**
     * Aliyun OSS Client
     *
     * @var OssClient
     */
    protected $ossClient;

    public function init() {
        parent::init();
        $this->ossClient = new OssClient(
                $this->accessKey, $this->secretKey, $this->endPoint, $this->isCName
        );
    }

    public function put($localFile, $saveTo) {
        try {
            $res = $this->ossClient->uploadFile($this->bucket, $saveTo, $localFile);
        } catch (OssException $ex) {
            throw new \Exception($ex->getErrorMessage() ?: $ex->getMessage());
        }
        return $res['oss-request-url'];
    }

}
