<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'logo_in';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'password', 'tel'];
}
