<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        // dd(Cart::get());
        dd($order->products);
        foreach ($order->products as $product) {
            // Product::where('id', $product->id)
            //     ->decrement('quantity', $product->quantity);
            $product->decrement($product->order_item->quantity);
        }
    }
}
