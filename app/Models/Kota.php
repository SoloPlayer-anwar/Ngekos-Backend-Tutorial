<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kota',
        'photo_kota',
    ];

    public function productkos()
    {
        return $this->hasMany(ProductKos::class, 'kota_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getPhotoKotaAttribute($value)
    {
        return env('ASSET_URL') . "/uploads/" . $value;
    }

}
