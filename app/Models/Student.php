<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nisn',
        'major',
        'email',
        'certification_scheme_id',
    ];

    public function certificationScheme(): BelongsTo
    {
        return $this->belongsTo(CertificationScheme::class);
    }
}
