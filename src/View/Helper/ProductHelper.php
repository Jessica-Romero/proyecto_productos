<?php
/* src/View/Helper/FlowHelper.php */
namespace App\View\Helper;

use Cake\View\Helper;

class ProductHelper extends Helper
{
    public $helpers = ['Html'];

    public function availability($stock_available)
    {
        if($stock_available){
            return '<span class="badge bg-success">'.__('In stock').'</span>';
        }else{
            return '<span class="badge bg-danger">'.__('Out of stock').'</span>';
        }
    }

    public function brandName($brand)
    {
        return '<span class="badge bg-info">'.$this->Html->link($brand->name, ['controller' => 'Brands', 'action' => 'view', $brand->id]).'</span>';
    }

    public function stockLevel($stock)
    {
        switch ($stock)
        {
            case 0:
                return '<span class="badge bg-danger">'.$stock.'</span>';
            case ($stock < 10):
                return '<span class="badge bg-warning">'.$stock.'</span>';
            default:
                return '<span class="badge bg-success">'.$stock.'</span>';
        }
    }
    public function rating($rating)
    {

        return '<span class="badge bg-info">'.$rating.'</span>';

    }
}
