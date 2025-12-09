<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductViewLog extends Model
{
    use HasFactory;

    protected $table = 'product_views_log';

    protected $fillable = [
        'product_id',
        'ip_address',
    ];

    public const UPDATED_AT = null;

    // --- TAMBAHKAN FUNGSI INI ---
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}