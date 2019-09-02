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
    
    namespace PJZ9n\AutoRestart\Command;
    
    use pocketmine\command\Command;
    use pocketmine\command\CommandExecutor;
    use pocketmine\command\CommandSender;
    use pocketmine\command\PluginCommand;
    use pocketmine\plugin\Plugin;
    
    class RestartCommand extends PluginCommand implements CommandExecutor
    {
        
        public function __construct(string $name, Plugin $owner)
        {
            parent::__construct($name, $owner);
            $this->setDescription("自動再起動に関する設定");
            $this->setUsage("/restart");
            $this->setAliases([
                "res",
            ]);
            $this->setPermission("AutoRestart.Command.restart");
            $this->setExecutor($this);
        }
        
        public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
        {
            //TODO:
            return false;
        }
        
    }