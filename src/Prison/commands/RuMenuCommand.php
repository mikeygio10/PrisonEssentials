<?php

namespace Prison\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use Prison\Main;

class RuMenuCommand extends PluginCommand{

    /** @var Main */
    private $plugin;

    public function __construct(string $name, Main $plugin){
        $this->plugin = $plugin;
        parent::__construct($name, $plugin);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if($sender instanceof Player) {
            $this->ruMenu($sender);
        }
        return true;
    }

    public function ruMenu($sender){
        $api = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result) {
                case 0:
                    break;
            }
           
        });
        $form->setTitle("RANKING UP MENU");
        $content = "Your current rank: ".$this->plugin->getRank($sender);
        $content .= "Your current prestige: ".$this->plugin->getPrestige($sender);
        $content .= "Next rank: ".$this->plugin->getNextRank($sender);
        $content .= "Next prestige: ".$this->plugin->getNextPrestige($sender);
        $content .= "Money missing for rank up: ".$this->plugin->calculateMoney($sender);
        $form->setContent($content);
        $form->addButton("Exit the Menu");
        $form->sendToPlayer($sender);
        return $form;
    }


}
