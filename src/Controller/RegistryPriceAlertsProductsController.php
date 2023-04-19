<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RegistryPriceAlertsProducts Controller
 *
 * @property \App\Model\Table\RegistryPriceAlertsProductsTable $RegistryPriceAlertsProducts
 * @method \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistryPriceAlertsProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RegistryPriceAlerts', 'Products'],
        ];
        $registryPriceAlertsProducts = $this->paginate($this->RegistryPriceAlertsProducts);

        $this->set(compact('registryPriceAlertsProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Registry Price Alerts Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->get($id, [
            'contain' => ['RegistryPriceAlerts', 'Products'],
        ]);

        $this->set(compact('registryPriceAlertsProduct'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->patchEntity($registryPriceAlertsProduct, $this->request->getData());
            if ($this->RegistryPriceAlertsProducts->save($registryPriceAlertsProduct)) {
                $this->Flash->success(__('The registry price alerts product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry price alerts product could not be saved. Please, try again.'));
        }
        $registryPriceAlerts = $this->RegistryPriceAlertsProducts->RegistryPriceAlerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryPriceAlertsProducts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryPriceAlertsProduct', 'registryPriceAlerts', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registry Price Alerts Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->patchEntity($registryPriceAlertsProduct, $this->request->getData());
            if ($this->RegistryPriceAlertsProducts->save($registryPriceAlertsProduct)) {
                $this->Flash->success(__('The registry price alerts product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registry price alerts product could not be saved. Please, try again.'));
        }
        $registryPriceAlerts = $this->RegistryPriceAlertsProducts->RegistryPriceAlerts->find('list', ['limit' => 200])->all();
        $products = $this->RegistryPriceAlertsProducts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('registryPriceAlertsProduct', 'registryPriceAlerts', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registry Price Alerts Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registryPriceAlertsProduct = $this->RegistryPriceAlertsProducts->get($id);
        if ($this->RegistryPriceAlertsProducts->delete($registryPriceAlertsProduct)) {
            $this->Flash->success(__('The registry price alerts product has been deleted.'));
        } else {
            $this->Flash->error(__('The registry price alerts product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
