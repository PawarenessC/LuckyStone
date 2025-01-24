<?php

namespace awa\LuckyStone;

use awa\LuckyStone\PlayerEventListener;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\block\VanillaBlocks;
use pocketmine\block\Sand;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\math\Vector3;

use pocketmine\utils\Config;
use pocketmine\world\World;

class Main extends pluginBase implements Listener
{

    /* @var Config */
    public $setup;

    /* @var Config */
    public $message;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerEventListener($this), $this);
        $this->setup = new Config($this->getDataFolder() . "Setup.yml", Config::YAML,
        [
            "iron_rand_max" => 10,
            "number_of_iron_max" => 10,
            "diamond_rand_max" => 10,
            "number_of_diamond_max" => 10,
            "double_drop" => true,
            "Priority_given_to_diamonds" => true,
        ]);
        $this->message = new Config($this->getDataFolder() . "message.yml", Config::YAML,
        [
            "send_message" => true,
            "drop.iron" => "ラッキー！鉄がドロップした！",
            "drop.diamond" => "ラッキー！ダイアがドロップした！",
            "drop.both" => "ラッキー！！鉄とダイアどっちもドロップした！！",
        ]);
    }

    public function drop(Item $item, Vector3 $pos, World $world): void
    {
        $setup = $this->setup->getAll();
        $number_of_iron_max = $setup["number_of_iron_max"];
        $number_of_diamond_max = $setup["number_of_diamond_max"];
        switch ($item){
            case VanillaItems::IRON_INGOT():
                $world->dropItem($pos, $item->setCount(mt_rand(1, $number_of_iron_max)));
                break;

            case VanillaItems::DIAMOND():
                $world->dropItem($pos, $item->setCount(mt_rand(1, $number_of_diamond_max)));
                break;

            default:
                break;
        }
    }

    public function sendMessage(Player $player, string $message): void
    {
        $message_config = $this->message->getAll();
        if(!$message_config["send_message"]) return;
        switch ($message){
            case "drop.iron":
                $player->sendMessage($message_config["drop.iron"]);
                break;

            case "drop.diamond":
                $player->sendMessage($message_config["drop.diamond"]);
                break;

            case "drop.both":
                $player->sendMessage($message_config["drop.both"]);
                break;
        }
    }
}
