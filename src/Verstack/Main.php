<?php

namespace Verstack;

use pocketmine\plugin\PluginBase;
//use pocketmine\event\Listener;

class Main extends PluginBase{
	
	public $skripts = [];
	
	public $handler;
	
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->handler = new Handler($this);
		$this->getServer()->getLogger()->info("[Skript] Загрузка скриптов...");
		foreach(glob($this->getDataFolder()."*.sk") as $file){
			$this->skripts[] = new Skript($this, $file);
		}
	}
	
	public function getHandler(){
		return $this->handler;
	}
	
}
