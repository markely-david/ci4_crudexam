<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryStatusToExams extends Migration
{
    public function up()
    {
        $fields = [
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'description',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'active',
                'after' => 'category',
            ],
        ];
        $this->forge->addColumn('exams', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('exams', ['category', 'status']);
    }
}
