<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;
use Ramsey\Uuid\Uuid;

class BeritaAcara extends Model
{
    use HasFactory,HasUuids,Sortable;
    protected $table = 'berita_acara';
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    protected $fillable = [
        'nomor',
        'pembuat_id',
        'penerima_id',
        'tanggal_dibuat',
        'detail_barang_id',
        'pembelian_id',
        'pengecekan_id',
        'ttd_purchasing_id',
        'purchasing_date',
        'using_date',
        'approved_date',
        'status',
        'ttd_pengecekan_id',
        'pengecekan_date',
        'spesifikasi'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
        static::deleting(function ($beritaAcara) {
            // Delete related records
            $beritaAcara->detail_barang()->delete();
            $beritaAcara->pembelian()->delete();
            $beritaAcara->pengecekan()->delete();
        });
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }
    public function penerima(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
    public function purchasing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ttd_purchasing_id');
    }
    public function detail_barang(): BelongsTo
    {
        return $this->belongsTo(DetailBarang::class, 'detail_barang_id');
    }
    public function pembelian(): BelongsTo
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }
    public function pengecekan(): BelongsTo
    {
        return $this->belongsTo(Pengecekan::class, 'pengecekan_id');
    }
}
