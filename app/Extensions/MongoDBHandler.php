<?php namespace App\Extensions;

class MongoDBSessionHandler implements SessionHandlerInterface{


	public function __construct(){
		
	}
	/**
	 * [open 基于文件系统，可留空]
	 * @param  [type] $savePath   
	 * @param  [type] $sessionName
	 * @return void
	 */
	public function open($savePath, $sessionName){
		return true;
	}

	/**
	 * [close 可留空]
	 * @return void
	 */
	public function close(){
		return true;
	}

	/**
	 * [read 读取session]
	 * @param  String $sessionId
	 * @return String
	 */
	public function read($sessionId){

	}

	/**
	 * [write 写入session]
	 * @param  String $sessionId
	 * @param  String $data     
	 * @return void           
	 */
	public function write($sessionId,$data){

	}

	/**
	 * [destroy 销毁session]
	 * @param  String $sessionId
	 * @return void
	 */
	public function destroy($sessionId){

	}

	/**
	 * [gc 垃圾回收]
	 * @param  Integer $maxlifetime 秒单位
	 * @return void
	 */
	public function gc($maxlifetime){

	}
}
?>