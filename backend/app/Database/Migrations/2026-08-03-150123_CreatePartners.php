<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePartners extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 150],
            'name'           => ['type' => 'VARCHAR', 'constraint' => 150],
            'role'           => ['type' => 'VARCHAR', 'constraint' => 200],
            'semblanza'      => ['type' => 'TEXT'],
            // JSON-encoded arrays: academico/profesional/publicaciones are string[]; links is {label,url}[]
            'academico'      => ['type' => 'TEXT', 'null' => true],
            'profesional'    => ['type' => 'TEXT', 'null' => true],
            'publicaciones'  => ['type' => 'TEXT', 'null' => true],
            'links'          => ['type' => 'TEXT', 'null' => true],
            'pending_review' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'position'       => ['type' => 'INT', 'default' => 0],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('partners');
    }

    public function down()
    {
        $this->forge->dropTable('partners');
    }
}
