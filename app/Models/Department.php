<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
    use HasFactory,HasUuids,Sortable;
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    
    protected $fillable = [
        'nama',
        'pemimpin_id'
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

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }


    public function leader() : BelongsTo
    {
        return $this->belongsTo(User::class, 'pemimpin_id');
    }

    public function scopeFilter(Builder $query, array $filters): void{
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        });
    }
}
