<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $order = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', 'null')
            ->first();

        if (is_null($order)) {
            return redirect()->route('checkout_success.index');
        }

        // Construct a payment intent
        $intent = $stripe->paymentIntents->create([
            // NOTE: amount is in cents i.e. 2000 = $20 e.g. 20.00 The dot is ommitted
            'amount' => (int) $order->total,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return Inertia::render('Checkout', [
            'intent' => $intent,
            'order' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the order in the database
        $res = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', 'null')
            ->first();

        // If the order exists, update it
        if (!is_null($res)) {
            $res->total = $request->total;
            $res->total_decimal = $request->total_decimal;
            $res->items = json_encode($request->items);
            $res->save();
        } else {
            // Otherwise, create a new order
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->total = $request->total;
            $order->total_decimal = $request->total_decimal;
            $order->items = json_encode($request->items);
            $order->save();
        }

        return redirect()->route('checkout.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', 'null')
            ->first();
        $order->payment_intent = $request['payment_intent'];
        $order->save();

        return redirect()->route('checkout_success.index');
    }
}
