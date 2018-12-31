@extends('v2_vendor_doc_layout')

@section('style')

    @parent

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">


@endsection

@section('title','Daftar Kontraktor & Pembekal')

@section('description','Borang pendaftaran kontraktor dan pembekal baharu.')

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

            <form class="needs-validation" novalidate method="post" action="{{route('vendor-doc.store')}}">

                @csrf

                <fieldset>

                    <legend>Butiran Pendaftaran</legend>

                    {{--Input syarikat & pegawai--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputSyarikat">Syarikat</label>

                            <input id="inputSyarikat" name="syarikat" type="text"
                                   class="form-control {{$errors->has('syarikat') ? 'is-invalid' : ''}}"
                                   placeholder="Nama rasmi syarikat" value="{{old('syarikat')}}">

                            @if($errors->has('syarikat'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('syarikat') }}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputPegawai">Pegawai</label>

                            <input id="inputPegawai" name="pegawai" type="text"
                                   class="form-control {{$errors->has('pegawai') ? 'is-invalid' : ''}}"
                                   placeholder="Nama penuh pegawai" value="{{old('pegawai')}}">

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
                                   class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor pejabat, nama jalan & nama kawasan" value="{{old('alamat')}}">

                            @if($errors->has('alamat'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('alamat') }}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputAlamat1">Alamat 1</label>

                            <input id="inputAlamat1" name="alamat1" type="text"
                                   class="form-control {{$errors->any() ? 'is-valid' : ''}}"
                                   placeholder="Nombor petisurat, tingkat bangunan & nama bangunan"
                                   value="{{old('alamat1')}}">

                            @if($errors->any())

                                <div class="valid-feedback">

                                    This field is optional.

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--Input poskod, bandar & negeri--}}

                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label for="inputPoskod">Poskod</label>

                            <input id="inputPoskod" name="poskod" type="text"
                                   class="form-control {{$errors->has('poskod') ? 'is-invalid' : ''}}"
                                   placeholder="Poskod 5 digit" value="{{old('poskod')}}">

                            @if($errors->has('poskod'))

                                <div class="invalid-feedback">

                                    {{$errors->first('poskod')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputBandar">Bandar</label>

                            <input id="inputBandar" name="bandar" type="text"
                                   class="form-control {{$errors->has('bandar') ? 'is-invalid' : ''}}"
                                   placeholder="Nama bandar" value="{{old('bandar')}}">

                            @if($errors->has('bandar'))

                                <div class="invalid-feedback">

                                    {{$errors->first('bandar')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputNegeri">Negeri</label>

                            <input id="inputNegeri" name="negeri" type="text"
                                   class="form-control {{$errors->has('negeri') ? 'is-invalid' : ''}}"
                                   placeholder="Nama negeri" value="{{old('negeri')}}">

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
                                   class="form-control {{$errors->has('telefon') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor telefon bimbit atau talian tetap" value="{{old('telefon')}}">

                            @if($errors->has('telefon'))

                                <div class="invalid-feedback">

                                    {{$errors->first('telefon')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputEmel">Emel</label>

                            <input id="inputEmel" name="emel" type="email"
                                   class="form-control {{$errors->has('emel') ? 'is-invalid' : ''}}"
                                   placeholder="Emel rasmi syarikat" value="{{old('emel')}}">

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
                                               data-target="#panelMpspk" {{(old('daftarMpspk') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarMpspk">Sijil
                                            MPSPK</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel MPSPK--}}

                            <div class="collapse {{(old('daftarMpspk') === 'on') ? 'show' : ''}}" id="panelMpspk">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputMpspk"># Pendaftaran</label>

                                        <input id="inputMpspk" name="sijilMpspk" type="text"
                                               class="form-control {{$errors->has('sijilMpspk') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran MPSPK" value="{{old('sijilMpspk')}}">

                                        @if($errors->has('sijilMpspk'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilMpspk')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMpspkMula">Mula</label>

                                        <input id="inputMpspkMula" name="mpspkMula" type="date"
                                               class="form-control {{$errors->has('mpspkMula') ? 'is-invalid' : ''}}"
                                               value="{{old('mpspkMula')}}">

                                        @if($errors->has('mpspkMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mpspkMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMpspkTamat">Tamat</label>

                                        <input id="inputMpspkTamat" name="mpspkTamat" type="date"
                                               class="form-control {{$errors->has('mpspkTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('mpspkTamat')}}">

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

                                        <input class="form-check-input" type="checkbox" id="daftarSsm" name="daftarSsm"
                                               data-toggle="collapse"
                                               data-target="#panelSsm" {{(old('daftarSsm') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarSsm">Sijil
                                            SSM</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel SSM --}}

                            <div class="collapse {{(old('daftarSsm') === 'on') ? 'show' : ''}}" id="panelSsm">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputSSM"># Pendaftaran</label>

                                        <input id="inputSSM" name="sijilSsm" type="text"
                                               class="form-control {{$errors->has('sijilSsm') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran SSM" value="{{old('sijilSsm')}}">

                                        @if($errors->has('sijilSsm'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilSsm')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputSSMMula">Mula</label>

                                        <input id="inputSSMMula" name="ssmMula" type="date"
                                               class="form-control {{$errors->has('ssmMula') ? 'is-invalid' : ''}}"
                                               value="{{old('ssmMula')}}">

                                        @if($errors->has('ssmMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('ssmMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputSSMTamat">Tamat</label>

                                        <input id="inputSSMTamat" name="ssmTamat" type="date"
                                               class="form-control {{$errors->has('ssmTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('ssmTamat')}}">

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

                                        <input class="form-check-input" type="checkbox" id="daftarMof" name="daftarMof"
                                               data-toggle="collapse"
                                               data-target="#panelMof" {{(old('daftarMof') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarMof">Sijil
                                            MOF</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel MOF--}}

                            <div class="collapse {{(old('daftarMof') === 'on') ? 'show' : ''}}" id="panelMof">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputMOF"># Pendaftaran</label>

                                        <input id="inputMOF" name="sijilMof" type="text"
                                               class="form-control {{$errors->has('sijilMof') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran MOF" value="{{old('sijilMof')}}">

                                        @if($errors->has('sijilMof'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilMof')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMOFMula">Mula</label>

                                        <input id="inputMOFMula" name="mofMula" type="date"
                                               class="form-control {{$errors->has('mofMula') ? 'is-invalid' : ''}}"
                                               value="{{old('mofMula')}}">

                                        @if($errors->has('mofMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('mofMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputMOFTamat">Tamat</label>

                                        <input id="inputMOFTamat" name="mofTamat" type="date"
                                               class="form-control {{$errors->has('mofTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('mofTamat')}}">

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
                                                class="form-control selectpicker {{$errors->has('mofs') ? 'is-invalid' : ''}}"
                                                name="mofs[]"
                                                multiple data-live-search="true" data-size="7" data-actions-box="true"
                                                data-style="btn">

                                            @if(old('mofs') === null)

                                                @foreach ($mofs as $mof)

                                                    <option value="{{$mof->id}}"
                                                            data-subtext="{{$mof->description}}">{{$mof->code}}</option>

                                                @endforeach

                                            @else

                                                @foreach ($mofs as $mof)

                                                    <option value="{{$mof->id}}"
                                                            data-subtext="{{$mof->description}}"
                                                        {{in_array($mof->id, old('mofs')) ? 'selected' : ''}}>{{$mof->code}}</option>

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
                                               data-target="#panelCidb" {{(old('daftarCidb') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarCidb">Sijil
                                            CIDB</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel CIDB--}}

                            <div class="collapse {{(old('daftarCidb') === 'on') ? 'show' : ''}}" id="panelCidb">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDB"># Pendaftaran</label>

                                        <input id="inputCIDB" name="sijilCidb" type="text"
                                               class="form-control {{$errors->has('sijilCidb') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran CIDB" value="{{old('sijilCidb')}}">

                                        @if($errors->has('sijilCidb'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilCidb')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDBMula">Mula</label>

                                        <input id="inputCIDBMula" name="cidbMula" type="date"
                                               class="form-control {{$errors->has('cidbMula') ? 'is-invalid' : ''}}"
                                               value="{{old('cidbMula')}}">

                                        @if($errors->has('cidbMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputCIDBTamat">Tamat</label>

                                        <input id="inputCIDBTamat" name="cidbTamat" type="date"
                                               class="form-control {{$errors->has('cidbTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('cidbTamat')}}">

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
                                                        data-target="#cidbBidangBpanel" {{(old('cidbBidangB') === 'on') ? 'checked' : ''}}>

                                                    <label class="form-check-label" for="cidbBidangB">B&nbsp;</label>

                                                    @if($errors->has('cidbBidangB'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangB')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangBpanel"
                                             class="collapse {{(old('cidbBidangB') === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangBgred">Gred</label>

                                                    <select
                                                        class="custom-select {{$errors->has('cidbBidangBgred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangBgred" name="cidbBidangBgred">

                                                        <option {{(old('cidbBidangBgred') === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangBgred') === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangBgred') === 'G7') ? 'selected' : ''}}>
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
                                                        class="selectpicker form-control {{$errors->has('cidbBidangBkod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangBkod" name="cidbBidangBkod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'B')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangBkod') === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangBkod')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

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
                                                        data-target="#cidbBidangCePanel" {{(old('cidbBidangCe') === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangCe">CE&nbsp;</label>

                                                    @if($errors->has('cidbBidangCe'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangCe')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangCePanel"
                                             class="collapse {{(old('cidbBidangCe') === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangCeGred">Gred</label>

                                                    <select
                                                        class="custom-select {{$errors->has('cidbBidangCeGred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangCeGred" name="cidbBidangCeGred">
                                                        <option {{(old('cidbBidangCeGred') === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangCeGred') === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangCeGred') === 'G7') ? 'selected' : ''}}>
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
                                                        class="selectpicker form-control {{$errors->has('cidbBidangCeKod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangCeKod" name="cidbBidangCeKod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'CE')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangCeKod') === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangCeKod')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

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

                                {{--Card bidang 'E'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangE') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangE"
                                                        name="cidbBidangE"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangEpanel" {{(old('cidbBidangE') === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangE">E&nbsp;</label>

                                                    @if($errors->has('cidbBidangE'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangE')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangEpanel"
                                             class="collapse {{(old('cidbBidangE') === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangEgred">Gred</label>

                                                    <select
                                                        class="custom-select {{$errors->has('cidbBidangEgred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangEgred" name="cidbBidangEgred">
                                                        <option {{(old('cidbBidangEgred') === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangEgred') === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangEgred') === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>
                                                    </select>

                                                    @if($errors->has('cidbBidangEgred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangEgred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangEkod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control {{$errors->has('cidbBidangEkod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangEkod" name="cidbBidangEkod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'E')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangEkod') === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangEkod')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangEkod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangEkod')}}

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
                                                        data-target="#cidbBidangMePanel" {{(old('cidbBidangMe') === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangMe">ME&nbsp;</label>

                                                    @if($errors->has('cidbBidangMe'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangMe')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangMePanel"
                                             class="collapse {{(old('cidbBidangMe') === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangMeGred">Gred</label>

                                                    <select
                                                        class="custom-select {{$errors->has('cidbBidangMeGred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangMeGred" name="cidbBidangMeGred">
                                                        <option {{(old('cidbBidangMeGred') === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangMeGred') === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangMeGred') === 'G7') ? 'selected' : ''}}>
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
                                                        class="selectpicker form-control {{$errors->has('cidbBidangMeKod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangMeKod" name="cidbBidangMeKod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'ME')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangMeKod') === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangMeKod')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

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

                                {{--Card bidang 'P'--}}

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-12">

                                                <div class="form-check form-check-inline">

                                                    <input
                                                        class="form-check-input {{$errors->has('cidbBidangP') ? 'is-invalid' : ''}}"
                                                        type="checkbox" id="cidbBidangP"
                                                        name="cidbBidangP"
                                                        data-toggle="collapse"
                                                        data-target="#cidbBidangPpanel" {{(old('cidbBidangP') === 'on') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="cidbBidangP">P&nbsp;</label>

                                                    @if($errors->has('cidbBidangP'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangP')}}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                        <div id="cidbBidangPpanel"
                                             class="collapse {{(old('cidbBidangP') === 'on') ? 'show' : ''}}">

                                            <div class="form-row">

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangPgred">Gred</label>

                                                    <select
                                                        class="custom-select {{$errors->has('cidbBidangPgred') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangPgred" name="cidbBidangPgred">
                                                        <option {{(old('cidbBidangPgred') === null) ? 'selected' : ''}}></option>
                                                        <option {{(old('cidbBidangPgred') === 'G1') ? 'selected' : ''}}>
                                                            G1
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G2') ? 'selected' : ''}}>
                                                            G2
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G3') ? 'selected' : ''}}>
                                                            G3
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G4') ? 'selected' : ''}}>
                                                            G4
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G5') ? 'selected' : ''}}>
                                                            G5
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G6') ? 'selected' : ''}}>
                                                            G6
                                                        </option>
                                                        <option {{(old('cidbBidangPgred') === 'G7') ? 'selected' : ''}}>
                                                            G7
                                                        </option>
                                                    </select>

                                                    @if($errors->has('cidbBidangPgred'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangPgred')}}

                                                        </div>

                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="cidbBidangPkod">Kod Bidang</label>

                                                    <select
                                                        class="selectpicker form-control {{$errors->has('cidbBidangPkod') ? 'is-invalid' : ''}}"
                                                        id="cidbBidangPkod" name="cidbBidangPkod[]"
                                                        multiple data-live-search="true" data-size="7"
                                                        data-actions-box="true"
                                                        data-style="btn">

                                                        @foreach ($cidbs as $cidb)

                                                            @if ($cidb->type !== 'P')

                                                                @continue

                                                            @endif

                                                            @if(old('cidbBidangPkod') === null)

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                            @else

                                                                <option value="{{$cidb->id}}"
                                                                        data-subtext="{{title_case($cidb->description)}}"
                                                                    {{in_array($cidb->id, old('cidbBidangPkod')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    @if($errors->has('cidbBidangPkod'))

                                                        <div class="invalid-feedback">

                                                            {{$errors->first('cidbBidangPkod')}}

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

                                        <input class="form-check-input" type="checkbox" id="daftarPkk" name="daftarPkk"
                                               data-toggle="collapse"
                                               data-target="#panelPkk" {{(old('daftarPkk') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarPkk">Sijil
                                            PKK</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel PKK--}}

                            <div class="collapse {{(old('daftarPkk') === 'on') ? 'show' : ''}}" id="panelPkk">

                                <div class="form-row">

                                    <div class="form-group col-md-4">

                                        <label for="inputPKK"># Pendaftaran</label>

                                        <input id="inputPKK" name="sijilPkk" type="text"
                                               class="form-control {{$errors->has('sijilPkk') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran PKK" value="{{old('sijilPkk')}}">

                                        @if($errors->has('sijilPkk'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilPkk')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputPKKMula">Mula</label>

                                        <input id="inputPKKMula" name="pkkMula" type="date"
                                               class="form-control {{$errors->has('pkkMula') ? 'is-invalid' : ''}}"
                                               value="{{old('pkkMula')}}">

                                        @if($errors->has('pkkMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('pkkMula')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-4">

                                        <label for="inputPKKTamat">Tamat</label>

                                        <input id="inputPKKTamat" name="pkkTamat" type="date"
                                               class="form-control {{$errors->has('pkkTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('pkkTamat')}}">

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

                        <button type="submit" class="btn btn-primary">Simpan</button>

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
