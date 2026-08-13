<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLegalPages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'page_key'   => ['type' => 'VARCHAR', 'constraint' => 60],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 150],
            // Simple markup: blank line = new paragraph, a line starting with
            // "## " renders as a subheading. Good enough for legal copy
            // without needing a rich-text editor.
            'content'    => ['type' => 'TEXT'],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('page_key');
        $this->forge->createTable('legal_pages');
    }

    public function down()
    {
        $this->forge->dropTable('legal_pages');
    }
}
