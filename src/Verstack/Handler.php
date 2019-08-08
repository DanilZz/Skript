<?php

namespace Verstack;

use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\command\ConsoleCommandSender;

class Handler{
	
	public $skript;
	
	public $main;
	
	public function __construct($skript){
		$this->skript = $skript;
		$this->main = $skript->main;
	}
	
	public function handleFunc($type, $data){
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
							$this->handleLine($data2);
						}
					break;
				}
			break;
		}
	}
	
	public function handleLine($line, $p = null){
		$ex = explode(" ", $line);
		switch(array_shift($ex)){
			case "лог":
				$this->getServer()->getLogger()->info(implode(" ", $ex));
			break;
			case "php":
				eval(implode(" ", $ex));
			break;
			case "консоль":
				$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("/", "", implode(" ", $ex)));
			break;
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
				switch(array_shift($ex)){
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
	
	public function getServer(){
		return $this->main->getServer();
	}
	
}
