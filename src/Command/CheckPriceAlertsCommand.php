<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Http\Client;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Mailer\MailerAwareTrait;


class CheckPriceAlertsCommand extends Command
{
    use MailerAwareTrait;

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->getTableLocator()->get('PriceAlerts')->runPriceAlerts();
    }
}
