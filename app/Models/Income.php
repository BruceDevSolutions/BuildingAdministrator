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

    protected $guarded = ['id','created_at','updated_at'];

    /* Para encontrar la propiedad al que pertenece una multa */
    public function property_fine()
    {
        return $this->belongsToMany(Property::class, 'income_fine_property')->withPivot(['fine_id']);
    }

    /* para encontrar una multa específica */
    public function fine()
    {
        return $this->belongsToMany(Fine::class, 'income_fine_property');
    }

    public function property_extraordinary_fee()
    {
        return $this->belongsToMany(Property::class, 'income_extraordinary_fee_property')->withPivot(['extraordinary_fee_id']);
    }

    public function property_expense()
    {
        return $this->belongsToMany(Property::class, 'income_expense_property')->withPivot(['paid_up_to']);
    }
}
