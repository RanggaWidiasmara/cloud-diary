<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'cloud_type',
        'ai_suggestion',
        'ai_bk_recommendation', // <-- TAMBAHAN BARU: Saran khusus untuk Guru BK
    ];

    // INI KUNCI PRIVASINYA (Application-Level Encryption)
    protected $casts = [
        'content' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
