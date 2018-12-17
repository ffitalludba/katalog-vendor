@extends('v2_vendor_doc_layout')

@section('title',title_case($vendor->name))

@section('action')

    <a class="btn btn-sm btn-outline-secondary" href="{{route('vendor-certificate', ['id' => $vendor->id])}}"
       role="button">Sijil Perakuan</a>
    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">Hapus</button>

@endsection

@section('description',title_case($vendor->officer))

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

    <h3>Butiran Alamat</h3>

    <dl class="row">

        <dt class="col-sm-4">Alamat</dt>
        <dd class="col-sm-8">{{title_case($vendor->address)}}</dd>

        @if($vendor->address1 !== null)
            <dt class="col-sm-4">Alamat (tambahan)</dt>
            <dd class="col-sm-8">{{title_case($vendor->address1)}}</dd>
        @endif

        <dt class="col-sm-4">Poskod</dt>
        <dd class="col-sm-8">{{$vendor->postcode}}</dd>

        <dt class="col-sm-4">Bandar</dt>
        <dd class="col-sm-8">{{title_case($vendor->town)}}</dd>

        <dt class="col-sm-4">Negeri</dt>
        <dd class="col-sm-8">{{title_case($vendor->state)}}</dd>

        <dt class="col-sm-4">Telefon</dt>
        <dd class="col-sm-8">{{$vendor->telephone}}</dd>

        <dt class="col-sm-4">Emel</dt>
        <dd class="col-sm-8">{{$vendor->email}}</dd>

    </dl>

    <h3>Butiran Pendaftaran</h3>

    <dl class="row">

        @if($vendor->mpspk_id !== null)

            <dt class="col-sm-4"># Sijil MPSPK</dt>
            <dd class="col-sm-8">{{$vendor->mpspk_id}}</dd>

            <dt class="col-sm-4">Tempoh Sah Sijil MPSPK</dt>
            <dd class="col-sm-8">
                {{date("d M Y", strtotime($vendor->mpspk_start))}} &ndash;
                {{date("d M Y", strtotime($vendor->mpspk_thru))}}</dd>

        @else

            <dt class="col-sm-4"># Sijil MPSPK</dt>
            <dd class="col-sm-8">(tiada)</dd>

        @endif

    </dl>

    <dl class="row">

        @if($vendor->ssm_id !== null)

            <dt class="col-sm-4"># Sijil SSM</dt>
            <dd class="col-sm-8">{{$vendor->ssm_id}}</dd>

            <dt class="col-sm-4">Tempoh Sah Sijil SSM</dt>
            <dd class="col-sm-8">
                {{date("d M Y", strtotime($vendor->ssm_start))}} &ndash;
                {{date("d M Y", strtotime($vendor->ssm_thru))}}</dd>

        @else

            <dt class="col-sm-4"># Sijil SSM</dt>
            <dd class="col-sm-8">(tiada)</dd>

        @endif

    </dl>

    <dl class="row">

        @if($vendor->mof_id !== null)

            <dt class="col-sm-4"># Sijil Kewangan</dt>
            <dd class="col-sm-8">{{$vendor->mof_id}}</dd>

            <dt class="col-sm-4">Tempoh Sah Sijil Kewangan</dt>
            <dd class="col-sm-8">
                {{date("d M Y", strtotime($vendor->mof_start))}} &ndash;
                {{date("d M Y", strtotime($vendor->mof_thru))}}</dd>

        @else

            <dt class="col-sm-4"># Sijil MOF</dt>
            <dd class="col-sm-8">(tiada)</dd>

        @endif

    </dl>

    <dl class="row">

        @if($vendor->cidb_id !== null)

            <dt class="col-sm-4"># Sijil CIDB</dt>
            <dd class="col-sm-8">{{$vendor->cidb_id}}</dd>

            <dt class="col-sm-4">Tempoh Sah Sijil Kewangan</dt>
            <dd class="col-sm-8">
                {{date("d M Y", strtotime($vendor->cidb_start))}} &ndash;
                {{date("d M Y", strtotime($vendor->cidb_thru))}}</dd>

        @else

            <dt class="col-sm-4"># Sijil CIDB</dt>
            <dd class="col-sm-8">(tiada)</dd>

        @endif

    </dl>

    <dl class="row">

        @if($vendor->pkk_id !== null)

            <dt class="col-sm-4"># Sijil PKK</dt>
            <dd class="col-sm-8">{{$vendor->pkk_id}}</dd>

            <dt class="col-sm-4">Tempoh Sah Sijil PKK</dt>
            <dd class="col-sm-8">
                {{date("d M Y", strtotime($vendor->pkk_start))}} &ndash;
                {{date("d M Y", strtotime($vendor->pkk_thru))}}</dd>

        @else

            <dt class="col-sm-4"># Sijil PKK</dt>
            <dd class="col-sm-8">(tiada)</dd>

        @endif

    </dl>

    <h3>Butiran Sijil</h3>

    <dl class="row">

        <dt class="col-sm-4">Pendaftaran MOF</dt>
        <dd class="col-sm-8">

            @if ($mof_details->isNotEmpty())

                {{$mof_details->implode(', ')}}

            @else

                <p>(tiada)</p>

            @endif

        </dd>

    </dl>

    <dl class="row">

        <dt class="col-sm-4">Pendaftaran CIDB</dt>
        <dd class="col-sm-8">

            <ul class="list-unstyled">

                @forelse ($cidb_details as $key => $value)

                    <li>{{$key}}&emsp;{{$value['grade']}}&emsp;{{implode(', ',$value['subtype'])}}</li>

                @empty

                    <p>(tiada)</p>

                @endforelse

            </ul>

        </dd>

    </dl>

    <form id="hapusVendor" action="{{route('vendor-doc.destroy',$vendor->id)}}" method="POST">
        @csrf()
        @method('DELETE')
    </form>

@endsection
