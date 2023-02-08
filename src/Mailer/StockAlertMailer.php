<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

class StockAlertMailer extends Mailer
{
    public function stockAlertBrands($emails, $products,$alert,$brandName)
    {
        $this->setTransport('default');
        $this->setFrom(['abg@mifarma.es' => __('ABG Site')])
            ->setTo($emails)
            ->setSubject(__('A stock alert has been fired!'))
            ->setEmailFormat('html')
            ->setViewVars(['products' => $products])
            ->setViewVars(['alert' => $alert])
            ->setViewVars(['brandName' => $brandName])
            ->viewBuilder()
            ->setTemplate('stock_alert_brands')
            ->setLayout('default');
    }

    public function stockAlert($emails, $products,$alert,$brandName)
    {
        $this->setTransport('default');
        $this->setFrom(['abg@mifarma.es' => __('ABG Site')])
            ->setTo($emails)
            ->setSubject(__('A stock alert has been fired!'))
            ->setEmailFormat('html')
            ->setViewVars(['products' => $products])
            ->setViewVars(['alert' => $alert])
            ->setViewVars(['brandName' => $brandName])
            ->viewBuilder()
            ->setTemplate('stock_alert')
            ->setLayout('default');
    }
}
