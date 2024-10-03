<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

class Pembelian extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'pembelian';
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    protected $fillable = [
        'company_id',
        'pp',
        'pp_date',
        'po',
        'po_date',
        'sj',
        'sj_date',
        'receipt_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function company() : BelongsTo
    {
        return $this->belongsTo(PtTujuan::class, 'company_id');
    }

    public function berita_acara() : HasOne
    {
        return $this->hasOne(BeritaAcara::class);
    }
}
