<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

class UserController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index()
    {

        $this->loadComponent('Paginator');

        $users = $this->Paginator->paginate(
            $this->User
                ->find()
                ->where(['disable =' => 0])
                ->contain(['User_address'])
        );
        $this->set(compact('users'));
    }

    public function delete() {
        if (isset($_GET['id'])) {
            // Prior to 3.6.0
            if($this->User->delete_user($_GET['id'])) {
                $this->redirect('/user');
            }
        } else {
            echo 'Empty User delete';
        }
    }

    public function create() {
        if (!empty($_POST)) {
            // Insert information Address
            if ($user = $this->User->insertUser($_POST)) {
                if ($this->User->insertUserAddress($_POST, $user)) {
                    $this->redirect('/user');
                } else {
                    echo 'Save User Address Error';
                }
            } else {
                echo 'Save User Error';
            }
        } else {
            echo 'Empty User delete';
        }
    }

    public function getUserById() {
        if (isset($_POST['user_id'])) {
            $this->loadComponent('Paginator');

            $users = $this->Paginator->paginate(
                $this->User
                    ->find()
                    ->where(['disable =' => 0])
                    ->contain(['User_address'])
            );
            foreach ($users as $key => $value) {
                if ($value->id == $_POST['user_id']) {
                    $data = $value;
                }
            }
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'data' => $data,
                    'result' => true
                ]));
        } else {
            echo 'Empty User delete';
        }
    }

}
