<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryEntry extends Model
{
    use HasFactory;

    // Buka kunci biar kolom ini bisa diisi dari Controller
    protected $fillable = [
        'user_id',
        'content',
        'cloud_type',
    ];

    // Relasi balik ke User (Satu curhatan milik satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
