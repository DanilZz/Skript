<?php

namespace Verstack;

use pocketmine\utils\Config;

class Skript{
	
	public $main;
	
	public $file;
	
	public $data;
	
	public $handler;
	
	public function __construct($main, $file){
		$this->main = $main;
		$this->file = $file;
		$this->data = (new Config($file, Config::YAML))->getAll();
		$this->handler = new Handler($this);
		$this->getServer()->getPluginManager()->registerEvents(new Listener($this), $this);
		$this->onEnable();
	}
	
	public function onEnable(){
		$this->getServer()->getLogger()->info("[Skript] Скрипт ".basename($this->file)." загружен.");
		foreach($this->data as $type => $data){
			$this->getHandler()->handleFunc($type, $data);
		}
	}
	
	public function event($type, $p){
		if(isset($this->data[$type])){
			foreach($this->data[$type] as $line){
				$this->getHandler()->handleLine($line, $p);
			}
		}
	}
	
	public function getHandler(){
		return $this->handler;
	}
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
