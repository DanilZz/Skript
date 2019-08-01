<?php

namespace Verstack;

use pocketmine\utils\Config;

class Skript{
	
	public $main;
	
	public $file;
	
	public $data;
	
	public function __construct($main, $file){
		$this->main = $main;
		$this->file = $file;
		$this->data = (new Config($file, Config::YAML))->getAll();
		$this->onEnable();
	}
	
	public function onEnable(){
		$this->getServer()->getLogger()->info("[Skript] Скрипт ".basename($this->file)." загружен.");
		foreach($this->data as $type => $data){
			$this->main->getHandler()->handleFunc($type, $data);
		}
	}
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
