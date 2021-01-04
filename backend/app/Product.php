<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Product extends BaseModel
{
    protected $table = 'products';
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
