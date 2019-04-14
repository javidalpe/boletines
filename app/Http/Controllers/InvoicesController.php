<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Stripe\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $invoices = $user->subscribed('main') ? $user->invoicesIncludingPending() : [];

        try {
            $nextInvoice = Invoice::upcoming(["customer" => $user->stripe_id]);
        } catch (\Exception $e) {
            $nextInvoice = null;
        }

        $data = [
            'nextInvoice' => $nextInvoice,
            'invoices' => $invoices,
        ];

        return view('dashboard.invoices.index', $data);
    }
}
