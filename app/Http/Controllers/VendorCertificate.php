<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class VendorCertificate extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $vendorTuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        $pdf = PDF::loadView('vendor_doc_certificate', [
            'vendorName' => $vendorTuple->name,

        ]);

        return $pdf->stream();
    }
}
