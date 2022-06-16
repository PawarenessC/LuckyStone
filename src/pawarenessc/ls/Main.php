<?php

namespace pawarenessc\ls;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\math\Vector3;

use pocketmine\utils\Config;

class Main extends pluginBase implements Listener{
	
	/* @var Config */
	public $config;
	
	public function onEnable(): void {
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("LuckyStoneを読み込みました");
 		$this->getLogger()->info("制作者: PawarenessC");
		$this->getLogger()->info("ライセンス: NYSL Version 0.9982");
		$this->getLogger()->info("http://www.kmonos.net/nysl/");
 		$this->getLogger()->info("バージョン:{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
		$this->config = new Config($this->getDataFolder()."Setup.yml", Config::YAML,
            	[
                	"iron_rand_max" => 100,
                	"number_of_iron_max" => 10,
                	"diamond_rand_max" => 1000,
                	"number_of_diamond_max" => 10,
            	]);
	}
	
	public function onDisable(): void{
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("LuckyStoneを停止しました");
 		$this->getLogger()->info("制作者: PawarenessC");
 		$this->getLogger()->info("バージョン:{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
	}

	public function onBreak(BlockBreakEvent $event): void{
		if($event->isCancelled()) return;
        	$player = $event->getPlayer();
		$block = $event->getBlock();
		$id = $block->getId();
        	$x = $block->getPosition()->getX();
        	$y = $block->getPosition()->getY();
        	$z = $block->getPosition()->getZ();
		$pos = new Vector3($x, $y, $z);
		$level = $player->getWorld();
		if($id == 1){
			$config = $this->config->getAll();
			$iron_rand_max =         $config["iron_rand_max"];
			$diamond_rand_max =      $config["diamond_rand_max"];
			$number_of_iron_max =    $config["number_of_iron_max"];
			$number_of_diamond_max = $config["number_of_diamond_max"];
			
			if(mt_rand(1,$iron_rand_max) == 1){
                		$item = ItemFactory::getInstance()->get(265, 0, mt_rand(1, $number_of_iron_max));
				$level->dropItem($pos, $item);
			}
			
			if(mt_rand(1, $diamond_rand_max) == 1){
				$item = ItemFactory::getInstance()->get(264, 0, mt_rand(1, $number_of_diamond_max)); //ダイヤ
				$level->dropItem($pos, $item);
			}
		}
	}
}
