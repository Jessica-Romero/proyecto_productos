<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RegistryStockAlerts Controller
 *
 * @property \App\Model\Table\RegistryStockAlertsTable $RegistryStockAlerts
 * @method \App\Model\Entity\RegistryStockAlert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistryStockAlertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['StockAlerts'=> ['Brands','Products']],
        ];
        $registryStockAlerts = $this->paginate($this->RegistryStockAlerts);
        $this->set(compact('registryStockAlerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Registry Stock Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registryStockAlert = $this->RegistryStockAlerts->get($id, [
            'contain' => ['StockAlerts'=> ['Brands','Products']],
        ]);
        $products= $this->fetchTable('RegistryStockAlertsProducts')->findByRegistryStockAlertId($id)->toArray();
        $this->set(compact('registryStockAlert','products'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registryStockAlert = $this->RegistryStockAlerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $registryStockAlert = $this->RegistryStockAlerts->patchEntity($registryStockAlert, $this->request->getData());
            if ($this->RegistryStockAlerts->save($registryStockAlert)) {
                $this->Flash->success(__('The registry stock alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry stock alert could not be saved. Please, try again.'));
        }
        $stockalerts = $this->RegistryStockAlerts->Stockalerts->find('list', ['limit' => 200])->all();
        $this->set(compact('registryStockAlert', 'stockalerts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registry Stock Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registryStockAlert = $this->RegistryStockAlerts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registryStockAlert = $this->RegistryStockAlerts->patchEntity($registryStockAlert, $this->request->getData());
            if ($this->RegistryStockAlerts->save($registryStockAlert)) {
                $this->Flash->success(__('The registry stock alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry stock alert could not be saved. Please, try again.'));
        }
        $stockalerts = $this->RegistryStockAlerts->Stockalerts->find('list', ['limit' => 200])->all();
        $this->set(compact('registryStockAlert', 'stockalerts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registry Stock Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registryStockAlert = $this->RegistryStockAlerts->get($id);
        if ($this->RegistryStockAlerts->delete($registryStockAlert)) {
            $this->Flash->success(__('The registry stock alert has been deleted.'));
        } else {
            $this->Flash->error(__('The registry stock alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
