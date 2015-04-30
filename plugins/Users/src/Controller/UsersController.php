<?php
namespace Users\Controller;

use Users\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Bake\Utility\Model\AssociationFilter;

/**
 * Users Controller
 *
 * @property \Users\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as crudSave;
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'logout']);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams']
        ];

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $data = $id
            ? $this->Users->get($id)
            : $this->Users->newEntity();

        if ($this->request->is(['post', 'put', 'patch'])) {
            $validate = 'default';
            if (!$id || !empty($this->request->data['password'])) {
                $validate = 'password';
            } else {
                $data->accessible('password', false);
            }
            $data = $this->Users->patchEntity($data, $this->request->data, compact('validate'));
            if ($this->Users->save($data)) {
                $this->Flash->success('The entry has been saved.');

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The entry could not be saved. Please, try again.');
            }
        }

        $associations = $this->_filteredAssociations($this->Users);
        foreach ($associations as $assoc => $models) {
            foreach ($models as $k => $v) {
                $dataSet = $this->Users->{$k};
                $this->set(Inflector::variable($k), $dataSet->find('list'));
            }
        }
        //debug($associations);

        $name = Inflector::variable(Inflector::singularize($this->Users->alias()));
        $this->set($name, $data);
        $this->set(compact('id'));
        $this->set('_serialize', [$name]);
    }

    public function login()
    {
        $this->layout = 'login';

        if ($this->request->is('post')) {
            if ($user = $this->Auth->identify()) {
                $this->Auth->setUser($user);

                $this->Users->logLogin($user['id']);

                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function profile()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['post', 'put', 'patch'])) {
            $user->accessible('*', false);
            $user->accessible('password', true);
            $data = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'password_change']);
            if ($this->Users->save($data)) {
                $this->Flash->success('The entry has been saved.');

                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error('The entry could not be saved. Please, try again.');
            }
        }

        $this->set(compact('user'));
    }

}
