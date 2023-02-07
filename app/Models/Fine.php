<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function income()
    {
        return $this->belongsToMany(Income::class, 'income_fine_property');
    }
}
