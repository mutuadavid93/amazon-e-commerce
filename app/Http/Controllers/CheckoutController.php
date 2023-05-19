<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
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
        // TIP: Never use env() in a controller. Use config() instead.
        // If config:cache is ran, the env() function will not be loaded.
        $secret = config('app.stripe_secret');

        $stripe = new \Stripe\StripeClient(
            (string) $secret
        );

        $order = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', null)
            ->first();

        // if (is_null($order)) {
        //     return redirect()->route('checkout_success.index');
        // }

        $total = $order->total;

        // Construct a payment intent
        $intent = $stripe->paymentIntents->create([
            'amount' => (int) $total,
            // 'amount' => 1000,
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
    public function update(Request $request)
    {
        $payment_intent = $request->payment_intent;
        $order = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', null)
            ->first();
        // sleep(3);
        $order->payment_intent = $payment_intent;
        $order->save();

        // Send email if payment is successful
        // 
        // Fill i .env environment variables using your smtp credentials
        // and uncomment the following lines
        Mail::to($request->user())->send(new OrderShipped($order));

        return redirect()->route('checkout_success.index');
    }
}
