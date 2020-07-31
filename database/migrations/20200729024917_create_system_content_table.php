<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateSystemContentTable extends Migrator
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
        $table = $this->table('system_content', array('engine' => 'InnoDB','collation' => 'utf8mb4_general_ci'));
        $table->addColumn('p_id', 'integer', array('limit' => 11,  'comment' => '产品父类ID'))
            ->addColumn('content', 'text', array('comment' => '产品内容'))
            ->addColumn('image','string',array('limit' => 255, 'comment' =>'图片'))
            ->addColumn('status', 'integer', array('limit' => 11, 'default' => '1', 'comment' => '产品状态'))
            ->addColumn('sort' , 'integer' , array('limit' => 11 , 'comment' => '排序'))
            ->addColumn('created_at', 'timestamp', array('null' => true, 'comment' => '创建时间'))
            ->addColumn('updated_at', 'timestamp', array('null' => true, 'comment' => '最后更新时间'))
            ->create();
    }
}
