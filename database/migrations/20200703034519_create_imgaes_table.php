<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateImgaesTable extends Migrator
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
        $table = $this->table('images', array('engine' => 'InnoDB', 'id' => false, 'primary_key' => 'img_id', 'collation' => 'utf8mb4_general_ci'));
        $table->addColumn('img_id', 'integer', array('limit' => 11,'comment' => '图片id'))
            ->addColumn('img_name', 'string', array('limit' => 11, 'default' => '', 'comment' => '图片分类'))
            ->addColumn('img_url', 'string', array('limit' => 50, 'default' => '', 'comment' => '图片路径'))
            ->addColumn('ifcation_id', 'integer', array('limit' => 11, 'comment' => '标识id'))
            ->addColumn('img_title', 'string', array('limit' => 255, 'comment' => '图片标题'))
            ->addColumn('img_concent', 'string', array('limit' => 255, 'comment' => '图片内容'))
            ->addColumn('created_at', 'timestamp', array('null' => true, 'comment' => '创建时间'))
            ->addColumn('updated_at', 'timestamp', array('null' => true, 'comment' => '最后更新时间'))
            ->addIndex('img_url')
            ->create();
    }
}