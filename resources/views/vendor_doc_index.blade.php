@extends('v2_vendor_doc_layout')

@section('style')

    @parent

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>

@endsection

@section('title','Senarai Kontraktor & Pembekal')

@section('description','Senarai kontraktor dan pembekal yang berdaftar di bawah Jabatan Kejuruteraan.')

@section('content')

    <div class="card">

        <div class="card-body">

            @if($vendors->isNotEmpty())

                <div class="table-responsive p-3">

                    <table id="tableVendor" class="table table-striped table-sm">

                        <thead>

                        <tr>

                            <th scope="col">Syarikat</th>
                            <th scope="col">Pengurus</th>
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

                <p><span class="badge badge-secondary">Tiada</span></p>

            @endif

        </div>

    </div>

@endsection

@section('script')

    @parent

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#tableVendor').DataTable({

                language: {
                    "sEmptyTable": "Tiada data",
                    "sInfo": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
                    "sInfoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
                    "sInfoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Papar _MENU_ rekod",
                    "sLoadingRecords": "Diproses...",
                    "sProcessing": "Sedang diproses...",
                    "sSearch": "Carian:",
                    "sZeroRecords": "Tiada padanan rekod yang dijumpai.",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelum",
                        "sNext": "Kemudian",
                        "sLast": "Akhir"
                    },
                    "oAria": {
                        "sSortAscending": ": diaktifkan kepada susunan lajur menaik",
                        "sSortDescending": ": diaktifkan kepada susunan lajur menurun"
                    }
                }

            });

        });

    </script>

@endsection
