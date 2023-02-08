<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RegistryStockAlertsProducts Controller
 *
 * @property \App\Model\Table\RegistryStockAlertsProductsTable $RegistryStockAlertsProducts
 * @method \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistryStockAlertsProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RegistryStockAlerts', 'Products'],
        ];
        $registryStockAlertsProducts = $this->paginate($this->RegistryStockAlertsProducts);

        $this->set(compact('registryStockAlertsProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Registry Stock Alerts Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->get($id, [
            'contain' => ['RegistryStockAlerts', 'Products'],
        ]);

        $this->set(compact('registryStockAlertsProduct'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->patchEntity($registryStockAlertsProduct, $this->request->getData());
            if ($this->RegistryStockAlertsProducts->save($registryStockAlertsProduct)) {
                $this->Flash->success(__('The registry stock alerts product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry stock alerts product could not be saved. Please, try again.'));
        }
        $registryStockAlerts = $this->RegistryStockAlertsProducts->RegistryStockAlerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryStockAlertsProducts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryStockAlertsProduct', 'registryStockAlerts', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registry Stock Alerts Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->patchEntity($registryStockAlertsProduct, $this->request->getData());
            if ($this->RegistryStockAlertsProducts->save($registryStockAlertsProduct)) {
                $this->Flash->success(__('The registry stock alerts product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry stock alerts product could not be saved. Please, try again.'));
        }
        $registryStockAlerts = $this->RegistryStockAlertsProducts->RegistryStockAlerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryStockAlertsProducts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryStockAlertsProduct', 'registryStockAlerts', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registry Stock Alerts Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registryStockAlertsProduct = $this->RegistryStockAlertsProducts->get($id);
        if ($this->RegistryStockAlertsProducts->delete($registryStockAlertsProduct)) {
            $this->Flash->success(__('The registry stock alerts product has been deleted.'));
        } else {
            $this->Flash->error(__('The registry stock alerts product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
