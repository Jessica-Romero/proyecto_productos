<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Http\Client;
use Cake\Log\Log;
use Cake\Core\Configure;


class UpdatePricesCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        ini_set('memory_limit','2048M');
        $this->getTableLocator()->get('ProductPrices')->updatePrices();
    }
}
