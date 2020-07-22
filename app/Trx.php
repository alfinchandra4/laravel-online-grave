<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx extends Model
{
    protected $table = 'trx';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
