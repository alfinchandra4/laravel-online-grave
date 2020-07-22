<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    protected $table = 'package_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function package() {
        return $this->belongsTo('App\Package');
    }
}
