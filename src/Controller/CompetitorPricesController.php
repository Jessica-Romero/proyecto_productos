<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CompetitorPrices Controller
 *
 * @property \App\Model\Table\CompetitorPricesTable $CompetitorPrices
 * @method \App\Model\Entity\CompetitorPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitorPricesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Competitors', 'Products'],
        ];
        $competitorPrices = $this->paginate($this->CompetitorPrices);

        $this->set(compact('competitorPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Competitor Price id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitorPrice = $this->CompetitorPrices->get($id, [
            'contain' => ['Competitors', 'Products'],
        ]);

        $this->set(compact('competitorPrice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitorPrice = $this->CompetitorPrices->newEmptyEntity();
        if ($this->request->is('post')) {
            $competitorPrice = $this->CompetitorPrices->patchEntity($competitorPrice, $this->request->getData());
            if ($this->CompetitorPrices->save($competitorPrice)) {
                $this->Flash->success(__('The competitor price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor price could not be saved. Please, try again.'));
        }
        $competitors = $this->CompetitorPrices->Competitors->find('list', ['limit' => 200])->all();
        $products = $this->CompetitorPrices->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('competitorPrice', 'competitors', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competitor Price id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitorPrice = $this->CompetitorPrices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitorPrice = $this->CompetitorPrices->patchEntity($competitorPrice, $this->request->getData());
            if ($this->CompetitorPrices->save($competitorPrice)) {
                $this->Flash->success(__('The competitor price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor price could not be saved. Please, try again.'));
        }
        $competitors = $this->CompetitorPrices->Competitors->find('list', ['limit' => 200])->all();
        $products = $this->CompetitorPrices->Products->find('list', ['limit' => 200])->all();
        $this->set(compact('competitorPrice', 'competitors', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competitor Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competitorPrice = $this->CompetitorPrices->get($id);
        if ($this->CompetitorPrices->delete($competitorPrice)) {
            $this->Flash->success(__('The competitor price has been deleted.'));
        } else {
            $this->Flash->error(__('The competitor price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
