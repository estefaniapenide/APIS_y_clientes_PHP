<?php

namespace App\Database\Seeds\APIv1;;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $this->call('GroupsSeeder');
        $this->call('UsersSeeder');

    }
}

