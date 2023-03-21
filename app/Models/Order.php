<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderDetails()
    {
        return $this->select([
            'meals.id as meal_id',
            'meals.meal_name',
            'subscriptions_selections.meal_type as meal_type',
            DB::raw('COUNT("meals.id") as occurrences'),
            'orders.price'
        ])
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('subscriptions_selections', function($query) {
            $query
                ->on('subscriptions_selections.user_id', '=', 'orders.user_id')
                ->on('subscriptions_selections.subscription_cycle_id', '=', 'order_items.subscription_cycle_id')
                ->on('subscriptions_selections.product_id', '=', 'order_items.product_id');
        })
        ->join('meals', 'meals.id', '=', 'subscriptions_selections.meal_id')
        ->groupBy('meal_id', 'meal_type', 'price')
        ->where('orders.id', $this->id)
        ->get();
    }
}
