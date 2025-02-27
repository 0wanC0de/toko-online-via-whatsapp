<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalSales extends Model
{
    protected $table = 'total_sales'; // Nama tabel di database
    protected $fillable = ['product_id', 'total_sold', 'total_revenue']; // Kolom yang bisa diisi

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}