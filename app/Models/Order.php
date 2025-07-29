<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "orders";
    protected $fillable = [
        'voucherNo',
        'qty',
        'total',
        'paymentSlip',
        'paymentID',
        'itemID',
        'userID',
        'shipping_name',      
        'shipping_address',   
        'shipping_phone', 
        'status',
        'cancellation_reason'
    ];
    // Relationships
    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}



