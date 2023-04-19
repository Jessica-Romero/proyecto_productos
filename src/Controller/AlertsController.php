<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;

/**
 * Alerts Controller
 *
 * @property \App\Model\Table\AlertsTable $Alerts
 * @method \App\Model\Entity\Alert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AlertsController extends AppController
{
    use LocatorAwareTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TypeAlerts'],
        ];
        $alerts = $this->paginate($this->Alerts);
        $this->set(compact('alerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $alert = $this->Alerts->get($id, [
            'contain' => 'TypeAlerts',
        ]);
        $idParms= json_decode($alert->params);

        switch($alert->type_alert->name){
            case 'Price Alert':
                $name = 'Price';
                $registryXAlert = $this->getTableLocator()->get('RegistryPriceAlertsProducts')->findByRegistryPriceAlertId($idParms->IdRegistry)->toArray();
                $xAlert = $this->fetchTable('PriceAlerts')->findById($idParms->IdAlert)->contain('Products', function (Query $q) use ($idParms) {
                    return $q->where(['PricealertsProducts.pricealert_id' => $idParms->IdAlert]);
                })->toArray();

                $emails =$xAlert[0]->emails;
                $brandName= $this->fetchTable('Brands')->findById($xAlert[0]->brand_id)->toArray();
                $ShopName= $this->fetchTable('Shops')->findById($xAlert[0]->shop_id)->toArray();

                $xAlertInfo = array("id" => $xAlert[0]->id, "brand" =>$brandName[0]->name,"shop" =>$ShopName[0]->name,"active" =>$xAlert[0]->active, "created" =>$xAlert[0]->created, "modified"=>$xAlert[0]->modified);

                $products=array();
                foreach ($xAlert[0]['products'] as $product):
                    array_push($products,$product->toArray());
                endforeach;

                $productsAffected=array();
                foreach ($registryXAlert as $product):
                    $ProductName= $this->fetchTable('Products')->findById($product->product_id)->toArray();
                    array_push($productsAffected,array("Product" =>$ProductName[0]->name,"price" => round((float)$product->price,2), "competitor_name" => $product->competitor_name,
                        "competitor_price" => round((float) $product->competitor_price,2)));
                endforeach;

                $this->set(compact('name','xAlertInfo','products','productsAffected','emails'));
                break;

            case 'Stock Alert':
                $name = 'Stock';
                $registryXAlert = $this->getTableLocator()->get('RegistryStockAlertsProducts')->findByRegistryStockAlertId($idParms->IdRegistry)->toArray();
                $xAlert = $this->fetchTable('StockAlerts')->findById($idParms->IdAlert)->contain('Products', function (Query $q) use ($idParms) {
                    return $q->where(['StockalertsProducts.stockalert_id' => $idParms->IdAlert]);
                })->toArray();

                $emails =$xAlert[0]->emails;
                $brandName= $this->fetchTable('Brands')->findById($xAlert[0]->brand_id)->toArray();

                $xAlertInfo = array("id" => $xAlert[0]->id, "brand" =>$brandName[0]->name,"value" =>$xAlert[0]->value,"active" =>$xAlert[0]->active, "created" =>$xAlert[0]->created, "modified"=>$xAlert[0]->modified);

                $products=array();
                foreach ($xAlert[0]['products'] as $product):
                    array_push($products,$product->toArray());
                endforeach;

                $productsAffected=array();
                foreach ($registryXAlert as $product):
                    $ProductName= $this->fetchTable('Products')->findById($product->product_id)->toArray();
                    array_push($productsAffected,array("Product" =>$ProductName[0]->name,"available_stock" => $product->available_stock));
                endforeach;

                $this->set(compact('name','xAlertInfo','products','productsAffected','emails'));
                break;

            default:
                $this->set(compact('alert'));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $alert = $this->Alerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $alert = $this->Alerts->patchEntity($alert, $this->request->getData());
            if ($this->Alerts->save($alert)) {
                $this->Flash->success(__('The alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alert could not be saved. Please, try again.'));
        }
        $typeAlerts = $this->Alerts->TypeAlerts->find('list', ['limit' => 200])->all();
        $this->set(compact('alert', 'typeAlerts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $alert = $this->Alerts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $alert = $this->Alerts->patchEntity($alert, $this->request->getData());
            if ($this->Alerts->save($alert)) {
                $this->Flash->success(__('The alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alert could not be saved. Please, try again.'));
        }
        $typeAlerts = $this->Alerts->TypeAlerts->find('list', ['limit' => 200])->all();
        $this->set(compact('alert', 'typeAlerts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $alert = $this->Alerts->get($id);
        if ($this->Alerts->delete($alert)) {
            $this->Flash->success(__('The alert has been deleted.'));
        } else {
            $this->Flash->error(__('The alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
