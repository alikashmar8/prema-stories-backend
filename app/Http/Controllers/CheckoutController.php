<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cartalyst\Stripe\Stripe;
use App\Models\Order;


class CheckoutController extends Controller
{
    public function checkout(Product $product)
    {
        // Enter Your Stripe Secret
        $secretKey = env("STRIPE_SECRET_KEY", "");
        $publicKey = env("STRIPE_PUBLIC_KEY", "");
        // \Stripe\Stripe::setApiKey($secretKey);

        $amount = $product->price;
        $amount *= 100;
        $amount = (int) $amount;

        // $payment_intent = \Stripe\PaymentIntent::create([
        //     'description' => $product->name,
        //     'amount' => $amount,
        //     'currency' => 'AUD',
        //     'payment_method_types' => ['card'],
        // ]);
        // $intent = $payment_intent->client_secret;

        $errors = [];

        $stripe_key = $publicKey;

        return view('checkouts.checkout', compact( 'errors', 'stripe_key', 'product'));
    }


    public function store(Request $request)
    {
        $product = Product::find($request->productId);
        $email = $request->email;
        $phone = $request->phone;
        $name = $request->name;
        $address = $request->address;
        $city = $request->city;
        $state = $request->province;
        $zip_code = $request->postalcode;
        $amount = $product->price;
        try {
            $secretKey = env("STRIPE_SECRET_KEY", "");
            $stripe = Stripe::make($secretKey);
            $charge = $stripe->charges()->create([
                'amount' => $amount,
                'currency' => 'AUD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    // 'contents' => $contents,
                ],
            ]);

            $address = 'City: ' . $city . '. state: ' . $state . '. address: ' . $address;

            $order = Order::create([
                'email' => $email,
                'name' => $name,
                'address' => $address,
                'phone_number' => $phone,
                'zip_code' => $zip_code,
                'payment_type' => 'STRIPE'
            ]);

            $order->products()->attach($request->productId);

            $order->products;


            $frontBaseUrl = env("FRONTEND_BASE_URL", "boostforu.com");
            // $adminEmail = env("ADMIN_MAIL_RECEIVER", "boostforu0@gmail.com");


            //redirect to frontend product page
            return redirect()->away($frontBaseUrl . '/products/' . $product->id . '?success=true');


            // Mail::send(new OrderPlaced($order));

            // return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
