<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProductPrices Controller
 *
 * @property \App\Model\Table\ProductPricesTable $ProductPrices
 * @method \App\Model\Entity\ProductPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductPricesController extends AppController
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
        $productPrices = $this->paginate($this->ProductPrices);

        $this->set(compact('productPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Price id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productPrice = $this->ProductPrices->get($id, [
            'contain' => ['Products', 'Shops'],
        ]);

        $this->set(compact('productPrice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productPrice = $this->ProductPrices->newEmptyEntity();
        if ($this->request->is('post')) {
            $productPrice = $this->ProductPrices->patchEntity($productPrice, $this->request->getData());
            if ($this->ProductPrices->save($productPrice)) {
                $this->Flash->success(__('The product price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product price could not be saved. Please, try again.'));
        }
        $products = $this->ProductPrices->Products->find('list', ['limit' => 200])->all();
        $shops = $this->ProductPrices->Shops->find('list', ['limit' => 200])->all();
        $this->set(compact('productPrice', 'products', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Price id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productPrice = $this->ProductPrices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productPrice = $this->ProductPrices->patchEntity($productPrice, $this->request->getData());
            if ($this->ProductPrices->save($productPrice)) {
                $this->Flash->success(__('The product price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product price could not be saved. Please, try again.'));
        }
        $products = $this->ProductPrices->Products->find('list', ['limit' => 200])->all();
        $shops = $this->ProductPrices->Shops->find('list', ['limit' => 200])->all();
        $this->set(compact('productPrice', 'products', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productPrice = $this->ProductPrices->get($id);
        if ($this->ProductPrices->delete($productPrice)) {
            $this->Flash->success(__('The product price has been deleted.'));
        } else {
            $this->Flash->error(__('The product price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
