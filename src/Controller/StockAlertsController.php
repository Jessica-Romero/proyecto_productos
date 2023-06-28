<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * StockAlerts Controller
 *
 * @property \App\Model\Table\StockAlertsTable $StockAlerts
 * @method \App\Model\Entity\StockAlert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockAlertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Brands','TypeAlerts'],
        ];
        $stockAlerts = $this->paginate($this->StockAlerts);

        $this->set(compact('stockAlerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockAlert = $this->StockAlerts->get($id, [
            'contain' => ['Brands','Products'],
        ]);

        $this->set(compact('stockAlert'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockAlert = $this->StockAlerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockAlert = $this->StockAlerts->patchEntity($stockAlert, $this->request->getData());
            if ($this->StockAlerts->save($stockAlert)) {
                $this->Flash->success(__('The stock alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock alert could not be saved. Please, try again.'));
        }
        $brands = $this->StockAlerts->Brands->find('list', ['limit' => 200])->all();
        $products = $this->StockAlerts->Products->find('list', ['limit' => 200])->all();
        $typeAlerts = $this->StockAlerts->TypeAlerts->find('list', ['limit' => 200])->all();
        $this->set(compact('stockAlert', 'brands','products','typeAlerts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockAlert = $this->StockAlerts->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockAlert = $this->StockAlerts->patchEntity($stockAlert, $this->request->getData());
            if ($this->StockAlerts->save($stockAlert)) {
                $this->Flash->success(__('The stock alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock alert could not be saved. Please, try again.'));
        }
        $brands = $this->StockAlerts->Brands->find('list', ['limit' => 200])->all();
        $products = $this->StockAlerts->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('stockAlert', 'brands','products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockAlert = $this->StockAlerts->get($id);
        if ($this->StockAlerts->delete($stockAlert)) {
            $this->Flash->success(__('The stock alert has been deleted.'));
        } else {
            $this->Flash->error(__('The stock alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
