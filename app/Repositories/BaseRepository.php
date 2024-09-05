<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Builder|Model $model;

    public function __construct()
    {
        $this->model = $this->setModel();
    }

    abstract protected function setModel(): Model;
}
