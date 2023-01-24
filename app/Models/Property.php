<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    const DEPARTAMENTO = 1;
    const LOCAL_COMERCIAL = 2;

    protected $guarded = ['id', 'created_at','updated_at'];
}
