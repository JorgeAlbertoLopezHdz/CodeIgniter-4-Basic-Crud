<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $currentDateTime = date('Y-m-d H:i:s');

        $data = [
            [
                "name" => "Jorge López",
                "email" => "jorge@gmail.com",
                "birth_date" => date('Y-m-d H:i:s', strtotime("01-01-1999 00:00:00")),
                "role_id" => 1,
                "status" => 1,
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Jesús Almendarez",
                "email" => "jesus@gmail.com",
                "birth_date" => date('Y-m-d H:i:s', strtotime("15-02-1999 00:00:00")),
                "role_id" => 2,
                "status" => 1,
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Josep Garza",
                "email" => "josep@gmail.com",
                "birth_date" => date('Y-m-d H:i:s', strtotime("22-06-1999 00:00:00")),
                "role_id" => 3,
                "status" => 1,
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Esteban Melchor",
                "email" => "esteban@gmail.com",
                "birth_date" => date('Y-m-d H:i:s', strtotime("11-10-1999 00:00:00")),
                "role_id" => 3,
                "status" => 0,
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Efrain Puente",
                "email" => "efrain@gmail.com",
                "birth_date" => date('Y-m-d H:i:s', strtotime("26-11-1999 00:00:00")),
                "role_id" => 3,
                "status" => 1,
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
