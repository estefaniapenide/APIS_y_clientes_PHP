<?php

namespace App\Database\Seeds\APIv1;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class GroupsSeeder extends Seeder
{
    public function run()
    {
        $faker=Factory::create();

        $groups=[
            [  'name_group' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name_group' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        $builder = $this->db->table('groups');
        $builder->insertBatch($groups);
    }
}
