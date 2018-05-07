<?php


use Phinx\Migration\AbstractMigration;

class CreateStudents extends AbstractMigration
{
    public function up()
    {
        $this->table('students')
            ->addColumn('name', 'string', ['length' => 50])
            ->addColumn('cpf', 'string', ['length' => 11])
            ->addColumn('rg', 'string', ['length' => 14])
            ->addColumn('phone', 'string', ['length' => 13])
            ->addColumn('birthday', 'date')
            ->addTimestamps()
            ->addIndex(['cpf'], ['unique' => true, 'name' => 'idx_students_cpf'])
            ->save();
    }

    public function down()
    {
        $this->dropTable('students');
    }
}
