<?php

namespace Verstack;

use pocketmine\command\Command as CommandS;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\item\Item;

class Command extends CommandS{
	
	public $skript;
	
	public $data;
	
	public $main;
	
	public function __construct($skript, $data, $name){
		$description = "";
		$usageMessage = null;
		$aliases = [];
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->skript = $skript;
		$this->data = $data;
		$this->main = $skript->main;
	}
	
	public function execute(CommandSender $p, $label, array $args) {
		/*if(!$this->testPermission($sender)) {
			$this->sendNoPermission($sender);
			return true;
		}*/
		foreach($this->data as $type => $line){
			$this->skript->getHandler()->handleLine($line, $p);
		}
	}
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
