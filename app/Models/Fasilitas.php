<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_fasilitas',
        'photo_dapur',
        'photo_ruangan',
        'photo_kamar',
    ];


    public function productkos()
    {
        return $this->hasMany(productkos::class, 'fasilitas_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getPhotoDapurAttribute($value)
    {
        return env('ASSET_URL') . "/uploads/" . $value;
    }

    public function getPhotoRuanganAttribute($value)
    {
        return env('ASSET_URL') . "/uploads/" . $value;
    }

    public function getPhotoKamarAttribute($value)
    {
        return env('ASSET_URL') . "/uploads/" . $value;
    }
}
