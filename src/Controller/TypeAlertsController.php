<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TypeAlerts Controller
 *
 * @property \App\Model\Table\TypeAlertsTable $TypeAlerts
 * @method \App\Model\Entity\TypeAlert[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeAlertsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeAlerts = $this->paginate($this->TypeAlerts);

        $this->set(compact('typeAlerts'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Alert id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeAlert = $this->TypeAlerts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('typeAlert'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeAlert = $this->TypeAlerts->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeAlert = $this->TypeAlerts->patchEntity($typeAlert, $this->request->getData());
            if ($this->TypeAlerts->save($typeAlert)) {
                $this->Flash->success(__('The type alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type alert could not be saved. Please, try again.'));
        }
        $this->set(compact('typeAlert'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Alert id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeAlert = $this->TypeAlerts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeAlert = $this->TypeAlerts->patchEntity($typeAlert, $this->request->getData());
            if ($this->TypeAlerts->save($typeAlert)) {
                $this->Flash->success(__('The type alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type alert could not be saved. Please, try again.'));
        }
        $this->set(compact('typeAlert'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Alert id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeAlert = $this->TypeAlerts->get($id);
        if ($this->TypeAlerts->delete($typeAlert)) {
            $this->Flash->success(__('The type alert has been deleted.'));
        } else {
            $this->Flash->error(__('The type alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
