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
    
    namespace PJZ9n\AutoRestart;
    
    use PJZ9n\AutoRestart\Listener\MainListener;
    use PJZ9n\AutoRestart\Task\RestartTimerTask;
    use pocketmine\plugin\PluginBase;
    
    /**
     * Class Main
     * @package PJZ9n\AutoRestart
     */
    class Main extends PluginBase
    {
        
        /** @var array */
        private $clientData;
        
        public function onEnable(): void
        {
            $this->saveDefaultConfig();
            
            $this->getServer()->getPluginManager()->registerEvents(new MainListener($this), $this);
            
            $restartInterval = intval(floor(floatval(($this->getConfig()->get("restart-interval")) * 60)));
            //$this->getScheduler()->scheduleRepeatingTask(new RestartTimerTask($this, $restartInterval), 20);
        }
        
    }