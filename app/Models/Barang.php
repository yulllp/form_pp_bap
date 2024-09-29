<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Barang extends Model
{
    use HasFactory,HasUuids;
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing

    protected $table = 'barang';


    protected $fillable = [
        'pp_id',
        'nama',
        'jumlah',
        'satuan',
        'tanggal_diperlukan',
        'keterangan_it'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function permintaan_pembelian() : BelongsTo
    {
        return $this->belongsTo(PermintaanPembelian::class);
    }
}
