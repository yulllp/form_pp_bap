<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Department extends Model
{
    use HasFactory,HasUuids;
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    
    protected $fillable = [
        'nama',
        'pemimpin_id'
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
}
