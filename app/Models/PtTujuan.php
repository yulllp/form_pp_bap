<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class PtTujuan extends Model
{
    use HasFactory,HasUuids;

    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function permintaan_pembelian() : HasMany
    {
        return $this->hasMany(PermintaanPembelian::class);
    }
}
