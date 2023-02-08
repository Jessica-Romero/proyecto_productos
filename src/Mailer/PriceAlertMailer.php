<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class PriceAlertMailer extends Mailer
{
    public function priceAlertBrands($emails,$alertProducts,$competitors,$brandName)
    {
        $this->setTransport('default');
        $this->setFrom(['abg@mifarma.es' => __('ABG Site')])
            ->setTo($emails)
            ->setSubject(__('A price alert has been fired!'))
            ->setEmailFormat('html')
            ->setViewVars(['products' => $alertProducts])
            ->setViewVars(['competitors'=> $competitors])
            ->setViewVars(['brandName' => $brandName])
            ->viewBuilder()
            ->setTemplate('price_alert_brands')
            ->setLayout('default');
    }

    public function priceAlert($emails,$alertProducts,$competitors,$brandName)
    {
        $this->setTransport('default');
        $this->setFrom(['abg@mifarma.es' => __('ABG Site')])
            ->setTo($emails)
            ->setSubject(__('A price alert has been fired!'))
            ->setEmailFormat('html')
            ->setViewVars(['products' => $alertProducts])
            ->setViewVars(['competitors'=> $competitors])
            ->setViewVars(['brandName' => $brandName])
            ->viewBuilder()
            ->setTemplate('price_alert')
            ->setLayout('default');
    }
}
