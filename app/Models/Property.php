<?php

namespace App\Models;

use App\Models\ExtraordinaryFee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    const DEPARTAMENTO = 1;
    const LOCAL_COMERCIAL = 2;

    protected $guarded = ['id', 'created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function extraordinaryFees()
    {
        return $this->belongsToMany(ExtraordinaryFee::class,'extraordinary_fee_property');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function fines_pendant()
    {
        return $this->hasMany(Fine::class)->where('status', false);
    }
}
