<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductKos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'kota_id',
        'name_kos',
        'rating_kos',
        'tags_kos',
        'description_kos',
        'price_kos',
        'photo_product',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id', 'id');
    }

    public function kotas()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getPhotoProductAttribute($value)
    {
        return env('ASSET_URL') . '/uploads/' . $value;
    }
}
