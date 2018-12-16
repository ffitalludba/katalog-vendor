@extends('v2_vendor_doc_layout')

@section('title','Senarai Kontraktor & Pembekal')

@section('description','Senarai kontraktor dan pembekal yang berdaftar di bawah Jabatan Kejuruteraan.')

@section('content')

    @if($vendors->isNotEmpty())

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">Syarikat</th>
                    <th scope="col">Pegawai</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Emel</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vendors as $vendor)

                    <tr>
                        <th scope="row">
                            <a href="{{route('vendor-doc.show',['vendor-doc'=>$vendor->id])}}">{{$vendor->name}}</a>
                        </th>
                        <td>{{title_case($vendor->officer)}}</td>
                        <td>{{$vendor->telephone}}</td>
                        <td>{{$vendor->email}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    @else

        <p>(tiada)</p>

    @endif

@endsection
