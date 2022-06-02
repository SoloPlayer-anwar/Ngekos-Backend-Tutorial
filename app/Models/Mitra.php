<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_mitra',
        'alamat_mitra',
        'phone_mitra',
        'photo_ktp',
        'photo_kos',
        'latitude',
        'longitude',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getPhotoKtpAttribute($value)
    {
        return env('ASSET_URL'). "/uploads/".$value;
    }

    public function getPhotoKosAttribute($value)
    {
        return env('ASSET_URL'). "/uploads/".$value;
    }
}
