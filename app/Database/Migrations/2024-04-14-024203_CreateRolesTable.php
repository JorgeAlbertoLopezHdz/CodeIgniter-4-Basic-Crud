<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                "null" => false,
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 100,
                "null" => true
            ],
            "created_at" => [
                "type" => "DATETIME",
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true
            ],
            "deleted_at" => [
                "type" => "DATETIME",
                "null" => true
            ],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("roles");
    }

    public function down()
    {
        $this->forge->dropTable("roles");
    }
}
