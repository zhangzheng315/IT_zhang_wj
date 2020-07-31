<?php
namespace app\common\services;

abstract class Service
{
    protected $model;
    protected $time = '00-00-00 00:00:00';
    protected $status = 1;

    public function __construct()
    {
        $this->time = date('Y-m-d H:i:s');
        $this->makeModel();

    }

    abstract protected function model();

    public function makeModel()
    {
        if ($this->model) {
            return $this->model;
        }
        $model_class = $this->model();
        $model = new $model_class;
        return $this->model = $model;
    }
}