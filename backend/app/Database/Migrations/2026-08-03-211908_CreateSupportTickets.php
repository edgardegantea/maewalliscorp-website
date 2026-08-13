<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupportTickets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'folio'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'subject'     => ['type' => 'VARCHAR', 'constraint' => 200],
            'description' => ['type' => 'TEXT'],
            'status'      => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'abierto'],
            'partner_id'  => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'admin_notes' => ['type' => 'TEXT', 'null' => true],
            'source'      => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'chatbot'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('folio');
        $this->forge->createTable('support_tickets');
    }

    public function down()
    {
        $this->forge->dropTable('support_tickets');
    }
}
