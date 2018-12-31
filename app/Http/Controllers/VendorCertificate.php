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
        // Get vendor tuple from table vendor_doc.

        $vendorTuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        // Get CIDB tuples from table cidb_details.

        $cidbTuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->get();

        // Get MOF tuples from table mof_details.

        $mofTuples = DB::table('mof_details')->where('vd_id', '=', $id)
            ->join('mof_ref', 'mof_details.mof_id', '=', 'mof_ref.id')
            ->pluck('description', 'code');

        // Show page.

        $pdf = PDF::loadView('vendor_doc_certificate', [
            'vendor' => $vendorTuple,
            'cidbTuples' => $cidbTuples,
            'mofTuples' => $mofTuples
        ]);

        return $pdf->stream();
    }
}
