<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid;

class PtTujuan extends Model
{
    use HasFactory,HasUuids,Sortable;

    protected $table = 'pt_tujuans';
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false;

    protected $fillable = [
        'name',
        'status'
    ];

    public $sortable = [
        'status'
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
    
    public function scopeFilter(Builder $query, array $filters): void{
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
