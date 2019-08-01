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
			$ex = explode(" ", $type);
			switch(array_shift($ex)){
				case "команда":
					$cmd = str_replace("/", "", array_shift($ex));
					$this->getServer()->getCommandMap()->register($cmd, new Command($this, $data, $cmd));
				break;
				case "при":
					switch(array_shift($ex)){
						case "включении":
							foreach($data as $data2){
								$ex = explode(" ", $type);
								switch(array_shift($ex)){
									case "лог":
										$this->getServer()->getLogger()->info(implode(" ", $ex));
									break;
								}
							}
						break;
					}
				break;
			}
		}
	}
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
