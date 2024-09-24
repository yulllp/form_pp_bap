<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class PermintaanPembelian extends Model
{
    use HasFactory,HasUuids;
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'pt_tujuan',
        'alasan',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barang() : HasMany
    {
        return $this->hasMany(Barang::class, 'pp_id');
    }
}
