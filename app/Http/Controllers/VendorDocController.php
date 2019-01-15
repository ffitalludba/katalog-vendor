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

        $mofTuples = DB::table('mof_ref')
            ->orderBy('code')
            ->get();

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
            'syarikat' => ['required', 'regex:/^[A-Z0-9&@!?$.,:;"(){}<>\-\[\]\'\s\\\\\/]+$/', 'not_regex:/\s{2,}/', 'unique:vendor_doc,name'],
            'alamat' => 'required|string',
            'alamat1' => 'nullable|string',

            'poskod' => 'required|digits:5',
            'bandar' => 'required|string',
            'negeri' => 'required|string',

            'telefon' => 'nullable|digits_between:8,11',
            'telefon1' => 'nullable|digits_between:8,11',
            'emel' => 'nullable|email',

            'pengurus' => 'required|string',
            'mykad' => 'required|regex:/^\d{6}-\d{2}-\d{4}$/',

            'bank' => 'required|string',
            'bankAkaun' => 'required|string',

            'daftarMpspk' => 'nullable',
            'sijilMpspk' => 'nullable|required_if:daftarMpspk,on',
            'mpspkMula' => 'nullable|required_if:daftarMpspk,on|date',
            'mpspkTamat' => 'nullable|required_if:daftarMpspk,on|date|after:mpspkMula',

            'daftarSsm' => 'nullable',
            'sijilSsm' => 'nullable|required_if:daftarSsm,on',
            'ssmMula' => 'nullable|required_if:daftarSsm,on|date',
            'ssmTamat' => 'nullable|date|after:ssmMula',

            'daftarMof' => 'nullable',
            'sijilMof' => 'nullable|required_if:daftarMof,on',
            'mofMula' => 'nullable|required_if:daftarMof,on|date',
            'mofTamat' => 'nullable|required_if:daftarMof,on|date|after:mofMula',
            'mofs' => 'nullable|required_if:daftarMof,on',

            'daftarCidb' => 'nullable',
            'sijilCidb' => 'nullable|required_if:daftarCidb,on',
            'cidbMula' => 'nullable|required_if:daftarCidb,on|date',
            'cidbTamat' => 'nullable|required_if:daftarCidb,on|date|after:cidbMula',
            'bumiputra' => 'nullable',

            'daftarKoperasi' => 'nullable',
            'sijilKoperasi' => 'nullable|required_if:daftarKoperasi,on',
            'koperasiMula' => 'nullable|required_if:daftarKoperasi,on|date',

            'daftarPeladang' => 'nullable',
            'sijilPeladang' => 'nullable|required_if:daftarPeladang,on',
            'peladangMula' => 'nullable|required_if:daftarPeladang,on|date'
        ];

        // Declare optional validation rules.

        $rulesCidbGredG1 = 'required_without_all:cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG2 = 'required_without_all:cidbGredG1,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG3 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG4 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG5 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG6,cidbGredG7';
        $rulesCidbGredG6 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG7';
        $rulesCidbGredG7 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6';

        // Setup optional validation.

        Validator::make($request->all(), $rules)
            ->sometimes('cidbGredG1', $rulesCidbGredG1, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG2', $rulesCidbGredG2, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG3', $rulesCidbGredG3, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG4', $rulesCidbGredG4, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG5', $rulesCidbGredG5, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG6', $rulesCidbGredG6, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG7', $rulesCidbGredG7, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->validate();

        // Insert tuple into vendor_doc table.

        $id = DB::table('vendor_doc')
            ->insertGetId([
                'id' => (string)Str::uuid(),
                'name' => strtoupper($request->input('syarikat')),

                'address' => strtoupper($request->input('alamat')),
                'address1' => $request->input('alamat1') !== null ? strtoupper($request->input('alamat1')) : null,

                'town' => strtoupper($request->input('bandar')),
                'postcode' => $request->input('poskod'),
                'state' => strtoupper($request->input('negeri')),

                'telephone' => $request->input('telefon'),
                'telephone1' => $request->input('telefon1'),
                'email' => $request->input('emel') !== null ? strtolower($request->input('emel')) : null,

                'officer' => title_case($request->input('pengurus')),
                'mykad' => $request->input('mykad'),

                'bank' => title_case($request->input('bank')),
                'bank_account' => $request->input('bankAkaun'),

                'mpspk_id' => $request->input('sijilMpspk'),
                'mpspk_start' => $request->input('mpspkMula'),
                'mpspk_thru' => $request->input('mpspkTamat'),

                'ssm_id' => $request->input('daftarSsm') === 'on' ? $request->input('sijilSsm') : null,
                'ssm_start' => $request->input('daftarSsm') === 'on' ? $request->input('ssmMula') : null,
                'ssm_thru' => $request->input('daftarSsm') === 'on' ? $request->input('ssmTamat') : null,

                'mof_id' => $request->input('daftarMof') === 'on' ? $request->input('sijilMof') : null,
                'mof_start' => $request->input('daftarMof') === 'on' ? $request->input('mofMula') : null,
                'mof_thru' => $request->input('daftarMof') === 'on' ? $request->input('mofTamat') : null,

                'cidb_id' => $request->input('daftarCidb') === 'on' ? $request->input('sijilCidb') : null,
                'cidb_start' => $request->input('daftarCidb') === 'on' ? $request->input('cidbMula') : null,
                'cidb_thru' => $request->input('daftarCidb') === 'on' ? $request->input('cidbTamat') : null,
                'bumiputra' => $request->input('daftarCidb') === 'on' ? $request->input('bumiputra') : null,

                'koperasi_id' => $request->input('daftarKoperasi') === 'on' ? $request->input('sijilKoperasi') : null,
                'koperasi_start' => $request->input('daftarKoperasi') === 'on' ? $request->input('koperasiMula') : null,

                'peladang_id' => $request->input('daftarPeladang') === 'on' ? $request->input('sijilPeladang') : null,
                'peladang_start' => $request->input('daftarPeladang') === 'on' ? $request->input('peladangMula') : null
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

        // Insert cidb_details tuples for G1 to G7.

        if ($request->input('daftarCidb') === 'on') {

            // G1

            if ($request->input('cidbGredG1')) {

                foreach ($request->input('cidbGredG1') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G1'
                        ]);

                }

            }

            // G2

            if ($request->input('cidbGredG2')) {

                foreach ($request->input('cidbGredG2') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G2'
                        ]);

                }

            }

            // G3

            if ($request->input('cidbGredG3')) {

                foreach ($request->input('cidbGredG3') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G3'
                        ]);

                }

            }

            // G4

            if ($request->input('cidbGredG4')) {

                foreach ($request->input('cidbGredG4') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G4'
                        ]);

                }

            }

            // G5

            if ($request->input('cidbGredG5')) {

                foreach ($request->input('cidbGredG5') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G5'
                        ]);

                }

            }

            // G6

            if ($request->input('cidbGredG6')) {

                foreach ($request->input('cidbGredG6') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G6'
                        ]);

                }

            }

            // G7

            if ($request->input('cidbGredG7')) {

                foreach ($request->input('cidbGredG7') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G7'
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

        // Construct full address.

        $addressTmp = $vendorTuple->address1 !== null ? $vendorTuple->address1 . ', ' : '';
        $address = $vendorTuple->address . ', ' .
            $addressTmp . $vendorTuple->town . ' ' . $vendorTuple->postcode . ' ' . $vendorTuple->state . '.';

        // Get CIDB tuples from table cidb_details.

        $cidbTuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->get();

        // Get MOF tuples from table mof_details.

        $mofTuples = DB::table('mof_details')->where('vd_id', '=', $id)
            ->join('mof_ref', 'mof_details.mof_id', '=', 'mof_ref.id')
            ->orderBy('code')
            ->pluck('description', 'code');

        // Show page.

        return view('vendor_doc_show', [
            'vendor' => $vendorTuple,
            'address' => $address,
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
        // Get tuples from mof_ref table.

        $mofRefTuples = DB::table('mof_ref')
            ->orderBy('code')
            ->get();

        // Get tuples from cidb_ref table.

        $cidbRefTuples = DB::table('cidb_ref')
            ->orderBy('subtype')
            ->get();

        // Group cidb tuples by type.

        $cidbBtuples = $cidbRefTuples
            ->filter(function ($value) {

                return $value->type === 'B';

            });

        $cidbCeTuples = $cidbRefTuples
            ->filter(function ($value) {

                return $value->type === 'CE';

            });

        $cidbMeTuples = $cidbRefTuples
            ->filter(function ($value) {

                return $value->type === 'ME';

            });

        $cidbFtuples = $cidbRefTuples
            ->filter(function ($value) {

                return $value->type === 'F';

            });

        // Get vendor tuple from table vendor_doc.

        $vendorTuple = DB::table('vendor_doc')->where('id', $id)
            ->first();

        // Get CIDB tuples from table cidb_details.

        $cidbDetailsTuples = DB::table('cidb_details')
            ->where('vd_id', '=', $id)
            ->join('cidb_ref', 'cidb_details.cidb_id', '=', 'cidb_ref.id')
            ->get();

        // Group cidb tuples by grade.

        $cidbG1tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G1';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG2tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G2';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG3tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G3';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG4tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G4';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG5tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G5';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG6tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G6';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        $cidbG7tuples = $cidbDetailsTuples
            ->filter(function ($value) {

                return $value->grade === 'G7';

            })
            ->map(function ($value) {

                return $value->cidb_id;

            })
            ->toArray();

        // Get MOF tuples from table mof_details.

        $mofDetailsTuples = DB::table('mof_details')
            ->where('vd_id', '=', $id)
            ->pluck('mof_id');

        // Show page.

        return view('vendor_doc_edit', [

            'id' => optional($vendorTuple)->id,
            'syarikat' => optional($vendorTuple)->name,

            'alamat' => optional($vendorTuple)->address,
            'alamat1' => optional($vendorTuple)->address1,

            'poskod' => optional($vendorTuple)->postcode,
            'bandar' => optional($vendorTuple)->town,
            'negeri' => optional($vendorTuple)->state,

            'telefon' => optional($vendorTuple)->telephone,
            'telefon1' => optional($vendorTuple)->telephone1,
            'emel' => optional($vendorTuple)->email,

            'pengurus' => optional($vendorTuple)->officer,
            'mykad' => optional($vendorTuple)->mykad,

            'bank' => optional($vendorTuple)->bank,
            'bankAkaun' => optional($vendorTuple)->bank_account,

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
            'mofs' => optional($mofDetailsTuples)->toArray(),
            'mofRefTuples' => optional($mofRefTuples)->toArray(),

            'daftarCidb' => optional($vendorTuple)->cidb_id !== null ? 'on' : '',
            'sijilCidb' => optional($vendorTuple)->cidb_id,
            'cidbMula' => optional($vendorTuple)->cidb_start !== null ? date('Y-m-d', strtotime($vendorTuple->cidb_start)) : null,
            'cidbTamat' => optional($vendorTuple)->cidb_thru !== null ? date('Y-m-d', strtotime($vendorTuple->cidb_thru)) : null,

            'cidbBtuples' => $cidbBtuples,
            'cidbCeTuples' => $cidbCeTuples,
            'cidbMeTuples' => $cidbMeTuples,
            'cidbFtuples' => $cidbFtuples,

            'cidbGredG1' => $cidbG1tuples,
            'cidbGredG2' => $cidbG2tuples,
            'cidbGredG3' => $cidbG3tuples,
            'cidbGredG4' => $cidbG4tuples,
            'cidbGredG5' => $cidbG5tuples,
            'cidbGredG6' => $cidbG6tuples,
            'cidbGredG7' => $cidbG7tuples,

            'bumiputra' => optional($vendorTuple)->bumiputra !== null ? 'on' : '',

            'daftarKoperasi' => optional($vendorTuple)->koperasi_id !== null ? 'on' : '',
            'sijilKoperasi' => optional($vendorTuple)->koperasi_id,
            'koperasiMula' => optional($vendorTuple)->koperasi_start !== null ? date('Y-m-d', strtotime($vendorTuple->koperasi_start)) : null,

            'daftarPeladang' => optional($vendorTuple)->peladang_id !== null ? 'on' : '',
            'sijilPeladang' => optional($vendorTuple)->peladang_id,
            'peladangMula' => optional($vendorTuple)->peladang_start !== null ? date('Y-m-d', strtotime($vendorTuple->peladang_start)) : null
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
            'syarikat' => ['required', 'regex:/^[A-Z0-9&@!?$.,:;"(){}<>\-\[\]\'\s\\\\\/]+$/', 'not_regex:/\s{2,}/'],
            'alamat' => 'required|string',
            'alamat1' => 'nullable|string',

            'poskod' => 'required|digits:5',
            'bandar' => 'required|string',
            'negeri' => 'required|string',

            'telefon' => 'nullable|digits_between:8,11',
            'telefon1' => 'nullable|digits_between:8,11',
            'emel' => 'nullable|email',

            'pengurus' => 'required|string',
            'mykad' => 'required|regex:/^\d{6}-\d{2}-\d{4}$/',

            'bank' => 'required|string',
            'bankAkaun' => 'required|string',

            'daftarMpspk' => 'nullable',
            'sijilMpspk' => 'nullable|required_if:daftarMpspk,on',
            'mpspkMula' => 'nullable|required_if:daftarMpspk,on|date',
            'mpspkTamat' => 'nullable|required_if:daftarMpspk,on|date|after:mpspkMula',

            'daftarSsm' => 'nullable',
            'sijilSsm' => 'nullable|required_if:daftarSsm,on',
            'ssmMula' => 'nullable|required_if:daftarSsm,on|date',
            'ssmTamat' => 'nullable|date|after:ssmMula',

            'daftarMof' => 'nullable',
            'sijilMof' => 'nullable|required_if:daftarMof,on',
            'mofMula' => 'nullable|required_if:daftarMof,on|date',
            'mofTamat' => 'nullable|required_if:daftarMof,on|date|after:mofMula',
            'mofs' => 'nullable|required_if:daftarMof,on',

            'daftarCidb' => 'nullable',
            'sijilCidb' => 'nullable|required_if:daftarCidb,on',
            'cidbMula' => 'nullable|required_if:daftarCidb,on|date',
            'cidbTamat' => 'nullable|required_if:daftarCidb,on|date|after:cidbMula',
            'bumiputra' => 'nullable',

            'daftarKoperasi' => 'nullable',
            'sijilKoperasi' => 'nullable|required_if:daftarKoperasi,on',
            'koperasiMula' => 'nullable|required_if:daftarKoperasi,on|date',

            'daftarPeladang' => 'nullable',
            'sijilPeladang' => 'nullable|required_if:daftarPeladang,on',
            'peladangMula' => 'nullable|required_if:daftarPeladang,on|date'
        ];

        // Declare optional validation rules.

        $rulesCidbGredG1 = 'required_without_all:cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG2 = 'required_without_all:cidbGredG1,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG3 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG4,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG4 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG5,cidbGredG6,cidbGredG7';
        $rulesCidbGredG5 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG6,cidbGredG7';
        $rulesCidbGredG6 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG7';
        $rulesCidbGredG7 = 'required_without_all:cidbGredG1,cidbGredG2,cidbGredG3,cidbGredG4,cidbGredG5,cidbGredG6';

        // Setup optional validation.

        Validator::make($request->all(), $rules)
            ->sometimes('cidbGredG1', $rulesCidbGredG1, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG2', $rulesCidbGredG2, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG3', $rulesCidbGredG3, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG4', $rulesCidbGredG4, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG5', $rulesCidbGredG5, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG6', $rulesCidbGredG6, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->sometimes('cidbGredG7', $rulesCidbGredG7, function ($input) {

                return $input->daftarCidb === 'on';

            })
            ->validate();

        // Perform update on table vendor_doc.

        DB::table('vendor_doc')
            ->where('id', $id)
            ->update([
                'address' => strtoupper($request->input('alamat')),
                'address1' => $request->input('alamat1') !== null ? strtoupper($request->input('alamat1')) : null,

                'town' => strtoupper($request->input('bandar')),
                'postcode' => $request->input('poskod'),
                'state' => strtoupper($request->input('negeri')),

                'telephone' => $request->input('telefon'),
                'telephone1' => $request->input('telefon1'),
                'email' => $request->input('emel') !== null ? strtolower($request->input('emel')) : null,

                'officer' => title_case($request->input('pengurus')),
                'mykad' => $request->input('mykad'),

                'bank' => title_case($request->input('bank')),
                'bank_account' => $request->input('bankAkaun'),

                'mpspk_id' => $request->input('sijilMpspk'),
                'mpspk_start' => $request->input('mpspkMula'),
                'mpspk_thru' => $request->input('mpspkTamat'),

                'ssm_id' => $request->input('daftarSsm') === 'on' ? $request->input('sijilSsm') : null,
                'ssm_start' => $request->input('daftarSsm') === 'on' ? $request->input('ssmMula') : null,
                'ssm_thru' => $request->input('daftarSsm') === 'on' ? $request->input('ssmTamat') : null,

                'mof_id' => $request->input('daftarMof') === 'on' ? $request->input('sijilMof') : null,
                'mof_start' => $request->input('daftarMof') === 'on' ? $request->input('mofMula') : null,
                'mof_thru' => $request->input('daftarMof') === 'on' ? $request->input('mofTamat') : null,

                'cidb_id' => $request->input('daftarCidb') === 'on' ? $request->input('sijilCidb') : null,
                'cidb_start' => $request->input('daftarCidb') === 'on' ? $request->input('cidbMula') : null,
                'cidb_thru' => $request->input('daftarCidb') === 'on' ? $request->input('cidbTamat') : null,
                'bumiputra' => $request->input('daftarCidb') === 'on' ? $request->input('bumiputra') : null,

                'koperasi_id' => $request->input('daftarKoperasi') === 'on' ? $request->input('sijilKoperasi') : null,
                'koperasi_start' => $request->input('daftarKoperasi') === 'on' ? $request->input('koperasiMula') : null,

                'peladang_id' => $request->input('daftarPeladang') === 'on' ? $request->input('sijilPeladang') : null,
                'peladang_start' => $request->input('daftarPeladang') === 'on' ? $request->input('peladangMula') : null
            ]);

        // Delete tuples on cidb_details.

        DB::table('cidb_details')->where('vd_id', '=', $id)->delete();

        // Insert cidb_details tuples for G1 to G7.

        if ($request->input('daftarCidb') === 'on') {

            // G1

            if ($request->input('cidbGredG1')) {

                foreach ($request->input('cidbGredG1') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G1'
                        ]);

                }

            }

            // G2

            if ($request->input('cidbGredG2')) {

                foreach ($request->input('cidbGredG2') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G2'
                        ]);

                }

            }

            // G3

            if ($request->input('cidbGredG3')) {

                foreach ($request->input('cidbGredG3') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G3'
                        ]);

                }

            }

            // G4

            if ($request->input('cidbGredG4')) {

                foreach ($request->input('cidbGredG4') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G4'
                        ]);

                }

            }

            // G5

            if ($request->input('cidbGredG5')) {

                foreach ($request->input('cidbGredG5') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G5'
                        ]);

                }

            }

            // G6

            if ($request->input('cidbGredG6')) {

                foreach ($request->input('cidbGredG6') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G6'
                        ]);

                }

            }

            // G7

            if ($request->input('cidbGredG7')) {

                foreach ($request->input('cidbGredG7') as $value) {

                    DB::table('cidb_details')
                        ->insert([
                            'id' => (string)Str::uuid(),
                            'vd_id' => $id,
                            'cidb_id' => $value,
                            'grade' => 'G7'
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
