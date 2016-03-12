<?php

/*
   ____        _      _        _       _       __  __                  __   ___   ___  
  / __ \      (_)    | |      | |     (_)     |  \/  |                /_ | / _ \ / _ \ 
 | |  | |_   _ _  ___| | __   | | ___  _ _ __ | \  / |___  __ _  __   _| || | | | | | |
 | |  | | | | | |/ __| |/ /   | |/ _ \| | '_ \| |\/| / __|/ _` | \ \ / / || | | | | | |
 | |__| | |_| | | (__|   < |__| | (_) | | | | | |  | \__ \ (_| |  \ V /| || |_| | |_| |
  \___\_\\__,_|_|\___|_|\_\____/ \___/|_|_| |_|_|  |_|___/\__, |   \_/ |_(_)___/ \___/ 
                                                           __/ |                       
                                                          |___/                        
 */
 
namespace TheDragonRing\QuickJoinMsg;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\permission\Permission;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
    
    const PRODUCER = "TheDragonRing";
    const VERSION = "1.0.0";
    const MAIN_WEBSITE = "https://TheDragonRing.github.io/QuickJoinMsg/";

	public function onEnable(){
	           if(!$this->getServer()->getName()=="ImagicalMine"){
                $this->getLogger()->warn("§0§l[§r§bQuickJoinMsg§t0§l]§r Sorry, QuickJoinMsg is only available for ImagicalMine - server software for Minecraft: Pocket Edition and a third-party build of PocketMine-MP");
                $this->getLogger()->info("§0§l[§r§bQuickJoinMsg§t0§l]§r In order to use QuickJoinMsg, download ImagicalMine at http://imagicalmine.net");
                $this->setEnabled(false);
                }
                
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("0§l[§r§bQuickJoinMsg§t0§l]§r".Colour::GREEN." Enabled!");
		
			@mkdir($this->getDataFolder());
			$this->yml = new Config($this->getDataFolder()."joinmsg.yml",Config::YAML, array(
            #   ____        _      _        _       _       __  __                  __   ___   ___  
            #  / __ \      (_)    | |      | |     (_)     |  \/  |                /_ | / _ \ / _ \ 
            # | |  | |_   _ _  ___| | __   | | ___  _ _ __ | \  / |___  __ _  __   _| || | | | | | |
            # | |  | | | | | |/ __| |/ /   | |/ _ \| | '_ \| |\/| / __|/ _` | \ \ / / || | | | | | |
            # | |__| | |_| | | (__|   < |__| | (_) | | | | | |  | \__ \ (_| |  \ V /| || |_| | |_| |
            #  \___\_\\__,_|_|\___|_|\_\____/ \___/|_|_| |_|_|  |_|___/\__, |   \_/ |_(_)___/ \___/ 
            #                                                           __/ |                       
            #                                                          |___/           
                         
            # The message which appears to players when they join
            # Use § to colour the text
            # Use #player as the players name
            "JoinMsg" => "Welcome to the Server,§6 #player"
			));
    $this->saveResource("joinmsg.yml");
	}
	
	public function onDisable(){
		$this->getLogger()->info("0§l[§r§bQuickJoinMsg§t0§l]§r".Colour::DARK_RED." Disabled!");
	}
	
    private $permMessage = Colour::DARK_RED."0§l[§r§bQuickJoinMsg§t0§l]§r§4 You do not have permission to run this command!";
    private $consoleMsg = Colour::DARK_RED."0§l[§r§bQuickJoinMsg§t0§l]§r§4 This command can only be executed in-game!";

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$message = str_replace("#player", $name, $this->config->get("JoinMsg"));
		$sender->sendMessage($message);
		return true;
		break;
	}

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        
//quickjoinmsg
		if(strtolower($cmd->getName() == "quickjoinmsg")){
			if(!($sender instanceof Player)){
				$sender->sendMessage(Colour::BLACK. "---[".Colour::AQUA."QuickJoinMsg v1.0.0 Info".Colour::BLACK."]---");
				$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."Plugin Author: ".Colour::WHITE."TheDragonRing");
				$sender->sendMessage(Colour::AQUA."Commands-");
				$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/quickjoinmsg".Colour::WHITE." View all the info about QuickJoinMsg, version, author, commands and permissions (alias = /qjm)");
                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/setjoinmsg <message>".Colour::WHITE." Set custom join message (alias = /sjm)");
                $sender->sendMessage(Colour::AQUA."Permissions-")
				$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg".Colour::WHITE." Allows use of all QuickJoinMsg features - Default: OP Only");
				$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg.info".Colour::WHITE." Allows use of /quickjoinmsg - Default: Anyone");
				$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg.set".Colour::WHITE." Allows use of /setjoinmsg -  Default: OP Only");
				return true;
                    }else{
                        if(!($sender->hasPermission("quickjoinmsg.info"){
                        $sender->sendMessage($this->permMessage);
                        return true;
                            }else{
                                $sender->sendMessage(Colour::BLACK. "---[".Colour::AQUA."QuickJoinMsg v1.0.0 Info".Colour::BLACK."]---");
				                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."Plugin Author: ".Colour::WHITE."TheDragonRing");
				                $sender->sendMessage(Colour::AQUA."Commands-");
				                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/quickjoinmsg".Colour::WHITE." View all the info about QuickJoinMsg, version, author, commands and permissions (alias = /qjm)");
				                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/setjoinmsg <message>".Colour::WHITE." Set custom join message (alias = /sjm)");
				                $sender->sendMessage(Colour::AQUA."Permissions-");
								$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg".Colour::WHITE." Allows use of all QuickJoinMsg features - Default: OP Only");
				                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg.info".Colour::WHITE." Allows use of /quickjoinmsg - Default: Anyone");
				                $sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."quickjoinmsg.set".Colour::WHITE." Allows use of /setjoinmsg -  Default: OP Only");
                                return true;
                            }
                        }
                    }
                break;
//setjoinmsg
        if(strtolower($cmd->getName()) === "setjoinmsg"){
            if(!($sender instanceof Player)){
                if(!(isset($args[0]))){
                    $sender->sendMessage(Colour::RED . "§0§l[§r§bQuickJoinMsg§t0§l]§r§4 You did not specify a Join Message. Please use /setjoinmsg <message>");
                    return true;
                        }else{
                $join_msg = implode(" ", $args);
                $this->yml->set("JoinMsg", $join_msg);
                $sender->sendMessage(Colour::GREEN . "§0§l[§r§bQuickJoinMsg§t0§l]§r§a Successfully set new Join Message.");
                return true;
                    }}else{           
                        if(!($sender->hasPermission("quickjoinmsg.set"){
                            $sender->sendMessage($this->permMessage);
                            return true;
                                }else{
                                    if(!(isset($args[0]))){
                                        $sender->sendMessage(Colour::RED . "§0§l[§r§bQuickJoinMsg§t0§l]§r§4 You did not specify a Join Message. Please use /setjoinmsg <message>");
                                        return true;
                                            }else{
                                                $join_msg = implode(" ", $args);
                                                $this->yml->set("JoinMsg", $join_msg);
                                                $sender->sendMessage(Colour::GREEN . "§0§l[§r§bQuickJoinMsg§t0§l]§r§a Successfully set new Join Message.");
                                        return true;
                                  }
                            }
                      }
                }
            break;
        }
}