<?php

namespace Verstack;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
	
	public $skripts = [];
	
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->getServer()->getLogger()->info("[Skript] Загрузка скриптов...");
		foreach(glob($this->getDataFolder()."*.sk") as $file){
			$this->skripts[] = new Skript($this, $file);
		}
	}
	
}
