<?php namespace App\Extensions\UEditor;

class Upload{

    protected $base64 = 'upload';
    protected $config;
    protected $fieldName;
    protected $uploader;

    public function __construct($action,$iniConfig){
        $this->setParam($action,$iniConfig);
    }

    public function setParam($action,$iniConfig){
        switch ($action) {
            case 'uploadimage':
                $this->uploadImage($iniConfig);
                break;
            case 'uploadscrawl':
                $this->uploadScrawl($iniConfig);
                break;
            case 'uploadvideo':
                $this->uploadVideo($iniConfig);
                break;
            case 'uploadfile':
            default:
                $this->uploadFile($iniConfig);
                break;
        }
    }

    public function uploadImage($iniConfig){
        $this->config = array(
            'pathFormat' => $iniConfig['imagePathFormat'],
            'maxSize' => $iniConfig['imageMaxSize'],
            'allowFiles' => $iniConfig['imageAllowFiles']
        );
        $this->fieldName = $iniConfig['imageFieldName'];
    }

    public function uploadScrawl($iniConfig){
        $this->config = array(
            'pathFormat' => $iniConfig['scrawlPathFormat'],
            'maxSize' => $iniConfig['scrawlMaxSize'],
            'allowFiles' => $iniConfig['scrawlAllowFiles'],
            'oriName' => 'scrawl.png'
        );
        $this->fieldName = $iniConfig['scrawlFieldName'];
        $this->base64 = "base64";
    }

    public function uploadVideo($iniConfig){
        $this->config = array(
            'pathFormat' => $iniConfig['videoPathFormat'],
            'maxSize' => $iniConfig['videoMaxSize'],
            'allowFiles' => $iniConfig['videoAllowFiles']
        );
        $this->fieldName = $iniConfig['videoFieldName'];
    }

    public function uploadFile($iniConfig){
        $this->config = array(
            'pathFormat' => $iniConfig['filePathFormat'],
            'maxSize' => $iniConfig['fileMaxSize'],
            'allowFiles' => $iniConfig['fileAllowFiles']
        );
        $this->fieldName = $iniConfig['fileFieldName'];
    }

    public function iniUploader(){
        if (empty($this->uploader)) {
            $this->uploader = new Uploader($this->fieldName,$this->config,$this->base64);
        }
        return $this->uploader;
    }

    public function getResult(){
        return $this->iniUploader()->getFileInfo();
    }
}