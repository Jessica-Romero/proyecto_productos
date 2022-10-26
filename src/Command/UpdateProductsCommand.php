<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

class UpdateProductsCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->out($this->getTableLocator()->get('Products')->updateProductsFromFeed());
    }

}
