<?php namspace App\Extensions\UEditor;

class Crawler{
	protected $config;
	protected $fieldName;
	protected $source;
	protected $list;

	public function __construct($input,$iniConfig){
		set_time_limit(0);
		$this->setParam($input,$iniConfig);
		$this->getList();
	}

	public function setParam($input,$iniConfig){
		$this->config = array(
		    "pathFormat" => $iniConfig['catcherPathFormat'],
		    "maxSize" => $iniConfig['catcherMaxSize'],
		    "allowFiles" => $iniConfig['catcherAllowFiles'],
		    "oriName" => "remote.png"
		);
		$this->fieldName = $iniConfig['catcherFieldName'];
		$this->source    = $input[$this->fieldName];
	}

	public function getList(){
		$list =array();
		foreach ($this->source as $imgUrl) {
		    $item = new Uploader($imgUrl, $this->config, "remote");
		    $info = $item->getFileInfo();
		    array_push($list, array(
		        "state" => $info["state"],
		        "url" => $info["url"],
		        "size" => $info["size"],
		        "title" => htmlspecialchars($info["title"]),
		        "original" => htmlspecialchars($info["original"]),
		        "source" => htmlspecialchars($imgUrl)
		    ));
		}
		$this->list;
	}

	public function getResult(){
		return array(
		    'state'=> count($this->list) ? 'SUCCESS':'ERROR',
		    'list'=> $this->list
		);
	}
}


?>