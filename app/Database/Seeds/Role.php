<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $currentDateTime = date('Y-m-d H:i:s');

        $data = [
            [
                "name" => "Aministrador",
                "description" => "Administrador de la plataforma",
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Moderador",
                "description" => "Moderador de usuarios",
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
            [
                "name" => "Usuario final",
                "description" => "Usuario básico",
                "created_at" => $currentDateTime,
                "updated_at" => null,
                "deleted_at" => null,
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
