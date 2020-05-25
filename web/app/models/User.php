<?php

namespace app\models;

use app\models\helpers\{modelsInsert, modelsRead, modelsUpdate, modelsDelete, modelsPagination};
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table  = 'users';
    protected $guarded = ['id', 'password'];

    public $id;
    public $name;
    public $email;
    public $password;
}