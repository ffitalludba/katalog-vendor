<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class VendorDocController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vendors = DB::table('vendor_doc')->get();

        return view('vendor_doc_index', ['vendors' => $vendors]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $mof_tuples = DB::table('mof_ref')->get();

        $cidb_tuples = DB::table('cidb_ref')->get();

        return view('vendor_doc_create', ['mofs' => $mof_tuples, 'cidbs' => $cidb_tuples]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate all fields.

        $request->validate([
            'syarikat' => 'required|unique:vendor_doc,name',
            'pegawai' => 'required',
            'alamat' => 'required',
            'alamat1' => 'nullable',
            'poskod' => 'required',
            'bandar' => 'required',
            'negeri' => 'required',
            'telefon' => 'required',
            'emel' => 'required|email',
            'daftarMpspk' => 'nullable',
            'sijilMpspk' => 'nullable|required_if:daftarMpspk,on',
            'mpspkMula' => 'nullable|required_if:daftarMpspk,on|date',
            'mpspkTamat' => 'nullable|required_if:daftarMpspk,on|date|after:mpspkMula',
            'daftarSsm' => 'nullable',
            'sijilSsm' => 'nullable|required_if:daftarSsm,on',
            'ssmMula' => 'nullable|required_if:daftarSsm,on|date',
            'ssmTamat' => 'nullable|required_if:daftarSsm,on|date|after:ssmMula',
            'daftarMof' => 'nullable',
            'sijilMof' => 'nullable|required_if:daftarMof,on',
            'mofMula' => 'nullable|required_if:daftarMof,on|date',
            'mofTamat' => 'nullable|required_if:daftarMof,on|date|after:mofMula',
            'mofs' => 'nullable|required_if:daftarMof,on',
            'daftarCidb' => 'nullable',
            'sijilCidb' => 'nullable|required_if:daftarCidb,on',
            'cidbMula' => 'nullable|required_if:daftarCidb,on|date',
            'cidbTamat' => 'nullable|required_if:daftarCidb,on|date|after:cidbMula',
            'cidbBidangB' => 'nullable',
            'cidbBidangBgred' => 'nullable|required_with_all:cidbBidangB,daftarCidb',
            'cidbBidangBkod' => 'nullable|required_with_all:cidbBidangB,daftarCidb',
            'cidbBidangCe' => 'nullable',
            'cidbBidangCeGred' => 'nullable|required_with_all:cidbBidangCe,daftarCidb',
            'cidbBidangCeKod' => 'nullable|required_with_all:cidbBidangCe,daftarCidb',
            'cidbBidangE' => 'nullable',
            'cidbBidangEgred' => 'nullable|required_with_all:cidbBidangE,daftarCidb',
            'cidbBidangEkod' => 'nullable|required_with_all:cidbBidangE,daftarCidb',
            'cidbBidangMe' => 'nullable',
            'cidbBidangMeGred' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangMeKod' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangP' => 'nullable',
            'cidbBidangPgred' => 'nullable|required_with_all:cidbBidangP,daftarCidb',
            'cidbBidangPkod' => 'nullable|required_with_all:cidbBidangP,daftarCidb',
            'daftarPkk' => 'nullable',
            'sijilPkk' => 'nullable|required_if:daftarPkk,on',
            'pkkMula' => 'nullable|required_if:daftarPkk,on|date',
            'pkkTamat' => 'nullable|required_if:daftarPkk,on|date|after:pkkMula',
        ]);

        // Initialise table vendor_doc fields.

        $id = (string)Str::uuid();

        // Insert vendor_doc data.

        DB::table('vendor_doc')->insert([
            'id' => $id,
            'name' => strtoupper($request->input('syarikat')),
            'officer' => $request->input('pegawai'),
            'address' => $request->input('alamat'),
            'address1' => $request->input('alamat1'),
            'town' => $request->input('bandar'),
            'postcode' => $request->input('poskod'),
            'state' => $request->input('negeri'),
            'telephone' => $request->input('telefon'),
            'email' => $request->input('emel'),
            'ssm_id' => $request->input('sijilSsm'),
            'ssm_start' => $request->input('ssmMula'),
            'ssm_thru' => $request->input('ssmTamat'),
            'mpspk_id' => $request->input('sijilMpspk'),
            'mpspk_start' => $request->input('mpspkMula'),
            'mpspk_thru' => $request->input('mpspkTamat'),
            'cidb_id' => $request->input('sijilCidb'),
            'cidb_start' => $request->input('cidbMula'),
            'cidb_thru' => $request->input('cidbTamat'),
            'pkk_id' => $request->input('sijilPkk'),
            'pkk_start' => $request->input('pkkMula'),
            'pkk_thru' => $request->input('pkkTamat'),
            'mof_id' => $request->input('sijilMof'),
            'mof_start' => $request->input('mofMula'),
            'mof_thru' => $request->input('mofTamat')
        ]);

        // Insert mof_details data.

        if ($request->input('daftarMof') === 'on') {

            foreach ($request->input('mofs') as $mof) {

                $mof_id = (string)Str::uuid();

                DB::table('mof_details')->insert([
                    'id' => $mof_id,
                    'vd_id' => $id,
                    'mof_id' => $mof
                ]);

            }

        }

        // Insert cidb_details data.

        if ($request->input('daftarCidb') === 'on') {

            if ($request->input('cidbBidangB') === 'on') {

                foreach ($request->input('cidbBidangBkod') as $cidbBidangBkod) {

                    $cidbId = (string)Str::uuid();

                    DB::table('cidb_details')->insert([
                        'id' => $cidbId,
                        'vd_id' => $id,
                        'cidb_id' => $cidbBidangBkod,
                        'grade' => $request->input('cidbBidangBgred')
                    ]);

                }

            }

            if ($request->input('cidbBidangCe') === 'on') {

                foreach ($request->input('cidbBidangCeKod') as $cidbBidangCeKod) {

                    $cidbId = (string)Str::uuid();

                    DB::table('cidb_details')->insert([
                        'id' => $cidbId,
                        'vd_id' => $id,
                        'cidb_id' => $cidbBidangCeKod,
                        'grade' => $request->input('cidbBidangCeGred')
                    ]);

                }

            }

            if ($request->input('cidbBidangE') === 'on') {

                foreach ($request->input('cidbBidangEkod') as $cidbBidangEkod) {

                    $cidbId = (string)Str::uuid();

                    DB::table('cidb_details')->insert([
                        'id' => $cidbId,
                        'vd_id' => $id,
                        'cidb_id' => $cidbBidangEkod,
                        'grade' => $request->input('cidbBidangEgred')
                    ]);

                }

            }

            if ($request->input('cidbBidangMe') === 'on') {

                foreach ($request->input('cidbBidangMeKod') as $cidbBidangMeKod) {

                    $cidbId = (string)Str::uuid();

                    DB::table('cidb_details')->insert([
                        'id' => $cidbId,
                        'vd_id' => $id,
                        'cidb_id' => $cidbBidangMeKod,
                        'grade' => $request->input('cidbBidangMeGred')
                    ]);

                }

            }

            if ($request->input('cidbBidangP') === 'on') {

                foreach ($request->input('cidbBidangPkod') as $cidbBidangPkod) {

                    $cidbId = (string)Str::uuid();

                    DB::table('cidb_details')->insert([
                        'id' => $cidbId,
                        'vd_id' => $id,
                        'cidb_id' => $cidbBidangPkod,
                        'grade' => $request->input('cidbBidangPgred')
                    ]);

                }

            }

        }

        // Redirect to index.

        return redirect()->route('vendor-doc.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $vendor_tuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        $cidb_tuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->get();


        $cidb_details = [];

        foreach ($cidb_tuples as $cidb_tuple) {

            $cidb_details[$cidb_tuple->type]['grade'] = $cidb_tuple->grade;
            $cidb_details[$cidb_tuple->type]['subtype'][] = $cidb_tuple->subtype;

        }

        $mof_tuples = DB::table('mof_details')->where('vd_id', '=', $id)
            ->join('mof_ref', 'mof_details.mof_id', '=', 'mof_ref.id')
            ->pluck('code');


        return view('vendor_doc_show', [
            'vendor' => $vendor_tuple,
            'cidb_details' => $cidb_details,
            'mof_details' => $mof_tuples
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('cidb_details')->where('vd_id', '=', $id)->delete();
        DB::table('mof_details')->where('vd_id', '=', $id)->delete();
        DB::table('vendor_doc')->where('id', '=', $id)->delete();

        return redirect()->route('vendor-doc.index');
    }

}
