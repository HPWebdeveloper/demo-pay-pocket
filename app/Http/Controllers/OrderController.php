<?php

namespace App\Http\Controllers;

use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;
use HPWebdeveloper\LaravelPayPocket\Traits\GetWallets;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use GetWallets;

    private $order_value;

    public function pay()
    {

        $user = auth()->user();
        $orderValue = 100; // Assign or configure this value for each individual request.

        try {
            LaravelPayPocket::pay($user, $orderValue);

            return redirect()->route('home')->with('status', 'Order paid successfully.');
        } catch (InsufficientBalanceException $e) {
            // Handle specific InsufficientBalanceException
            return redirect()->route('home')->with('status', $e->getMessage());
        } catch (\Exception $e) {
            // Handle any other unexpected exceptions
            return redirect()->route('home')->with('status', 'Error processing the order.');
        }

        return redirect()->route('home');
    }
}
