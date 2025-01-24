<?php

namespace awa\LuckyStone;

use awa\LuckyStone\Main;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;

class PlayerEventListener implements Listener
{

    public $main;
    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event): void
    {
        if ($event->isCancelled()) return;
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $pos = new Vector3($block->getPosition()->getX(), $block->getPosition()->getY(), $block->getPosition()->getZ());
        $level = $player->getWorld();
        if ($block->getName() == "Stone") {
            $main = $this->main;
            $setup = $main->setup;
            $setup = $setup->getAll();
            $iron_rand_max = $setup["iron_rand_max"];
            $diamond_rand_max = $setup["diamond_rand_max"];
            $is_double_drop = $setup["double_drop"];
            $is_priority_diamond = $setup["Priority_given_to_diamonds"];
            $iron_rand = mt_rand(1, $iron_rand_max);
            $diamond_rand = mt_rand(1, $diamond_rand_max);

            if($iron_rand === 1 and $diamond_rand === 1)
            {
                if($is_double_drop)
                {
                    $player->sendMessage("ダブル");
                    $main->sendMessage($player,"drop.both");
                    $main->drop(VanillaItems::IRON_INGOT(),$pos,$level);
                    $main->drop(VanillaItems::DIAMOND(),$pos,$level);
                }else{
                    if($is_priority_diamond)
                    {
                        $player->sendMessage("ダイア優先");
                        $main->sendMessage($player,"drop.diamond");
                        $main->drop(VanillaItems::DIAMOND(),$pos,$level);
                    }else{
                        $player->sendMessage("鉄優先");
                        $main->sendMessage($player,"drop.iron");
                        $main->drop(VanillaItems::IRON_INGOT(), $pos,$level);
                    }
                }
            }else{
                if ($iron_rand === 1){
                    $player->sendMessage("通常鉄");
                    $main->sendMessage($player,"drop.iron");
                    $main->drop(VanillaItems::IRON_INGOT(), $pos,$level);
                }
                if ($diamond_rand === 1){
                    $player->sendMessage("津城ダイア");
                    $main->sendMessage($player,"drop.diamond");
                    $main->drop(VanillaItems::DIAMOND(), $pos,$level);
                }
            }
        }
    }
}