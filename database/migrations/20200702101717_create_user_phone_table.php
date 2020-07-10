<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateUserPhoneTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('user_phone', array('engine' => 'InnoDB', 'id' => false, 'primary_key' => 'user_id', 'collation' => 'utf8mb4_general_ci'));
        $table->addColumn('user_id', 'integer', array('limit' => 11, 'signed' => false, 'default' => 0, 'comment' => '账户ID'))
            ->addColumn('phone', 'string', array('limit' => 20, 'default' => '', 'comment' => '手机号'))
            ->addColumn('created_at', 'timestamp', array('null' => true, 'comment' => '创建时间'))
            ->addColumn('updated_at', 'timestamp', array('null' => true, 'comment' => '最后更新时间'))
            ->addIndex('phone')
            ->create();
    }
}
