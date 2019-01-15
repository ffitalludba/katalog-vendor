@extends('v2_vendor_doc_layout')

@section('style')

    @parent

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css">


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

            <form class="needs-validation p-3" novalidate method="post" action="{{route('vendor-doc.store')}}">

                @csrf

                <fieldset>

                    <legend>Butiran Pendaftaran</legend>

                    {{--Input syarikat--}}

                    <div class="form-row">

                        <div class="form-group col-md-12">

                            <label for="inputSyarikat">Syarikat</label>

                            <input id="inputSyarikat" name="syarikat" type="text"
                                   class="form-control form-control-sm {{$errors->has('syarikat') ? 'is-invalid' : ''}}"
                                   placeholder="Nama rasmi syarikat" value="{{old('syarikat')}}" data-toggle="tooltip"
                                   data-placement="top"
                                   title="Taip huruf besar dan elakkan ruang ganda."
                                   autofocus>

                            @if($errors->has('syarikat'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('syarikat') }}

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
                                   class="form-control form-control-sm"
                                   placeholder="Nombor petisurat, tingkat bangunan & nama bangunan"
                                   value="{{old('alamat1')}}">

                        </div>

                    </div>

                    {{--Input poskod, bandar & negeri--}}

                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label for="inputPoskod">Poskod</label>

                            <input id="inputPoskod" name="poskod" type="text"
                                   class="form-control form-control-sm {{$errors->has('poskod') ? 'is-invalid' : ''}}"
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
                                   class="form-control form-control-sm {{$errors->has('bandar') ? 'is-invalid' : ''}}"
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
                                   class="form-control form-control-sm {{$errors->has('negeri') ? 'is-invalid' : ''}}"
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

                        <div class="form-group col-md-4">

                            <label for="inputTelefon">Telefon Pejabat</label>

                            <input id="inputTelefon" name="telefon" type="text"
                                   class="form-control form-control-sm {{$errors->has('telefon') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor telefon talian tetap" value="{{old('telefon')}}">

                            @if($errors->has('telefon'))

                                <div class="invalid-feedback">

                                    {{$errors->first('telefon')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputTelefon1">Telefon Bimbit</label>

                            <input id="inputTelefon1" name="telefon1" type="text"
                                   class="form-control form-control-sm {{$errors->has('telefon1') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor telefon bimbit" value="{{old('telefon1')}}">

                            @if($errors->has('telefon1'))

                                <div class="invalid-feedback">

                                    {{$errors->first('telefon1')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-4">

                            <label for="inputEmel">Emel</label>

                            <input id="inputEmel" name="emel" type="email"
                                   class="form-control form-control-sm {{$errors->has('emel') ? 'is-invalid' : ''}}"
                                   placeholder="Emel rasmi syarikat" value="{{old('emel')}}">

                            @if($errors->has('emel'))

                                <div class="invalid-feedback">

                                    {{$errors->first('emel')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--Input Pengurus--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputPengurus">Pengurus</label>

                            <input id="inputPengurus" name="pengurus" type="text"
                                   class="form-control form-control-sm {{$errors->has('pengurus') ? 'is-invalid' : ''}}"
                                   placeholder="Nama penuh pengurus" value="{{old('pengurus')}}">

                            @if($errors->has('pengurus'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('pengurus') }}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputMykad">Mykad</label>

                            <input id="inputMykad" name="mykad" type="text"
                                   class="form-control form-control-sm {{$errors->has('mykad') ? 'is-invalid' : ''}}"
                                   placeholder="xxxxxx-xx-xxxx" value="{{old('mykad')}}">

                            @if($errors->has('mykad'))

                                <div class="invalid-feedback">

                                    {{ $errors->first('mykad') }}

                                </div>

                            @endif

                        </div>

                    </div>

                    {{--Input Bank--}}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputBank">Bank</label>

                            <input id="inputBank" name="bank" type="text"
                                   class="form-control form-control-sm {{$errors->has('bank') ? 'is-invalid' : ''}}"
                                   placeholder="Nama bank" value="{{old('bank')}}">

                            @if($errors->has('bank'))

                                <div class="invalid-feedback">

                                    {{$errors->first('bank')}}

                                </div>

                            @endif

                        </div>

                        <div class="form-group col-md-6">

                            <label for="inputBankAkaun"># Akaun</label>

                            <input id="inputBankAkaun" name="bankAkaun" type="text"
                                   class="form-control form-control-sm {{$errors->has('bankAkaun') ? 'is-invalid' : ''}}"
                                   placeholder="Nombor akaun bank" value="{{old('bankAkaun')}}">

                            @if($errors->has('bankAkaun'))

                                <div class="invalid-feedback">

                                    {{$errors->first('bankAkaun')}}

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
                                               class="form-control form-control-sm {{$errors->has('sijilMpspk') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('mpspkMula') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('mpspkTamat') ? 'is-invalid' : ''}}"
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

                                        <input class="form-check-input" type="checkbox" id="daftarSsm"
                                               name="daftarSsm"
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
                                               class="form-control form-control-sm {{$errors->has('sijilSsm') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('ssmMula') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('ssmTamat') ? 'is-invalid' : ''}}"
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

                                        <input class="form-check-input" type="checkbox" id="daftarMof"
                                               name="daftarMof"
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
                                               class="form-control form-control-sm {{$errors->has('sijilMof') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('mofMula') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('mofTamat') ? 'is-invalid' : ''}}"
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
                                                class="form-control form-control-sm selectpicker {{$errors->has('mofs') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('sijilCidb') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('cidbMula') ? 'is-invalid' : ''}}"
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
                                               class="form-control form-control-sm {{$errors->has('cidbTamat') ? 'is-invalid' : ''}}"
                                               value="{{old('cidbTamat')}}">

                                        @if($errors->has('cidbTamat'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbTamat')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G1--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG1">Gred G1</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG1') ? 'is-invalid' : ''}}"
                                            id="cidbGredG1" name="cidbGredG1[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG1') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG1')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG1') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG1')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG1') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG1')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG1'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG1')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G2--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG2">Gred G2</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG2') ? 'is-invalid' : ''}}"
                                            id="cidbGredG2" name="cidbGredG2[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG2') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG2')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG2') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG2')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG2') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG2')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG2'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG2')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G3--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG3">Gred G3</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG3') ? 'is-invalid' : ''}}"
                                            id="cidbGredG3" name="cidbGredG3[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG3') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG3')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG3') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG3')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG3') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG3')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG3'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG3')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G4--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG4">Gred G4</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG4') ? 'is-invalid' : ''}}"
                                            id="cidbGredG4" name="cidbGredG4[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG4') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG4')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG4') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG4')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG4') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG4')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="F: Fasiliti">

                                                @foreach ($cidbFtuples as $cidb)

                                                    @if(old('cidbGredG4') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG4')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG4'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG4')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G5--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG5">Gred G5</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG5') ? 'is-invalid' : ''}}"
                                            id="cidbGredG5" name="cidbGredG5[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG5') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG5')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG5') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG5')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG5') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG5')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="F: Fasiliti">

                                                @foreach ($cidbFtuples as $cidb)

                                                    @if(old('cidbGredG5') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG5')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG5'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG5')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G6--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG6">Gred G6</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG6') ? 'is-invalid' : ''}}"
                                            id="cidbGredG6" name="cidbGredG6[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG6') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG6')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG6') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG6')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG6') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG6')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="F: Fasiliti">

                                                @foreach ($cidbFtuples as $cidb)

                                                    @if(old('cidbGredG6') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG6')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG6'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG6')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--G7--}}

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="cidbGredG7">Gred G7</label>

                                        <select
                                            class="selectpicker form-control form-control-sm {{$errors->has('cidbGredG7') ? 'is-invalid' : ''}}"
                                            id="cidbGredG7" name="cidbGredG7[]"
                                            multiple data-live-search="true" data-size="7"
                                            data-actions-box="true"
                                            data-style="btn">

                                            <optgroup label="B: Pembinaan Bangunan">

                                                @foreach ($cidbBtuples as $cidb)

                                                    @if(old('cidbGredG7') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG7')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="CE: Pembinaan Kejuruteraan Awam">

                                                @foreach ($cidbCeTuples as $cidb)

                                                    @if(old('cidbGredG7') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG7')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="ME: Mekanikal dan Elektrikal">

                                                @foreach ($cidbMeTuples as $cidb)

                                                    @if(old('cidbGredG7') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG7')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                            <optgroup label="F: Fasiliti">

                                                @foreach ($cidbFtuples as $cidb)

                                                    @if(old('cidbGredG7') === null)

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}">{{$cidb->subtype}}</option>

                                                    @else

                                                        <option value="{{$cidb->id}}"
                                                                data-subtext="{{title_case($cidb->description)}}"
                                                            {{in_array($cidb->id, old('cidbGredG7')) ? 'selected' : ''}}>{{$cidb->subtype}}</option>

                                                    @endif

                                                @endforeach

                                            </optgroup>

                                        </select>

                                        @if($errors->has('cidbGredG7'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('cidbGredG7')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{--Taraf bumiputra--}}

                                <div class="form-row">

                                    <div class="form-group">

                                        <div class="form-check form-check-inline">

                                            <input class="form-check-input" type="checkbox" id="bumiputra"
                                                   name="bumiputra" {{(old('bumiputra') === 'on') ? 'checked' : ''}}>
                                            <label class="form-check-label" for="bumiputra">Taraf bumiputra (memiliki
                                                SPKK)</label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--Koperasi card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel Koperasi--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarKoperasi"
                                               name="daftarKoperasi"
                                               data-toggle="collapse"
                                               data-target="#panelKoperasi" {{(old('daftarKoperasi') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarKoperasi">Sijil
                                            Koperasi</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel Koperasi--}}

                            <div class="collapse {{(old('daftarKoperasi') === 'on') ? 'show' : ''}}" id="panelKoperasi">

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label for="inputKoperasi"># Pendaftaran</label>

                                        <input id="inputKoperasi" name="sijilKoperasi" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilKoperasi') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran Koperasi"
                                               value="{{old('sijilKoperasi')}}">

                                        @if($errors->has('sijilKoperasi'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilKoperasi')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="inputKoperasiMula">Mula</label>

                                        <input id="inputKoperasiMula" name="koperasiMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('koperasiMula') ? 'is-invalid' : ''}}"
                                               value="{{old('koperasiMula')}}">

                                        @if($errors->has('koperasiMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('koperasiMula')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--Peladang card--}}

                    <div class="card bg-light mb-3">

                        <div class="card-body">

                            {{--Suis panel Peladang--}}

                            <div class="form-row">

                                <div class="form-group">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="daftarPeladang"
                                               name="daftarPeladang"
                                               data-toggle="collapse"
                                               data-target="#panelPeladang" {{(old('daftarPeladang') === 'on') ? 'checked' : ''}}>
                                        <label class="form-check-label font-weight-bold" for="daftarPeladang">Sijil
                                            Peladang</label>

                                    </div>

                                </div>

                            </div>

                            {{--Panel Peladang--}}

                            <div class="collapse {{(old('daftarPeladang') === 'on') ? 'show' : ''}}" id="panelPeladang">

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label for="inputPeladang"># Pendaftaran</label>

                                        <input id="inputPeladang" name="sijilPeladang" type="text"
                                               class="form-control form-control-sm {{$errors->has('sijilPeladang') ? 'is-invalid' : ''}}"
                                               placeholder="Nombor Pendaftaran Pertubuhan Peladang"
                                               value="{{old('sijilPeladang')}}">

                                        @if($errors->has('sijilPeladang'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('sijilPeladang')}}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="inputPeladangMula">Mula</label>

                                        <input id="inputPeladangMula" name="peladangMula" type="date"
                                               class="form-control form-control-sm {{$errors->has('peladangMula') ? 'is-invalid' : ''}}"
                                               value="{{old('peladangMula')}}">

                                        @if($errors->has('peladangMula'))

                                            <div class="invalid-feedback">

                                                {{$errors->first('peladangMula')}}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{--Butang Hantar--}}

                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                </fieldset>

            </form>

        </div>

    </div>

@endsection

@section('script')

    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js"></script>

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

            $('[data-toggle="tooltip"]').tooltip();

        })(jQuery);

    </script>

@endsection
