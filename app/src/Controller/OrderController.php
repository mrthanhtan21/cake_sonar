<?php


namespace App\Controller\Component;
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class OrderController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Order');
        $this->loadModel('OrderDetail');
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $orders = $this->Order->getOrderInfo();
        $this->set(compact('orders'));
    }

    public function delete() {
        if (isset($_GET['id'])) {
            // Prior to 3.6.0
           if ($this->Order->delete_order($_GET['id'])){
                $this->redirect('/order');
           }
        } else {
            echo 'Empty Order delete';
        }
    }

    public function edit()
    {
        if (!empty($_POST)) {
            // Insert information Address
            if ($this->Order->insertOrder($_POST) && isset($_POST['order_id'])) {
                if ($this->Order->insertOrderDetail($_POST)) {
                    $this->redirect('/order');
                }
            } else {
                echo 'Save Error';
            }
        } else {
            echo 'Empty User delete';
        }
    }

    public function getOrderById() {
        if (isset($_POST['order_id'])) {
            $this->loadComponent('Paginator');

            $orders = $this->Paginator->paginate(
                $this->Order
                    ->find()
                    ->where(['disable =' => 0])
                    ->contain(['Order_detail'])
            );
            foreach ($orders as $key => $value) {
                if ($value->id == $_POST['order_id']) {
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
