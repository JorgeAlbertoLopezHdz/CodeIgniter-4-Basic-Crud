<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "id" => [
                    "type" => "INT",
                    "constraint" => 11,
                    "unsigned" => true,
                    "auto_increment" => true
                ],
                "name" => [
                    "type" => "VARCHAR",
                    "constraint" => 50,
                    "null" => false
                ],
                "email" => [
                    "type" => "VARCHAR",
                    "constraint" => 100,
                    "null" => false
                ],
                "birth_date" => [
                    "type" => "DATE",
                    "null" => false
                ],
                "role_id" => [
                    "type" => "INT",
                    "constraint" => 11,
                    "unsigned" => true,
                ],
                "status" => [
                    "type" => "BOOLEAN",
                    "null" => false
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
            ]
        );

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("role_id", "roles", "id", "CASCADE", "CASCADE");

        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
