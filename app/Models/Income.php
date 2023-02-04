<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    const MULTA = '1';
    const CUOTA_EXTRAORDINARIA = '2';
    const EXPENSA = '3';
    const OTRO = '4';

    public function property_fine()
    {
        return $this->belongsToMany(Property::class, 'income_fine_property');
    }

    public function property_extraordinary_fee()
    {
        return $this->belongsToMany(Property::class, 'income_extraordinary_fee_property');
    }

    public function property_expense()
    {
        return $this->belongsToMany(Property::class, 'income_expense_property');
    }
}
