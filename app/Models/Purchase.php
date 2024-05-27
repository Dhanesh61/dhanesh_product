<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase'; 
    protected $fillable = ['user_id', 'product_id', 'name', 'quantity', 'price', 'image','status']; 

    const PENDING = 'pending';
    const APPROVED = 'approved';
    const CANCELLED = 'cancelled';
    const ORDERCANCEL = 'your order has been cancel';
}
