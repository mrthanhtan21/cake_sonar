<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class userTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasOne('User_address')
             ->setName('user_address')
             ->setDependent(true);

        $this->addBehavior('Timestamp');
    }

    public function delete_user($id) {
        $userTable = TableRegistry::get('User');

        $userTable = TableRegistry::getTableLocator()->get('User');
        $user = $userTable->get($id);

        $user->disable = 1;
        $user->update_date = date('Y-m-d H:i:s');
        return $userTable->save($user);
    }

    public function insertUser($param) {
        $userTable = TableRegistry::getTableLocator()->get('User');
        // insert information User
        if (isset($param['id'])) { // if have user id then edit
            $userdata = TableRegistry::getTableLocator()->get('User')->newEntity([
                'firstname' => $param['first_name'],
                'lastname' => $param['last_name'],
                'email' => $param['email'],
                'id' => $param['id'],
                'update_date' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $userdata = TableRegistry::getTableLocator()->get('User')->newEntity([
                'firstname' => $param['first_name'],
                'lastname' => $param['last_name'],
                'email' => $param['email'],
                'update_date' => date('Y-m-d H:i:s'),
                'create_date' => date('Y-m-d H:i:s'),
            ]);
        }
        return $user = $userTable->save($userdata);
    }

    public function insertUserAddress($param, $user) {
        $userAddressTable = TableRegistry::getTableLocator()->get('User_address');
        if (isset($param['id'])) {
            $query = TableRegistry::getTableLocator()->get('User_address')
                ->find()
                ->where(['user_id =' => $param['id']]);

            foreach ($query as $key => $address) {
                $data = $address;
            }
            $useraddress = TableRegistry::getTableLocator()->get('User_address')->newEntity([
                'address_1' => $param['address'],
                'address_2' => $param['address_2'], //stress
                'locality' => $param['locality'],
                'province' => $param['province'],
                'zipcode' => $param['zipcode'],
                'user_id' => $user->id,
                'id' => $data->id
            ]);
        } else {
            $useraddress = TableRegistry::getTableLocator()->get('User_address')->newEntity([
                'address_1' => $param['address'],
                'address_2' => $param['address_2'], //stress
                'locality' => $param['locality'],
                'province' => $param['province'],
                'zipcode' => $param['zipcode'],
                'user_id' => $user->id
            ]);
        }
        return $userAddressTable = $userAddressTable->save($useraddress);
    }
}
