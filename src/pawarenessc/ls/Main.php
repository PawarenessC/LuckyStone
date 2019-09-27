<?php

namespace pawarenessc\ls;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\item\Item;

class Main extends pluginBase implements Listener{
	
	public function onEnable(){
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("LuckyStoneを読み込みました");
 		$this->getLogger()->info("制作者: PawarenessC");
		$this->getLogger()->info("ライセンス: NYSL Version 0.9982");
		$this->getLogger()->info("http://www.kmonos.net/nysl/");
 		$this->getLogger()->info("バージョン:{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable(){
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("LuckyStoneを停止しました");
 		$this->getLogger()->info("制作者: PawarenessC");
 		$this->getLogger()->info("バージョン:{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
	}
	
	/**
 	* @ignoreCancelled
 	*/
	public function onBreak(BlockBreakEvent $event){
		$player = $event->getPlayer();
		$block = $event->getBlock();
		$id = $block->getId();
		$x = $block->x;
		$y = $block->y;
		$z = $block->z;
		$pos = new Vector3($x, $y, $z);
		$level = $player->getLevel();
		if($id == 1){
			if(mt_rand(1,1000) == 1){
				$item = Item::get(265, 0, mt_rand(1,10)); //鉄
				$level->dropItem($pos, $item);
			}
			
			if(mt_rand(1,10000) == 1){
				$item = Item::get(264, 0, mt_rand(1,10)); //ダイヤ
				$level->dropItem($pos, $item);
			}
		}
	}
			
			
			
	}
