<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

class Pengecekan extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'pengecekan';
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing
    protected $fillable = [
        'checker',
        'checking_date',
        'foto1',
        'foto2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
    
    public function berita_acara() : HasOne
    {
        return $this->hasOne(BeritaAcara::class);
    }
}
