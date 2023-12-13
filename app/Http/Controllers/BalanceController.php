<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use HPWebdeveloper\LaravelPayPocket\Facades\LaravelPayPocket;


class BalanceController extends Controller
{
   /**
     *  Increase User's Wallet Balance
     *
     */
    public function deposit(Request $request)
    {

        $user = auth()->user();


        // dd($user->getWalletBalanceByType('wallet_10'));
        $amount = 1000; // Define or get this value as needed

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
