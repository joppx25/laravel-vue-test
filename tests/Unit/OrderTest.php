<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $orders;
    protected $userOrders;
    protected $orderDetails;

    public function setUp(): void
    {
        parent::setUp();
        $this->orders = Order::factory()
            ->has(OrderItem::factory()->count(5))
            ->count(5)
            ->create();

        $this->userOrders = User::factory()
            ->has(Order::factory()->count(5))
            ->create();
    }


    public function test_get_all_orders_for_user()
    {
        $this->assertNotEmpty($this->userOrders->orders);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_order_has_order_items()
    {
        $this->assertInstanceOf(OrderItem::class, $this->orders->first()->orderItems->first());
    }

    public function test_get_order_item_details()
    {
        $result = $this->orders->first()->getOrderDetails();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('lunch', $result);
    }
}
