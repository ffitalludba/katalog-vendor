@extends('v2_vendor_doc_layout')

@section('style')

    @parent

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">


@endsection

@section('title','Ubah Kontraktor & Pembekal')

@section('description','Borang ubah maklumat kontraktor dan pembekal.')

@section('content')

    @if ($errors->any())

        <div id="errorPanel" class="collapse show">

            <div class="alert alert-danger">

                Sila betulkan kesilapan di bawah.

                <button type="button" class="close" data-toggle="collapse" data-target="#errorPanel"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        </div>

    @endif

    <div class="card">

        <div class="card-body">

            <form class="needs-validation" novalidate method="post"
                  action="{{route('vendor-doc.update',['id'=>$id])}}">

                @method('PUT')
                @csrf

                <fieldset>

                    <legend>Butiran Pendaftaran</legend>

                    {{--Input syarikat & pegawai--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputSyarikat">Syarikat</label>

                            <input id="inputSyarikat" name="syarikat" type="text"
                                   class="form-control form-control-sm"
                                   value="{{old('syarikat',$syarikat)}}" readonly>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputPegawai">Pegawai</label>

                            <input id="inputPegawai" name="pegawai" type="text"
                                   class="form-control form-control-sm {{$errors->has('pegawai') ? 'is-invalid' : ''}}"
                                   placeholder="Nama penuh pegawai"
                                   value="{{old('pegawai',$pegawai)}}">

                            @if($errors->has('pegawai'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('pegawai') }}

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--Input alamat & alamat1--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputAlamat">Alamat</label>

                            <input id="inputAlamat" name="alamat" type="text"
                                   class="form-control form-control-sm {{$errors->has('alamat') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor pejabat, nama jalan & nama kawasan"
                                   value="{{old('alamat',$alamat)}}">

                            @if($errors->has('alamat'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('alamat') }}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputAlamat1">Alamat 1</label>

                            <input id="inputAlamat1" name="alamat1" type="text"
                                   class="form-control form-control-sm"
                                   placeholder="Nombor petisurat, tingkat bangunan & nama bangunan"
                                   value="{{old('alamat1',$alamat1)}}">

                        </div>

                    </div>

                    {{--Input poskod, bandar & negeri--}}

                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label for="inputPoskod">Poskod</label>

                            <input id="inputPoskod" name="poskod" type="text"
                                   class="form-control form-control-sm {{$errors->has('poskod') ? 'is-invalid' : ''}}"
                                   placeholder="Poskod 5 digit" value="{{old('poskod',$poskod)}}">

                            @if($errors->has('poskod'))

                                <div class="invalid-feedback">

                                    {{$errors->first('poskod')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputBandar">Bandar</label>

                            <input id="inputBandar" name="bandar" type="text"
                                   class="form-control form-control-sm {{$errors->has('bandar') ? 'is-invalid' : ''}}"
                                   placeholder="Nama bandar" value="{{old('bandar',$bandar)}}">

                            @if($errors->has('bandar'))

                                <div class="invalid-feedback">

                                    {{$errors->first('bandar')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputNegeri">Negeri</label>

                            <input id="inputNegeri" name="negeri" type="text"
                                   class="form-control form-control-sm {{$errors->has('negeri') ? 'is-invalid' : ''}}"
                                   placeholder="Nama negeri" value="{{old('negeri',$negeri)}}">

                            @if($errors->has('negeri'))

                                <div class="invalid-feedback">

                                    {{$errors->first('negeri')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--Input telefon & emel--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputTelefon">Telefon</label>

                            <input id="inputTelefon" name="telefon" type="text"
                                   class="form-control form-control-sm {{$errors->has('telefon') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor telefon bimbit atau talian tetap"
                                   value="{{old('telefon',$telefon)}}">

                            @if($errors->has('telefon'))

                                <div class="invalid-feedback">

                                    {{$errors->first('telefon')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputEmel">Emel</label>

                            <input id="inputEmel" name="emel" type="email"
                                   class="form-control form-control-sm {{$errors->has('emel') ? 'is-invalid' : ''}}"
                                   placeholder="Emel rasmi syarikat" value="{{old('emel',$emel)}}">

                            @if($errors->has('emel'))

                                <div class="invalid-feedback">

                                    {{$errors->first('emel')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--MPSPK card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel MPSPK--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarMpspk"
                                               name="daftarMpspk"
                                               data-toggle="collapse"
                                               data-target="#panelMpspk" {{(old('daftarMpspk',$daftarMpspk) === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarMpspk">Sijil
                                            MPSPK</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel MPSPK--}}

                            <div
                                class="collapse {{(old('daftarMpspk',$daftarMpspk) === 'on') ? 'show' : ''}}"
                                id="panelMpspk">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputMpspk"># Pendaftaran</label>

                                        <input id="inputMpspk" name="sijilMpspk" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilMpspk') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran MPSPK"
                                               value="{{old('sijilMpspk',$sijilMpspk)}}">

                                        @if($errors->has('sijilMpspk'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilMpspk')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label
                                            for="inputMpspkMula">Mula</label>

                                        <input id="inputMpspkMula" name="mpspkMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('mpspkMula') ? 'is-invalid' : ''}}"
                                               value="{{old('mpspkMula',$mpspkMula)}}">

                                        @if($errors->has('mpspkMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mpspkMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMpspkTamat">Tamat</label>

                                        <input id="inputMpspkTamat" name="mpspkTamat" type="date"
                                               class="form-control form-control-sm {{$errors->has('mpspkTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('mpspkTamat',$mpspkTamat)}}">

                                        @if($errors->has('mpspkTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mpspkTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--SSM Card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel SSM--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarSsm"
                                               name="daftarSsm"
                                               data-toggle="collapse"
                                               data-target="#panelSsm" {{(old('daftarSsm',$daftarSsm) === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarSsm">Sijil
                                            SSM</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel SSM--}}

                            <div
                                class="collapse {{(old('daftarSsm',$daftarSsm) === 'on') ? 'show' : ''}}"
                                id="panelSsm">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputSSM"># Pendaftaran</label>

                                        <input id="inputSSM" name="sijilSsm" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilSsm') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran SSM"
                                               value="{{old('sijilSsm',$sijilSsm)}}">

                                        @if($errors->has('sijilSsm'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilSsm')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputSSMMula">Mula</label>

                                        <input id="inputSSMMula" name="ssmMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('ssmMula') ? 'is-invalid' : ''}}"
                                               value="{{old('ssmMula',$ssmMula)}}">

                                        @if($errors->has('ssmMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('ssmMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputSSMTamat">Tamat</label>

                                        <input id="inputSSMTamat" name="ssmTamat" type="date"
                                               class="form-control form-control-sm {{$errors->has('ssmTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('ssmTamat',$ssmTamat)}}">

                                        @if($errors->has('ssmTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('ssmTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--MOF Card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel MOF--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarMof"
                                               name="daftarMof"
                                               data-toggle="collapse"
                                               data-target="#panelMof" {{(old('daftarMof',$daftarMof) === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarMof">Sijil
                                            MOF</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel MOF--}}

                            <div
                                class="collapse {{(old('daftarMof',$daftarMof) === 'on') ? 'show' : ''}}"
                                id="panelMof">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputMOF"># Pendaftaran</label>

                                        <input id="inputMOF" name="sijilMof" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilMof') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran MOF"
                                               value="{{old('sijilMof',$sijilMof)}}">

                                        @if($errors->has('sijilMof'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilMof')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMOFMula">Mula</label>

                                        <input id="inputMOFMula" name="mofMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('mofMula') ? 'is-invalid' : ''}}"
                                               value="{{old('mofMula',$mofMula)}}">

                                        @if($errors->has('mofMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mofMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMOFTamat">Tamat</label>

                                        <input id="inputMOFTamat" name="mofTamat" type="date"
                                               class="form-control form-control-sm {{$errors->has('mofTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('mofTamat',$mofTamat)}}">

                                        @if($errors->has('mofTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mofTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="mofLOV">Kod Bidang</label>

                                        <select id="mofLOV"
                                                class="form-control form-control-sm selectpicker {{$errors->has('mofs') ? 'is-invalid' : ''}}"
                                                name="mofs[]"
                                                multiple data-live-search="true" data-size="7" data-actions-box="true"
                                                data-style="btn">

                                            @if(old('mofs',$mofTuples) === null)

                                                @foreach ($mofs as $mof)

                                                    <option value="{{$mof->id}}"
                                                            data-subtext="{{$mof->description}}">{{$mof->code}}</option>

                                                @endforeach

                                            @else

                                                @foreach ($mofs as $mof)

                                                    <option value="{{$mof->id}}"
                                                            data-subtext="{{$mof->description}}"
                                                        {{in_array($mof->id,old('mofs',$mofTuples)) ? 'selected' : ''}}>{{$mof->code}}</option>

                                                @endforeach

                                            @endif

                                        </select>

                                        @if($errors->has('mofs'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mofs')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--CIDB Card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel CIDB--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarCidb"
                                               name="daftarCidb"
                                               data-toggle="collapse"
                                               data-target="#panelCidb" {{(old('daftarCidb',$daftarCidb) === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarCidb">Sijil
                                            CIDB</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel CIDB--}}

                            <div
                                class="collapse {{(old('daftarCidb',$daftarCidb) === 'on') ? 'show' : ''}}"
                                id="panelCidb">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDB"># Pendaftaran</label>

                                        <input id="inputCIDB" name="sijilCidb" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilCidb') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran CIDB"
                                               value="{{old('sijilCidb',$sijilCidb)}}">

                                        @if($errors->has('sijilCidb'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilCidb')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDBMula">Mula</label>

                                        <input id="inputCIDBMula" name="cidbMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('cidbMula') ? 'is-invalid' : ''}}"
                                               value="{{old('cidbMula',$cidbMula)}}">

                                        @if($errors->has('cidbMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDBTamat">Tamat</label>

                                        <input id="inputCIDBTamat" name="cidbTamat" type="date"
                                               class="form-control form-control-sm {{$errors->has('cidbTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('cidbTamat',$cidbTamat)}}">

                                        @if($errors->has('cidbTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--Card bidang 'B'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangB') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangB"
                                                        name="cidbBidangB"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangBpanel" {{(old('cidbBidangB',$cidbBidangB) === 'on') ? 'checked' : ''}}>

                                                    <label class="form-check-label" for="cidbBidangB">B: Bangunan</label>

                                                    @if($errors->has('cidbBidangB'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangB')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangBpanel"
                                             class="collapse {{(old('cidbBidangB',$cidbBidangB) === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangBgred">Gred</label>

                                                    <select
                                                        class="custom-select custom-select-sm {{$errors->has('cidbBidangBgred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangBgred" name="cidbBidangBgred">

                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangBgred',$cidbBidangBgred) === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>

                                                    </select>

                                                    @if($errors->has('cidbBidangBgred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangBgred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangBkod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control form-control-sm {{$errors->has('cidbBidangBkod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangBkod" name="cidbBidangBkod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'B')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangBkod',$cidbBidangBkod) === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangBkod',$cidbBidangBkod)) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangBkod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangBkod')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{--Card bidang 'CE'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangCe') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangCe"
                                                        name="cidbBidangCe"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangCePanel" {{(old('cidbBidangCe',$cidbBidangCe) === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangCe">CE: Kejuruteraan Awam</label>

                                                    @if($errors->has('cidbBidangCe'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangCe')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangCePanel"
                                             class="collapse {{(old('cidbBidangCe',$cidbBidangCe) === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangCeGred">Gred</label>

                                                    <select
                                                        class="custom-select custom-select-sm {{$errors->has('cidbBidangCeGred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangCeGred" name="cidbBidangCeGred">
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred',$cidbBidangCeGred) === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>
                                                    </select>

                                                    @if($errors->has('cidbBidangCeGred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangCeGred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangCeKod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control form-control-sm {{$errors->has('cidbBidangCeKod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangCeKod" name="cidbBidangCeKod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'CE')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangCeKod',$cidbBidangCeKod) === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangCeKod',$cidbBidangCeKod)) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangCeKod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangCeKod')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{--Card bidang 'ME'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangMe') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangMe"
                                                        name="cidbBidangMe"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangMePanel" {{(old('cidbBidangMe',$cidbBidangMe) === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangMe">ME: Mekanikal / Elektrik</label>

                                                    @if($errors->has('cidbBidangMe'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangMe')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangMePanel"
                                             class="collapse {{(old('cidbBidangMe',$cidbBidangMe) === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangMeGred">Gred</label>

                                                    <select
                                                        class="custom-select custom-select-sm {{$errors->has('cidbBidangMeGred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangMeGred" name="cidbBidangMeGred">
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred',$cidbBidangMeGred) === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>
                                                    </select>

                                                    @if($errors->has('cidbBidangMeGred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangMeGred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangMeKod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control form-control-sm {{$errors->has('cidbBidangMeKod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangMeKod" name="cidbBidangMeKod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'ME')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangMeKod',$cidbBidangMeKod) === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangMeKod',$cidbBidangMeKod)) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangMeKod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangMeKod')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{--Card bidang 'F'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangF') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangF"
                                                        name="cidbBidangF"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangFpanel" {{(old('cidbBidangF',$cidbBidangF) === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangF">F: Fasiliti</label>

                                                    @if($errors->has('cidbBidangF'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangF')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangFpanel"
                                             class="collapse {{(old('cidbBidangF',$cidbBidangF) === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangFgred">Gred</label>

                                                    <select
                                                        class="custom-select custom-select-sm {{$errors->has('cidbBidangFgred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangFgred" name="cidbBidangFgred">
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangFgred',$cidbBidangFgred) === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>
                                                    </select>

                                                    @if($errors->has('cidbBidangFgred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangFgred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangFkod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control form-control-sm {{$errors->has('cidbBidangFkod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangFkod" name="cidbBidangFkod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'F')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangFkod',$cidbBidangFkod) === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangFkod',$cidbBidangFkod)) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangFkod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangFkod')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--PKK Card--}}

                    <div class="card  bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel PKK--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarPkk"
                                               name="daftarPkk"
                                               data-toggle="collapse"
                                               data-target="#panelPkk" {{(old('daftarPkk',$daftarPkk) === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarPkk">Sijil
                                            PKK</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel PKK--}}

                            <div class="collapse {{(old('daftarPkk',$daftarPkk) === 'on') ? 'show' : ''}}"
                                 id="panelPkk">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputPKK"># Pendaftaran</label>

                                        <input id="inputPKK" name="sijilPkk" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilPkk') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran PKK"
                                               value="{{old('sijilPkk',$sijilPkk)}}">

                                        @if($errors->has('sijilPkk'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilPkk')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputPKKMula">Mula</label>

                                        <input id="inputPKKMula" name="pkkMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('pkkMula') ? 'is-invalid' : ''}}"
                                               value="{{old('pkkMula',$pkkMula)}}">

                                        @if($errors->has('pkkMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('pkkMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputPKKTamat">Tamat</label>

                                        <input id="inputPKKTamat" name="pkkTamat" type="date"
                                               class="form-control form-control-sm {{$errors->has('pkkTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('pkkTamat',$pkkTamat)}}">

                                        @if($errors->has('pkkTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('pkkTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--Butang Hantar--}}

                    <div class="form-row">

                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                    </div>

                </fieldset>

            </form>

        </div>

    </div>

@endsection

@section('script')

    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <script>

        (function ($) {

            $.fn.selectpicker.defaults = {
                noneSelectedText: 'Tidak ada yang dipilih',
                noneResultsText: 'Tidak ada yang sama {0}',
                countSelectedText: '{0} terpilih',
                maxOptionsText: ['Mencapai batas (maksimum {n})', 'Mencapai batas himpunan (maksimum {n})'],
                selectAllText: 'Pilih Semua',
                deselectAllText: 'Hapus Semua',
                multipleSeparator: ', '
            };

        })(jQuery);

    </script>

@endsection
