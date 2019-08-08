<?php

namespace Verstack;

use pocketmine\event\Listener as Listener2;

use pocketmine\event\player\{
	PlayerJoinEvent,
	PlayerQuitEvent
};

class Listener implements Listener2{
	
	public $main;
	
	public $skript;
	
	public function __construct($skript){
		$this->main = $skript->main;
		$this->skript = $skript;
	}
	
	public function onJoin(PlayerJoinEvent $e){
		$p = $e->getPlayer();
		$this->skript->event("при входе", $p);
	}
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
