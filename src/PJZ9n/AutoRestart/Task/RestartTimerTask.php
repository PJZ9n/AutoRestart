<?php
    
    /**
     *   _____     _ _________
     *  |  __ \   | |___  / _ \
     *  | |__) |  | |  / / (_) |_ __
     *  |  ___/   | | / / \__, | '_ \
     *  | |  | |__| |/ /__  / /| | | |
     *  |_|   \____//_____|/_/ |_| |_|
     *
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program.  If not, see <http://www.gnu.org/licenses/>.
     *
     * @author PJZ9n
     * @copyright PJZ9n All Rights Reserved
     */
    
    declare(strict_types=1);
    
    namespace PJZ9n\AutoRestart\Task;
    
    use pocketmine\plugin\Plugin;
    use pocketmine\scheduler\Task;
    use pocketmine\Server;
    use pocketmine\utils\TextFormat;
    
    class RestartTimerTask extends Task
    {
        
        /** @var Plugin */
        private $plugin;
        
        /** @var int */
        private $restartInterval;
        
        /** @var int */
        private $timer;
        
        public function __construct(Plugin $plugin, int $restartInterval)
        {
            $this->plugin = $plugin;
            $this->restartInterval = $restartInterval;
            $this->timer = 0;
        }
        
        public function onRun(int $currentTick): void
        {
            $this->timer++;
            
            //$this->plugin->getLogger()->debug(strval($this->timer));
            
            $diff = $this->restartInterval - $this->timer;
            
            if ($diff === 0) {
                $address = strval($this->plugin->getConfig()->get("address"));
                $port = intval($this->plugin->getConfig()->get("port"));
                foreach (Server::getInstance()->getOnlinePlayers() as $onlinePlayer) {
                    $onlinePlayer->transfer($address, $port);
                }
                
                Server::getInstance()->shutdown();
            }
            
            switch ($diff) {
                case 300:
                    Server::getInstance()->broadcastMessage(TextFormat::AQUA . "[自動再起動] 再起動まであと5分");
                    break;
                case 60:
                    Server::getInstance()->broadcastMessage(TextFormat::AQUA . "[自動再起動] 再起動まであと1分");
                    break;
                case 30:
                    Server::getInstance()->broadcastMessage(TextFormat::AQUA . "[自動再起動] 再起動まであと30秒");
                    break;
            }
            
            if ($diff <= 5) {
                Server::getInstance()->broadcastMessage(TextFormat::AQUA . "[自動再起動] 再起動まであと{$diff}秒");
            }
        }
        
    }