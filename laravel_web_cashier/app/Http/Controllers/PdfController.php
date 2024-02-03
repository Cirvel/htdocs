<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Export pdf
     */
    public function struk(Request $request)
    {
        $cart = session()->get('cart'); // Get data from cart
        $register = $request['register']; // Get register name
        $nickname = $request['nickname']; // Get nickname
        // $nickname = auth()->user()->nickname; // Get own nickname
        $sum = array_sum($cart);

        $data = [ // Create variables
            'title'     => 'Payment', // Title
            'nickname'  => $nickname, // Nickname
            'register'  => $register, // Register
            'date'      => date('m/d/y'), // Date format of creation
            'carts'     => $cart, // Table
            'sum'       => $sum,
        ];
        $pdf = Pdf::loadView('pdf.struk',$data); // Print data to pdf
        return $pdf->download('result-struk.pdf'); // Download pdf
        // return $pdf->stream('result-struk.pdf'); // View pdf
    }
}
