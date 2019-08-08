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
	
	public function event($type, $p){
		foreach($this->skripts as $sk){
			if(isset($sk->data[$type])){
				foreach($sk->data[$type] as $line){
					$this->getHandler()->handleLine($line, $p);
				}
			}
		}
	}
	
	public function getHandler(){
		return $this->handler;
	}
	
}
