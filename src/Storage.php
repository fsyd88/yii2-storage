<?php

namespace fsyd88\storage;

use fsyd88\storage\drivers\BaseDriver;

class Storage extends \yii\base\Component {

    private $driver;
    protected $basePath;

    public function getDriver() {
        if ($this->driverInstance === null) {
            $this->setDriver([
                'class' => 'fsyd88\storage\drivers\Local'
            ]);
        }
        return $this->driverInstance;
    }

    public function setDriver($value) {
        if (is_array($value)) {
            $this->driverInstance = \Yii::createObject($value);
        } else {
            $this->driverInstance = $value;
        }
    }

    protected function getDriverInstance() {
        return $this->driver;
    }

    protected function setDriverInstance($value) {
        if (!($value instanceof BaseDriver)) {
            throw new \InvalidArgumentException('Driver must be a instance of BaseDriver');
        }
        $this->driver = $value;
    }

    public function getBasePath() {
        return $this->basePath;
    }

    public function setBasePath($value) {
        $this->basePath = $value;
    }

    public function getUploadedFile($name) {
        return UploadedFile::getInstanceByStorage($name, $this->driver, $this->basePath);
    }

}
