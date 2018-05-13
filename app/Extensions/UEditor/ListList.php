<?php namespace App\Extensions\UEditor;

class ListList{

    protected $input;
    protected $allowFiles;
    protected $listSize;
    protected $path;
    protected $start;
    protected $end;
    protected $list;
    protected $files;

    public function __construct($input,$iniConfig){
        $this->input = $input;
        $this->setParam($input['action'],$iniConfig);
        $this->setEnd()->setFiles()->setFileList();
    }

    public function setParam($action,$iniConfig){
        switch ($action) {
            case 'listfile':
                $this->listFile($iniConfig);
                break;
            case 'listimage':
            default:
                $this->listImage($iniConfig);
        }
        $this->allowFiles = substr(str_replace(".", "|", join("", $this->allowFiles)), 1);
        $this->path = $_SERVER['DOCUMENT_ROOT'].(substr($this->path, 0, 1) == "/" ? "":"/").$this->path;
    }

    public function listFile($iniConfig){
        $this->allowFiles = $iniConfig['fileManagerAllowFiles'];
        $this->listSize = $iniConfig['fileManagerListSize'];
        $this->path = $iniConfig['fileManagerListPath'];
    }

    public function listImage($iniConfig){
        $this->allowFiles = $iniConfig['imageManagerAllowFiles'];
        $this->listSize = $iniConfig['imageManagerListSize'];
        $this->path = $iniConfig['imageManagerListPath'];
    }

    public function getSize(){
        return isset($this->input['size'])?$this->input['size']:$this->listSize;
    }

    public function getStart(){
        $this->start = isset($this->input['start'])?$this->input['start']:0;
        return $this->start;
    }

    public function setEnd(){
        $this->end = $this->getSize() + $this->getStart();
        return $this;
    }

    public function setFiles(){
        $this->files = $this->getFiles($this->path, $this->allowFiles);
        return $this;
    }

    public function setFileList(){
        $len = count($this->files);
        $list = array();
        if ($len) {
            for ($i = min($this->end, $len) - 1; $i < $len && $i >= 0 && $i >= $this->start; $i--){
                $list[] = $this->files[$i];
            }
        }
        $this->list = $list;
        return $this;
    }

    public function getResult(){
        $result = array(
            "state" => "SUCCESS",
            "list" => $this->list,
            "start" => $this->start,
            "total" => count($this->files)
        );
        if (!$this->list)
            $result['state'] = 'no match file';
        return $result;
    }

    function getFiles($path, $allowFiles, &$files = array()){
        if (!is_dir($path)) return null;
        if(substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getFiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                        $files[] = array(
                            'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime'=> filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }
}