<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use HPWebdeveloper\LaravelPayPocket\Traits\GetWallets;
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;

class OrderController extends Controller
{
    use GetWallets;

    private $order_value;

    public function pay()
    {

        $user = auth()->user();
        $orderValue = 100;

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
