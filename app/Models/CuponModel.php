<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuponModel extends Model
{
    protected $table= 'cupon';
    protected $primaryKey = 'id_cupon';
    public $timestamps= false;  
    
}
