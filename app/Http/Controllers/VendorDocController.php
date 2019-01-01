<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        // Get tuple from table vendor_doc.

        $vendors = DB::table('vendor_doc')->get();

        // Return index page.

        return view('vendor_doc_index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get tuples from mof_ref table.

        $mofTuples = DB::table('mof_ref')->get();

        // Get tuples from cidb_ref table.

        $cidbTuples = DB::table('cidb_ref')
            ->orderBy('subtype')
            ->get();

        // Group cidb tuples by type.

        $cidbBtuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'B';

            });

        $cidbCeTuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'CE';

            });

        $cidbMeTuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'ME';

            });

        $cidbFtuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'F';

            });

        // Return create vendor page.

        return view('vendor_doc_create', [
            'mofs' => $mofTuples,
            'cidbBtuples' => $cidbBtuples,
            'cidbCeTuples' => $cidbCeTuples,
            'cidbMeTuples' => $cidbMeTuples,
            'cidbFtuples' => $cidbFtuples
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Declare validation rules.

        $rules = [
            'syarikat' => 'required|unique:vendor_doc,name|string',
            'pegawai' => 'required|string',
            'alamat' => 'required|string',
            'alamat1' => 'nullable|string',
            'poskod' => 'required|digits:5',
            'bandar' => 'required|string',
            'negeri' => 'required|string',
            'telefon' => 'nullable|digits_between:8,10',
            'emel' => 'nullable|email',
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
            'cidbBidangMe' => 'nullable',
            'cidbBidangMeGred' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangMeKod' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangF' => 'nullable',
            'cidbBidangFgred' => 'nullable|required_with_all:cidbBidangF,daftarCidb',
            'cidbBidangFkod' => 'nullable|required_with_all:cidbBidangF,daftarCidb',
            'daftarPkk' => 'nullable',
            'sijilPkk' => 'nullable|required_if:daftarPkk,on',
            'pkkMula' => 'nullable|required_if:daftarPkk,on|date',
            'pkkTamat' => 'nullable|required_if:daftarPkk,on|date|after:pkkMula',
        ];

        // Declare optional validation rules.

        $rulesCidbBidangB = 'required_without_all:cidbBidangCe,cidbBidangMe,cidbBidangF';
        $rulesCidbBidangCe = 'required_without_all:cidbBidangB,cidbBidangMe,cidbBidangF';
        $rulesCidbBidangMe = 'required_without_all:cidbBidangB,cidbBidangCe,cidbBidangF';
        $rulesCidbBidangF = 'required_without_all:cidbBidangB,cidbBidangCe,cidbBidangMe';

        // Setup optional validation.

        Validator::make($request->all(), $rules)
            ->sometimes('cidbBidangB', $rulesCidbBidangB, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbBidangCe', $rulesCidbBidangCe, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbBidangMe', $rulesCidbBidangMe, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbBidangF', $rulesCidbBidangF, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->validate();

        // Insert tuple into vendor_doc table.

        $id = DB::table('vendor_doc')
            ->insertGetId([
                'id' => (string)Str::uuid(),
                'name' => title_case($request->input('syarikat')),
                'officer' => title_case($request->input('pegawai')),
                'address' => title_case($request->input('alamat')),
                'address1' => $request->input('alamat1') !== null ? title_case($request->input('alamat1')) : null,
                'town' => title_case($request->input('bandar')),
                'postcode' => $request->input('poskod'),
                'state' => title_case($request->input('negeri')),
                'telephone' => $request->input('telefon'),
                'email' => $request->input('emel') !== null ? strtolower($request->input('emel')) : null,
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
            ], 'id');

        // Insert mof_details tuples.

        if ($request->input('daftarMof') === 'on') {

            foreach ($request->input('mofs') as $mof) {

                DB::table('mof_details')
                    ->insert([
                        'id' => (string)Str::uuid(),
                        'vd_id' => $id,
                        'mof_id' => $mof
                    ]);

            }

        }

        // Insert cidb_details tuples for B, CE, ME and F.

        if ($request->input('daftarCidb') === 'on') {

            // B.

            if ($request->input('cidbBidangB') === 'on') {

                foreach ($request->input('cidbBidangBkod') as $cidbBidangBkod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangBkod,
                            'grade' => $request->input('cidbBidangBgred')
                        ]);

                }

            }

            // CE.

            if ($request->input('cidbBidangCe') === 'on') {

                foreach ($request->input('cidbBidangCeKod') as $cidbBidangCeKod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangCeKod,
                            'grade' => $request->input('cidbBidangCeGred')
                        ]);

                }

            }

            // ME.

            if ($request->input('cidbBidangMe') === 'on') {

                foreach ($request->input('cidbBidangMeKod') as $cidbBidangMeKod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangMeKod,
                            'grade' => $request->input('cidbBidangMeGred')
                        ]);

                }

            }

            // F.

            if ($request->input('cidbBidangF') === 'on') {

                foreach ($request->input('cidbBidangFkod') as $cidbBidangFkod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangFkod,
                            'grade' => $request->input('cidbBidangFgred')
                        ]);

                }

            }

        }

        // Redirect to show page.

        return redirect()->route('vendor-doc.show', ['vendor-doc' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get vendor tuple from table vendor_doc.

        $vendorTuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        // Get CIDB tuples from table cidb_details.

        $cidbTuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->orderBy('subtype')
            ->get();

        // Get MOF tuples from table mof_details.

        $mofTuples = DB::table('mof_details')->where('vd_id', '=', $id)
            ->join('mof_ref', 'mof_details.mof_id', '=', 'mof_ref.id')
            ->orderBy('code')
            ->pluck('description', 'code');

        // Show page.

        return view('vendor_doc_show', [
            'vendor' => $vendorTuple,
            'cidbTuples' => $cidbTuples,
            'mofTuples' => $mofTuples
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get vendor tuple from table vendor_doc.

        $vendorTuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        // Get CIDB tuples from table cidb_details.

        $cidbTuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->get();

        // Group cidb tuples by type.

        $cidbBtuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'B';

            });

        $cidbCeTuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'CE';

            });

        $cidbMeTuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'ME';

            });

        $cidbFtuples = $cidbTuples
            ->filter(function ($value) {

                return $value->type === 'F';

            });

        // Get MOF tuples from table mof_details.

        $mofTuples = DB::table('mof_details')
            ->where('vd_id', '=', $id)
            ->pluck('mof_id');

        // Get all tuples from mof_ref table.

        $mofRefTuples = DB::table('mof_ref')
            ->get();

        // Get all tuples from cidb_ref table.

        $cidbRefTuples = DB::table('cidb_ref')
            ->orderBy('subtype')
            ->get();

        // Show page.

        return view('vendor_doc_edit', [
            'id' => optional($vendorTuple)->id,
            'syarikat' => optional($vendorTuple)->name,
            'pegawai' => optional($vendorTuple)->officer,
            'alamat' => optional($vendorTuple)->address,
            'alamat1' => optional($vendorTuple)->address1,
            'poskod' => optional($vendorTuple)->postcode,
            'bandar' => optional($vendorTuple)->town,
            'negeri' => optional($vendorTuple)->state,
            'telefon' => optional($vendorTuple)->telephone,
            'emel' => optional($vendorTuple)->email,
            'daftarMpspk' => optional($vendorTuple)->mpspk_id !== null ? 'on' : '',
            'sijilMpspk' => optional($vendorTuple)->mpspk_id,
            'mpspkMula' => optional($vendorTuple)->mpspk_start !== null ? date('Y-m-d', strtotime($vendorTuple->mpspk_start)) : null,
            'mpspkTamat' => optional($vendorTuple)->mpspk_thru !== null ? date('Y-m-d', strtotime($vendorTuple->mpspk_thru)) : null,
            'daftarSsm' => optional($vendorTuple)->ssm_id !== null ? 'on' : '',
            'sijilSsm' => optional($vendorTuple)->ssm_id,
            'ssmMula' => optional($vendorTuple)->ssm_start !== null ? date('Y-m-d', strtotime($vendorTuple->ssm_start)) : null,
            'ssmTamat' => optional($vendorTuple)->ssm_thru !== null ? date('Y-m-d', strtotime($vendorTuple->ssm_thru)) : null,
            'daftarMof' => optional($vendorTuple)->mof_id !== null ? 'on' : '',
            'sijilMof' => optional($vendorTuple)->mof_id,
            'mofMula' => optional($vendorTuple)->mof_start !== null ? date('Y-m-d', strtotime($vendorTuple->mof_start)) : null,
            'mofTamat' => optional($vendorTuple)->mof_thru !== null ? date('Y-m-d', strtotime($vendorTuple->mof_thru)) : null,
            'mofs' => $mofRefTuples->toArray(),
            'mofTuples' => optional($mofTuples)->toArray(),
            'cidbs' => $cidbRefTuples,
            'daftarCidb' => optional($vendorTuple)->cidb_id !== null ? 'on' : '',
            'sijilCidb' => optional($vendorTuple)->cidb_id,
            'cidbMula' => optional($vendorTuple)->cidb_start !== null ? date('Y-m-d', strtotime($vendorTuple->cidb_start)) : null,
            'cidbTamat' => optional($vendorTuple)->cidb_thru !== null ? date('Y-m-d', strtotime($vendorTuple->cidb_thru)) : null,
            'cidbBidangB' => $cidbBtuples->isNotEmpty() ? 'on' : '',
            'cidbBidangBgred' => optional($cidbBtuples->first())->grade,
            'cidbBidangBkod' => optional($cidbBtuples)->map(function ($value) {
                return $value->cidb_id;
            })->toArray(),
            'cidbBidangCe' => $cidbCeTuples->isNotEmpty() ? 'on' : '',
            'cidbBidangCeGred' => optional($cidbCeTuples->first())->grade,
            'cidbBidangCeKod' => optional($cidbCeTuples)->map(function ($value) {
                return $value->cidb_id;
            })->toArray(),
            'cidbBidangMe' => $cidbMeTuples->isNotEmpty() ? 'on' : '',
            'cidbBidangMeGred' => optional($cidbMeTuples->first())->grade,
            'cidbBidangMeKod' => optional($cidbMeTuples)->map(function ($value) {
                return $value->cidb_id;
            })->toArray(),
            'cidbBidangF' => $cidbFtuples->isNotEmpty() ? 'on' : '',
            'cidbBidangFgred' => optional($cidbFtuples->first())->grade,
            'cidbBidangFkod' => optional($cidbFtuples)->map(function ($value) {
                return $value->cidb_id;
            })->toArray(),
            'daftarPkk' => optional($vendorTuple)->pkk_id !== null ? 'on' : '',
            'sijilPkk' => optional($vendorTuple)->pkk_id,
            'pkkMula' => optional($vendorTuple)->pkk_start !== null ? date('Y-m-d', strtotime($vendorTuple->pkk_start)) : null,
            'pkkTamat' => optional($vendorTuple)->pkk_thru !== null ? date('Y-m-d', strtotime($vendorTuple->pkk_thru)) : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Declare validation rules.

        $rules = [
            'syarikat' => 'required|string',
            'pegawai' => 'required|string',
            'alamat' => 'required|string',
            'alamat1' => 'nullable|string',
            'poskod' => 'required|digits:5',
            'bandar' => 'required|string',
            'negeri' => 'required|string',
            'telefon' => 'nullable|digits_between:8,10',
            'emel' => 'nullable|email',
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
            'cidbBidangMe' => 'nullable',
            'cidbBidangMeGred' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangMeKod' => 'nullable|required_with_all:cidbBidangMe,daftarCidb',
            'cidbBidangF' => 'nullable',
            'cidbBidangFgred' => 'nullable|required_with_all:cidbBidangF,daftarCidb',
            'cidbBidangFkod' => 'nullable|required_with_all:cidbBidangF,daftarCidb',
            'daftarPkk' => 'nullable',
            'sijilPkk' => 'nullable|required_if:daftarPkk,on',
            'pkkMula' => 'nullable|required_if:daftarPkk,on|date',
            'pkkTamat' => 'nullable|required_if:daftarPkk,on|date|after:pkkMula',
        ];

        // Declare optional validation rules.

        $rulesCidbBidangB = 'required_without_all:cidbBidangCe,cidbBidangMe,cidbBidangF';
        $rulesCidbBidangCe = 'required_without_all:cidbBidangB,cidbBidangMe,cidbBidangF';
        $rulesCidbBidangMe = 'required_without_all:cidbBidangB,cidbBidangCe,cidbBidangF';
        $rulesCidbBidangF = 'required_without_all:cidbBidangB,cidbBidangCe,cidbBidangMe';

        // Setup validation.

        Validator::make($request->all(), $rules)
            ->sometimes('cidbBidangB', $rulesCidbBidangB, function ($input) {
                return $input->daftarCidb === 'on';
            })
            ->sometimes('cidbBidangCe', $rulesCidbBidangCe, function ($input) {
                return $input->daftarCidb === 'on';
            })
            ->sometimes('cidbBidangMe', $rulesCidbBidangMe, function ($input) {
                return $input->daftarCidb === 'on';
            })
            ->sometimes('cidbBidangF', $rulesCidbBidangF, function ($input) {
                return $input->daftarCidb === 'on';
            })
            ->validate();

        // Perform update on table vendor_doc.

        DB::table('vendor_doc')
            ->where('id', $id)
            ->update([
                'officer' => title_case($request->input('pegawai')),
                'address' => title_case($request->input('alamat')),
                'address1' => $request->input('alamat1') !== null ? title_case($request->input('alamat1')) : null,
                'town' => title_case($request->input('bandar')),
                'postcode' => $request->input('poskod'),
                'state' => title_case($request->input('negeri')),
                'telephone' => $request->input('telefon'),
                'email' => $request->input('emel') !== null ? strtolower($request->input('emel')) : null,
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

        // Delete tuples on cidb_details.

        DB::table('cidb_details')->where('vd_id', '=', $id)->delete();

        // Insert new cidb_details tuples for B, CE, ME and F.

        if ($request->input('daftarCidb') === 'on') {

            // B.

            if ($request->input('cidbBidangB') === 'on') {

                foreach ($request->input('cidbBidangBkod') as $cidbBidangBkod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangBkod,
                            'grade' => $request->input('cidbBidangBgred')
                        ]);

                }

            }

            // CE.

            if ($request->input('cidbBidangCe') === 'on') {

                foreach ($request->input('cidbBidangCeKod') as $cidbBidangCeKod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangCeKod,
                            'grade' => $request->input('cidbBidangCeGred')
                        ]);

                }

            }

            // ME.

            if ($request->input('cidbBidangMe') === 'on') {

                foreach ($request->input('cidbBidangMeKod') as $cidbBidangMeKod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangMeKod,
                            'grade' => $request->input('cidbBidangMeGred')
                        ]);

                }

            }

            // F.

            if ($request->input('cidbBidangF') === 'on') {

                foreach ($request->input('cidbBidangFkod') as $cidbBidangFkod) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $cidbBidangFkod,
                            'grade' => $request->input('cidbBidangFgred')
                        ]);

                }

            }

        }

        // Delete tuples on mof_details.

        DB::table('mof_details')->where('vd_id', '=', $id)->delete();

        // Insert new mof_details tuple.

        if ($request->input('daftarMof') === 'on') {

            foreach ($request->input('mofs') as $mof) {

                DB::table('mof_details')->insert([
                    'id' => (string)Str::uuid(),
                    'vd_id' => $id,
                    'mof_id' => $mof
                ]);

            }

        }

        // Redirect to vendor detail page.

        return redirect()->route('vendor-doc.show', ['vendor-doc' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete tuples in table cidb_details, mof_details and vendor_doc.

        DB::table('cidb_details')->where('vd_id', '=', $id)->delete();
        DB::table('mof_details')->where('vd_id', '=', $id)->delete();
        DB::table('vendor_doc')->where('id', '=', $id)->delete();

        // Return to index page.

        return redirect()->route('vendor-doc.index');
    }

}
