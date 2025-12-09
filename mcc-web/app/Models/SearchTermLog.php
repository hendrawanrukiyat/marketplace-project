<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchTermLog extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'search_terms_log';

    protected $fillable = [
        'term',         // Kata kunci pencarian
        'ip_address',   // IP Pengunjung
    ];
}