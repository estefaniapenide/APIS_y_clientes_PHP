<?php

namespace App\Database\Seeds\APIv1;;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker=Factory::create();

        $users=[
            [   'username' => 'juan',
                'password' => password_hash('1234',PASSWORD_DEFAULT),
                'group' => 1
            ],
            [   'username' => 'pedro',
                'password' => password_hash('1234',PASSWORD_DEFAULT),
                'group' => 2
            ],

        ];

        $builder = $this->db->table('users');
        $builder->insertBatch($users);
    }
}
