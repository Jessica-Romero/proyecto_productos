<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProductStock Controller
 *
 * @property \App\Model\Table\ProductStockTable $ProductStock
 * @method \App\Model\Entity\ProductStock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductStockController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Shops'],
        ];
        $productStock = $this->paginate($this->ProductStock);

        $this->set(compact('productStock'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Stock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productStock = $this->ProductStock->get($id, [
            'contain' => ['Products', 'Shops'],
        ]);

        $this->set(compact('productStock'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productStock = $this->ProductStock->newEmptyEntity();
        if ($this->request->is('post')) {
            $productStock = $this->ProductStock->patchEntity($productStock, $this->request->getData());
            if ($this->ProductStock->save($productStock)) {
                $this->Flash->success(__('The product stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product stock could not be saved. Please, try again.'));
        }
        $products = $this->ProductStock->Products->find('list', ['limit' => 200])->all();
        $shops = $this->ProductStock->Shops->find('list', ['limit' => 200])->all();
        $this->set(compact('productStock', 'products', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Stock id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productStock = $this->ProductStock->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productStock = $this->ProductStock->patchEntity($productStock, $this->request->getData());
            if ($this->ProductStock->save($productStock)) {
                $this->Flash->success(__('The product stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product stock could not be saved. Please, try again.'));
        }
        $products = $this->ProductStock->Products->find('list', ['limit' => 200])->all();
        $shops = $this->ProductStock->Shops->find('list', ['limit' => 200])->all();
        $this->set(compact('productStock', 'products', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Stock id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productStock = $this->ProductStock->get($id);
        if ($this->ProductStock->delete($productStock)) {
            $this->Flash->success(__('The product stock has been deleted.'));
        } else {
            $this->Flash->error(__('The product stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
