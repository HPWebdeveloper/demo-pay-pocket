<?php

namespace App\Http\Controllers;

use App\Models\User;
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     *  Increase User's Wallet Balance
     */
    public function deposit(Request $request)
    {

        $user = auth()->user();

        // dd($user->getWalletBalanceByType('wallet_10'));
        $amount = 200; // Assign or configure this value for each individual request.

        $type = $request->type;

        try {
            LaravelPayPocket::deposit($user, $type, $amount);

            return back()->with('status', 'Deposit done successfully!');
        } catch (InvalidDepositException $e) {
            // Handle the specific case of an invalid deposit
            return back()->with('status', $e->getMessage());
        } catch (\Exception $e) {
            // Handle any other unforeseen exceptions
            return back()->with('status', 'Unable to process deposit.');
        }

        return back()->with('status', 'Deposit done successfully!');
    }
}
