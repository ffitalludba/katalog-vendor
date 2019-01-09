<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>MPSPK | Sijil Perakuan Vendor</title>

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>

</head>

<body>

<div class="container">

    <p>&nbsp;</p>

    <div class="text-center">

        <img class="w-25" src="{{public_path('mpspk.png')}}" alt="Logo MPSPK">

    </div>

    <p>&nbsp;</p>

    <h5 class="text-center">MAJLIS PERBANDARAN SUNGAI PETANI KEDAH</h5>

    <h6 class="text-center">AKUAN PENDAFTARAN VENDOR</h6>

    <p>&nbsp;</p>

    <table class="table table-sm table-borderless">

        <tbody>

        <tr>

            <th scope="row">NO. RUJUKAN PENDAFTARAN</th>
            <td>{{$vendor->mpspk_id}}</td>

        </tr>
        <tr>

            <th scope="row">TEMPOH KELAYAKAN</th>
            <td>
                {{date("d M Y", strtotime($vendor->mpspk_start))}} &ndash; {{date("d M Y", strtotime($vendor->mpspk_thru))}}</td>

        </tr>

        </tbody>

    </table>

    <p>Adalah dengan ini diperakui bahawa syarikat yang dinyatakan di bawah ini telah berdaftar dengan MAJLIS
        PERBANDARAN
        SUNGAI PETANI KEDAH dan layak untuk menyertai tawaran sebut harga / tender di MAJLIS PERBANDARAN SUNGAI PETANI
        KEDAH.</p>

    <p><strong><u>NAMA DAN ALAMAT BERDAFTAR</u></strong></p>

    <p>
        <strong>{{$vendor->name}}</strong><br>{{$vendor->address}}{!! $vendor->address1 !== null ? '<br>'.$vendor->address1 : '' !!}
        <br>{{$vendor->postcode}} {{$vendor->town}}
        <br>{{$vendor->state}}<br><strong>(NO.
            SYARIKAT: {{$vendor->ssm_id}})</strong></p>

    <p>&nbsp;</p>

    {{--<p>&nbsp;</p>--}}

    <p>t.t<br>(NAMA KETUA JABATAN)<br><strong>KETUA JABATAN KEJURUTERAAN</strong></p>

    <p class="text-center">
        <small>(Sijil ini adalah cetakan komputer dan tidak memerlukan tandatangan)</small>
    </p>

    <div class="page-break"></div>

    <p>&nbsp;</p>

    <table class="table table-sm table-borderless">

        <tbody>

        <tr>

            <td scope="row">NO. RUJUKAN PENDAFTARAN</td>
            <td>{{$vendor->mpspk_id}}</td>

        </tr>
        <tr>

            <td scope="row">TEMPOH KELAYAKAN</td>
            <td>
                {{date("d M Y", strtotime($vendor->mpspk_start))}} &ndash; {{date("d M Y", strtotime($vendor->mpspk_thru))}}</td>

        </tr>

        </tbody>

    </table>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>

</html>
