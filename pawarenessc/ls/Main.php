<?php

namespace pawarenessc\ls;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\Server;
use pocketmine\Player;

class Main extends pluginBase implements Listener{
	
	public function onEnable(){
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("NNM-Ranksを読み込みました");
 		$this->getLogger()->info("制作者: PawarenessC");
 		$this->getLogger()->info("バージョン:{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
