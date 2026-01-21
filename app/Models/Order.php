<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'jumlah',
        'total_harga',
        'level_pedas',
        'keterangan',
        'status',
        'bukti',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
