<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateApplicationTable extends Migrator
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
        $table = $this->table('application', array('engine' => 'InnoDB','collation' => 'utf8mb4_general_ci'));
        $table->addColumn('status', 'integer', array('limit' => 11, 'default' => '1', 'comment' => '产品状态'))
            ->addColumn('title','string',array('limit'=>255,'comment'=>'产品领域'))
            ->addColumn('image','string',array('limit'=>255,'comment'=>'领域图片'))
            ->addColumn('content', 'text', array('limit'=>5000, 'comment' => '产品详情'))
            ->addColumn('created_at', 'timestamp', array('null' => true, 'comment' => '创建时间'))
            ->addColumn('updated_at', 'timestamp', array('null' => true, 'comment' => '最后更新时间'))
            ->create();
    }
}
