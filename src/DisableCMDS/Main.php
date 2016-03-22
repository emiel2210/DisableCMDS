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

      $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array("banned_cmds" => array()));

    }

    public function onCommand(PlayerCommandPreprocessEvent $event)
    {

      $command = explode(" ", strtolower($event->getMessage()));

      $banned_cmds = $this->cfg->get("banned_cmds");

    }

  }

?>
