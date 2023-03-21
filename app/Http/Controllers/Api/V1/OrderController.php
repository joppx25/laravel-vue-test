<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function getOrdersByUser()
    {
        $orders = Order::select(['id', 'delivery_date', 'price'])
            ->where('user_id', Auth::user()->id)
            ->get();

        return OrderResource::collection($orders);
    }

    public function getOrderDetails(Order $order)
    {
        $orderDetails = $order->getOrderDetails();
        return OrderDetailResource::collection($orderDetails)->groupBy('meal_type');
    }

    public function exportOrder(Order $order)
    {
        $orderId      = $order->id;
        $orderPrice   = $order->price;
        $orderDetails = OrderDetailResource::collection($order->getOrderDetails())->groupBy('meal_type');
        $details      = [];
        $temp         = [];
        foreach ($orderDetails as $meal => $detail) {
            if ($meal === 'lunch' || $meal === 'dinner') {
                $details['Dinner and lunch'] = $detail->toArray();
            } else {
                $mealKey = ucfirst($meal);
                $temp[$mealKey] = $detail->toArray();
            }
        }

        $details += $temp; // merge two array 
        $pdf = Pdf::loadView('templates.pdf.order-history', compact('details', 'orderId', 'orderPrice'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('order-history-#' . $orderId . '.pdf');
    }
}
