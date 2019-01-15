@extends('v2_vendor_doc_layout')

@section('title',$vendor->name)

@section('action')

    <a class="btn btn-sm btn-secondary" href="{{route('vendor-doc.edit', ['id' => $vendor->id])}}"
       role="button">Ubah</a>
    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModal">Hapus</button>
    <a class="btn btn-sm btn-secondary" href="{{route('vendor-certificate', ['id' => $vendor->id])}}"
       role="button">Sijil Perakuan</a>

@endsection

@section('description','Maklumat lengkap kontraktor / pembekal.')

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="modal-body">
                    Anda pasti mahu menghapus item ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger" form="hapusVendor">Ya</button>
                </div>

            </div>

        </div>

    </div>

    <div class="card-deck">

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="card-title">Syarikat</h5>

                <dl class="row">

                    <dt class="col-sm-4">Pengurus</dt>
                    <dd class="col-sm-8">{{title_case($vendor->officer)}}</dd>

                    <dt class="col-sm-4">Mykad</dt>
                    <dd class="col-sm-8">{{title_case($vendor->mykad)}}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8">{{$address}}</dd>

                    <dt class="col-sm-4">Telefon Pejabat</dt>
                    <dd class="col-sm-8">

                        @if($vendor->telephone !== null)

                            {{$vendor->telephone}}

                        @else

                            <span class="badge badge-secondary">Tiada</span>

                        @endif

                    </dd>

                    <dt class="col-sm-4">Telefon Bimbit</dt>
                    <dd class="col-sm-8">

                        @if($vendor->telephone1 !== null)

                            {{$vendor->telephone1}}

                        @else

                            <span class="badge badge-secondary">Tiada</span>

                        @endif

                    </dd>

                    <dt class="col-sm-4">Emel</dt>
                    <dd class="col-sm-8">

                        @if($vendor->email !== null)

                            {{$vendor->email}}

                        @else

                            <span class="badge badge-secondary">Tiada</span>

                        @endif

                    </dd>

                    <dt class="col-sm-4">Bank</dt>
                    <dd class="col-sm-8">{{title_case($vendor->bank)}}</dd>

                    <dt class="col-sm-4"># Akaun</dt>
                    <dd class="col-sm-8">{{title_case($vendor->bank_account)}}</dd>

                </dl>

            </div>

        </div>

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="card-title">Pendaftaran</h5>

                <dl class="row">

                    @if($vendor->mpspk_id !== null)

                        <dt class="col-sm-4"># MPSPK</dt>
                        <dd class="col-sm-8">{{$vendor->mpspk_id}}</dd>

                        <dt class="col-sm-4">Tempoh Sah</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->mpspk_start))}} &ndash;
                            {{date("d M Y", strtotime($vendor->mpspk_thru))}}</dd>

                    @else

                        <dt class="col-sm-4"># MPSPK</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

                <dl class="row">

                    @if($vendor->ssm_id !== null)

                        <dt class="col-sm-4"># SSM</dt>
                        <dd class="col-sm-8">{{$vendor->ssm_id}}</dd>

                        <dt class="col-sm-4">Tempoh Sah</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->ssm_start))}} &ndash;
                            {{$vendor->ssm_thru !== null ? date("d M Y", strtotime($vendor->ssm_thru)) : '?'}}</dd>

                    @else

                        <dt class="col-sm-4"># SSM</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

                <dl class="row">

                    @if($vendor->koperasi_id !== null)

                        <dt class="col-sm-4"># Koperasi</dt>
                        <dd class="col-sm-8">{{$vendor->koperasi_id}}</dd>

                        <dt class="col-sm-4">Mula</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->koperasi_start))}}</dd>

                    @else

                        <dt class="col-sm-4"># Koperasi</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

                <dl class="row">

                    @if($vendor->peladang_id !== null)

                        <dt class="col-sm-4"># Peladang</dt>
                        <dd class="col-sm-8">{{$vendor->peladang_id}}</dd>

                        <dt class="col-sm-4">Mula</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->peladang_start))}}</dd>

                    @else

                        <dt class="col-sm-4"># Peladang</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

                <dl class="row">

                    @if($vendor->mof_id !== null)

                        <dt class="col-sm-4"># Kewangan</dt>
                        <dd class="col-sm-8">{{$vendor->mof_id}}</dd>

                        <dt class="col-sm-4">Tempoh Sah</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->mof_start))}} &ndash;
                            {{date("d M Y", strtotime($vendor->mof_thru))}}</dd>

                    @else

                        <dt class="col-sm-4"># MOF</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

                <dl class="row">

                    @if($vendor->cidb_id !== null)

                        <dt class="col-sm-4"># CIDB</dt>
                        <dd class="col-sm-8">{{$vendor->cidb_id}}</dd>

                        <dt class="col-sm-4">Tempoh Sah</dt>
                        <dd class="col-sm-8">
                            {{date("d M Y", strtotime($vendor->cidb_start))}} &ndash;
                            {{date("d M Y", strtotime($vendor->cidb_thru))}}</dd>

                        <dt class="col-sm-4">Taraf bumiputra</dt>
                        <dd class="col-sm-8">{{$vendor->bumiputra === true ? 'Ya' : 'Tidak'}}</dd>

                    @else

                        <dt class="col-sm-4"># CIDB</dt>
                        <dd class="col-sm-8"><span class="badge badge-secondary">Tiada</span></dd>

                    @endif

                </dl>

            </div>

        </div>

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="card-title">Pembayaran</h5>

                <p><span class="badge badge-secondary">Tiada</span></p>

            </div>

        </div>

    </div>

    <div class="card-deck">

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="card-title">Lesen CIDB</h5>

                @if ($cidbTuples->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-sm">

                            <caption>{{'('.$cidbTuples->count().' pengkhususan CIDB)'}}</caption>

                            <thead>

                            <tr>

                                <th scope="col">Gred</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Pengkhususan</th>
                                <th scope="col">Keterangan</th>

                            </tr>

                            </thead>

                            <tbody>

                            @if($cidbTuples->contains('grade','G1'))

                                @foreach($cidbTuples->where('grade','G1')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G1')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G1')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G2'))

                                @foreach($cidbTuples->where('grade','G2')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G2')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G2')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G3'))

                                @foreach($cidbTuples->where('grade','G3')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G3')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G3')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G4'))

                                @foreach($cidbTuples->where('grade','G4')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G4')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G4')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G5'))

                                @foreach($cidbTuples->where('grade','G5')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G5')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G5')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G6'))

                                @foreach($cidbTuples->where('grade','G6')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G6')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G6')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            @if($cidbTuples->contains('grade','G7'))

                                @foreach($cidbTuples->where('grade','G7')->sortBy('subtype') as $item)

                                    <tr>

                                        @if($cidbTuples->where('grade','G7')->sortBy('subtype')->first() === $item)

                                            <th scope="row"
                                                rowspan="{{$cidbTuples->where('grade','G7')->count()}}">{{$item->grade}}</th>

                                        @endif

                                        <th>{{$item->type}}</th>
                                        <td>{{$item->subtype}}</td>
                                        <td>{{title_case($item->description)}}</td>

                                    </tr>

                                @endforeach

                            @endif

                            </tbody>

                        </table>

                    </div>

                @else

                    <p><span class="badge badge-secondary">Tiada</span></p>

                @endif


            </div>

        </div>

        <div class="card mb-3">

            <div class="card-body">

                <h5 class="card-title">Lesen Kementerian Kewangan</h5>

                @if ($mofTuples->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-sm">

                            <caption>{{'('.$mofTuples->count().' bidang Kementerian Kewangan)'}}</caption>

                            <thead>

                            <tr>

                                <th scope="col">Bidang</th>
                                <th scope="col">Keterangan</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($mofTuples as $key => $value)

                                <tr>

                                    <th scope="row">{{$key}}</th>
                                    <td>{{$value}}</td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <p><span class="badge badge-secondary">Tiada</span></p>

                @endif

            </div>

        </div>

    </div>

    <form id="hapusVendor" action="{{route('vendor-doc.destroy',$vendor->id)}}" method="POST">

        @csrf()
        @method('DELETE')

    </form>

@endsection
