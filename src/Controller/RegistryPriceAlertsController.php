<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RegistryPriceAlerts Controller
 *
 * @property \App\Model\Table\RegistryPriceAlertsTable $RegistryPriceAlerts
 * @method \App\Model\Entity\RegistryPriceAlert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistryPriceAlertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PriceAlerts' => ['Brands','Shops','Products']],
        ];
        $registryPriceAlerts = $this->paginate($this->RegistryPriceAlerts);
        $this->set(compact('registryPriceAlerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Registry Price Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registryPriceAlert = $this->RegistryPriceAlerts->get($id, [
            'contain' => ['PriceAlerts'=> ['Brands','Shops','Products']],
        ]);
        $products= $this->fetchTable('RegistryPriceAlertsProducts')->findByRegistryPriceAlertId($id)->toArray();
        $this->set(compact('registryPriceAlert','products'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registryPriceAlert = $this->RegistryPriceAlerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $registryPriceAlert = $this->RegistryPriceAlerts->patchEntity($registryPriceAlert, $this->request->getData());
            if ($this->RegistryPriceAlerts->save($registryPriceAlert)) {
                $this->Flash->success(__('The registry price alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry price alert could not be saved. Please, try again.'));
        }
        $pricealerts = $this->RegistryPriceAlerts->Pricealerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryPriceAlerts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryPriceAlert', 'pricealerts', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registry Price Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registryPriceAlert = $this->RegistryPriceAlerts->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registryPriceAlert = $this->RegistryPriceAlerts->patchEntity($registryPriceAlert, $this->request->getData());
            if ($this->RegistryPriceAlerts->save($registryPriceAlert)) {
                $this->Flash->success(__('The registry price alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry price alert could not be saved. Please, try again.'));
        }
        $pricealerts = $this->RegistryPriceAlerts->Pricealerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryPriceAlerts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryPriceAlert', 'pricealerts', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registry Price Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registryPriceAlert = $this->RegistryPriceAlerts->get($id);
        if ($this->RegistryPriceAlerts->delete($registryPriceAlert)) {
            $this->Flash->success(__('The registry price alert has been deleted.'));
        } else {
            $this->Flash->error(__('The registry price alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
