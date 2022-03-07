<?php

namespace App\Admin\Repositories;

use App\Models\Scaffold as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Scaffold extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
