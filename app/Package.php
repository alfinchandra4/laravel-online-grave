<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function package_detail() {
                            // relation, fk package, pk package
        return $this->hasMany('App\PackageDetail', 'package_id', 'id');
    }
}
