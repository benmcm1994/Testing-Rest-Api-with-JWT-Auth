<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = ['name', 'description', 'gain', 'trades', 'type', 'price'];
}
