<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

class DetailBarang extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'detail_barang';
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    protected $fillable = [
        'brand_id',
        'type_id',
        'serial_number',
        'pc_name',
        'password',
        'os_id',
        'os_product_key',
        'office_id',
        'office_product_key',
        'other'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function berita_acara(): HasOne
    {
        return $this->hasOne(Brand::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function os(): BelongsTo
    {
        return $this->belongsTo(OS::class, 'os_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
