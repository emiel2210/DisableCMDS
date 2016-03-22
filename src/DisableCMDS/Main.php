<?php

  namespace DisableCMDS;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerCommandPreprocessEvent;
  use pocketmine\utils\Config;

  class Main extends PluginBase implements Listener
  {

    public function dataPath()
    {

      return $this->getDataFolder();

    }

    public function server()
    {

      return $this->getServer();

    }

    public function onEnable()
    {

      @mkdir($this->dataPath());

      $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array("banned_cmds" => array(), "banned_cmd_message" => ""));

    }

    public function onCommand(PlayerCommandPreprocessEvent $event)
    {

      $command = explode(" ", strtolower($event->getMessage()));

      $player = $event->getPlayer();

      $banned_cmds = $this->cfg->get("banned_cmds");

      $banned_cmd_message = $this->cfg->get("banned_cmd_message");

      if(in_array($command[0], $banned_cmds))
      {

        if(!($player->hasPermission("disablecmds.bypass")))
        {

          $player->sendMessage($banned_cmd_message);

        }

      }

    }

  }

?>
