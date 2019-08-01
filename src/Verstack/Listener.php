<?php

namespace Verstack;

use pocketmine\event\Listener as Listener2;

use pocketmine\event\player\{
	PlayerJoinEvent,
	PlayerQuitEvent
};

class Listener implements Listener2{
	
	public $main;
	
	public function __construct($main){
		$this->main = $main;
	}
	
	public function onJoin(PlayerJoinEvent $e){
		$p = $e->getPlayer();
		$this->main->event("при входе", $p);
	}
	
	public function getServver(){
		return $this->main->getServer();
	}
	
}
