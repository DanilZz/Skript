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
		foreach($this->data as $line){
			$ex = explode(" ", $line);
			switch(array_shift($ex)){
				case "выдать":
					if(array_shift($ex) == "игроку"){
						switch(array_shift($ex)){
							case "гм":
								$p->setGamemode(array_shift($ex));
							break;
							case "креатив":
								$p->setGamemode(1);
							break;
							case "выживание":
								$p->setGamemode(0);
							break;
							case "предмет":
								$p->getInventory()->addItem(Item::get($ex[0], 0, $ex[1]));
							break;
						}
					}
				break;
				case "телепортировать":
					if(array_shift($ex) == "игрока"){
						if(array_shift($ex) == "на"){
							if(count($ex) == 3){
								$p->teleport(new Vector3(...$ex));
							}else{
								$p->teleport($p->getLevel()->getSafeSpawn());
							}
						}
					}
				break;
				case "сообщение":
					switch(array_shift($ex){
						case "игроку":
							$p->sendMessage(implode(" ", $ex));
						break;
						case "всем":
							$this->getServer()->broadcastMessage(implode(" ", $ex));
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
