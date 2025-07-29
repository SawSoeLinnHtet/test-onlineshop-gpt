<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\User;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'items';
    protected $fillable = [
        'codeNo',
        'name',
        'image',
        'price',
        'description',
        'discount',
        'inStock',
        'categoryID'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        // if your foreign key column is 'categoryID'
        return $this->belongsTo(Category::class, 'categoryID');
    }

    //Each Item belongs to one User (the seller)
    public function user()
    {
        // if your foreign key column is 'userID'
        return $this->belongsTo(User::class, 'userID');
    }
}
