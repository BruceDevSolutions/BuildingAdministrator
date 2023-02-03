<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraordinaryFee extends Model
{
    use HasFactory;
    
    protected $guarded = ['id','created_at','updated_at'];
    
    public function properties()
    {
        return $this->belongsToMany(Property::class,'extraordinary_fee_property')->withPivot('status');
    }

    public function properties_paid()
    {
        return $this->belongsToMany(Property::class,'extraordinary_fee_property')->wherePivot('status', 1)->withPivot('status');
    }

    public function properties_pending()
    {
        return $this->belongsToMany(Property::class,'extraordinary_fee_property')->wherePivot('status', 0)->withPivot('status');
    }
}
