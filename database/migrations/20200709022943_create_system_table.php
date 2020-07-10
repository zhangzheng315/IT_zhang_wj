<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateSystemTable extends Migrator
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
        $table = $this->table('system', array('engine' => 'InnoDB','collation' => 'utf8mb4_general_ci'));
        $table->addColumn('name', 'string', array('limit' => 255,  'comment' => '网站名称'))
            ->addColumn('title', 'string', array('limit' => 255,  'comment' => '标题'))
            ->addColumn('keyword', 'string', array('limit' => 255,  'comment' => '关键字'))
            ->addColumn('describe', 'string', array('limit' => 255,  'comment' => '站点描述'))
            ->addColumn('Statistics', 'string', array('limit' => 255,  'comment' => '统计代码'))
            ->addColumn('wx', 'string', array('limit' => 255,  'comment' => '客服微信'))
            ->addColumn('tel', 'string', array('limit' => 255,  'comment' => '联系电话'))
            ->addColumn('keeps', 'string', array('limit' => 255,  'comment' => '网站备案号'))
            ->addColumn('created_at', 'timestamp', array('null' => true, 'comment' => '创建时间'))
            ->addColumn('updated_at', 'timestamp', array('null' => true, 'comment' => '最后更新时间'))
            ->create();
    }
}
