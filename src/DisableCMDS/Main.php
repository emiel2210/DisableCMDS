<?php

/*
  _____  _           _     _       _____ __  __ _____   _____        __   ___   ___  
 |  __ \(_)         | |   | |     / ____|  \/  |  __ \ / ____|      /_ | / _ \ / _ \ 
 | |  | |_ ___  __ _| |__ | | ___| |    | \  / | |  | | (___   __   _| || | | | | | |
 | |  | | / __|/ _` | '_ \| |/ _ \ |    | |\/| | |  | |\___ \  \ \ / / || | | | | | |
 | |__| | \__ \ (_| | |_) | |  __/ |____| |  | | |__| |____) |  \ V /| || |_| | |_| |
 |_____/|_|___/\__,_|_.__/|_|\___|\_____|_|  |_|_____/|_____/    \_/ |_(_)___(_)___/
 
*/

  namespace DisableCMDS;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerCommandPreprocessEvent;
  use pocketmine\utils\Config;
  use pocketmine\permission\Permission;

  class Main extends PluginBase implements Listener{
      
    const PRODUCER = "TheDragonRing";
    const VERSION = "1.0.0";
    const MAIN_WEBSITE = "https://TheDragonRing.github.io/DisableCMDS/";

    public function dataPath(){
      return $this->getDataFolder();
    }

    public function server(){
      return $this->getServer();
    }

	public function onEnable(){
        if(!$this->getServer()->getName()=="ImagicalMine"){
            $this->getLogger()->warn("§0§l[§r§bDisableCMDS§t0§l]§r Sorry, DisableCMDS is only available for ImagicalMine - server software for Minecraft: Pocket Edition and a third-party build of PocketMine-MP");
            $this->getLogger()->info("§0§l[§r§bDisableCMDS§t0§l]§r In order to use DisableCMDS, download ImagicalMine at http://imagicalmine.net");
            $this->setEnabled(false);
        }else{
            @mkdir($this->dataPath());
            $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array(
            #  _____  _           _     _       _____ __  __ _____   _____        __   ___   ___   ,
            # |  __ \(_)         | |   | |     / ____|  \/  |  __ \ / ____|      /_ | / _ \ / _ \  ,
            # | |  | |_ ___  __ _| |__ | | ___| |    | \  / | |  | | (___   __   _| || | | | | | | ,
            # | |  | | / __|/ _` | '_ \| |/ _ \ |    | |\/| | |  | |\___ \  \ \ / / || | | | | | | ,
            # | |__| | \__ \ (_| | |_) | |  __/ |____| |  | | |__| |____) |  \ V /| || |_| | |_| | ,
            # |_____/|_|___/\__,_|_.__/|_|\___|\_____|_|  |_|_____/|_____/    \_/ |_(_)___(_)___/  ,
 
            # Message that occurs when player runs a disabled command - Use & or § to colour the text,
            "disabled_cmd_msg" => "§4This command is disabled!",
 
            # The commands players can still run normally,
            "enabled_cmds" => array(),
            ));
            $this->saveResource("config.yml");
        }
    }

    public function onCommand(PlayerCommandPreprocessEvent $event){

      $command = explode(" ", strtolower($event->getMessage()));

      $player = $event->getPlayer();

      $allowed_cmds = $this->cfg->get("enabled_cmds");

      $banned_cmd_message = $this->cfg->get("disabled_cmd_msg");

      if(!(in_array($command[0], $allowed_cmds)))
      {

        if(!($player->hasPermission("disablecmds.bypass")))
        {

          $player->sendMessage($banned_cmd_message);

        }

      }

    }

  }

?>
