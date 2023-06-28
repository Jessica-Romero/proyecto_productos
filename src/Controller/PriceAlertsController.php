<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PriceAlerts Controller
 *
 * @property \App\Model\Table\PriceAlertsTable $PriceAlerts
 * @method \App\Model\Entity\PriceAlert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PriceAlertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Brands', 'Shops','TypeAlerts'],
        ];
        $priceAlerts = $this->paginate($this->PriceAlerts);

        $this->set(compact('priceAlerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Price Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priceAlert = $this->PriceAlerts->get($id, [
            'contain' => ['Brands', 'Shops','Products'],
        ]);

        $this->set(compact('priceAlert'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priceAlert = $this->PriceAlerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $priceAlert = $this->PriceAlerts->patchEntity($priceAlert, $this->request->getData());
            if ($this->PriceAlerts->save($priceAlert)) {
                $this->Flash->success(__('The price alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price alert could not be saved. Please, try again.'));
        }
        $brands = $this->PriceAlerts->Brands->find('list', ['limit' => 200])->all();
        $shops = $this->PriceAlerts->Shops->find('list', ['limit' => 200])->all();
        $products = $this->PriceAlerts->Products->find('list', ['limit' => 200])->all();
        $typeAlerts = $this->PriceAlerts->TypeAlerts->find('list', ['limit' => 200])->all();
        $this->set(compact('priceAlert', 'brands', 'shops','products','typeAlerts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Price Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priceAlert = $this->PriceAlerts->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceAlert = $this->PriceAlerts->patchEntity($priceAlert, $this->request->getData());
            if ($this->PriceAlerts->save($priceAlert)) {
                $this->Flash->success(__('The price alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price alert could not be saved. Please, try again.'));
        }
        $brands = $this->PriceAlerts->Brands->find('list', ['limit' => 200])->all();
        $shops = $this->PriceAlerts->Shops->find('list', ['limit' => 200])->all();
        $products = $this->PriceAlerts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('priceAlert', 'brands', 'shops','products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Price Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priceAlert = $this->PriceAlerts->get($id);
        if ($this->PriceAlerts->delete($priceAlert)) {
            $this->Flash->success(__('The price alert has been deleted.'));
        } else {
            $this->Flash->error(__('The price alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
