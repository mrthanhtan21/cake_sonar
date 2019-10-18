<?php


namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\Table;

class UserAddressTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasOne('User')
            ->setName('user')
            ->setDependent(true);

        $this->addBehavior('Timestamp');
    }
}
