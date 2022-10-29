<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan KGB Keseluruhan</title>
    <style>
        h3 {
            padding: 0;
            margin: 0;
        }
        .tb tr td {
            padding: 3px;
            border: 1px solid black;
        }
        .tb tr th {
            padding: 3px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table width="100%" style="text-align: center;border-bottom: 2px solid black">
        <tr>
            <td><h3>DAFTAR KENAIKAN GAJI BERKALA (KGB) PER TAHUN 
            </h3></td>
        </tr>
        <tr>
            <td><h3>BADAN KEPEGAWAIAN DAERAH DAN KORPRI  
            </h3></td>
        </tr>
        <tr>
            <td><h3>PROVINSI KEPULAUAN RIAU  
            </h3></td>
        </tr>
    </table>
    <br>

    <table>
        <tr>
            <th align="left">Nama</th>
            <td> : </td>
            <td>{{ucwords($pegawai->nama)}}</td>
        </tr>
        <tr>
            <th align="left">NIK</th>
            <td> : </td>
            <td>{{$pegawai->nik}}</td>
        </tr>
        <tr>
            <th align="left">TMT SK CPNS</th>
            <td> : </td>
            <td>{{\Carbon\Carbon::parse($pegawai->skcpns)->isoFormat('dddd, D MMMM Y')}}</td>
        </tr>
    </table>

    <br>

    @php
        $tahunmulai = date('Y-m-d', strtotime($pegawai->skcpns));
        $pertahun = $pkgb->pertahun;
        $tahun = (int)date('Y', strtotime("+".$pertahun." year", strtotime($pegawai->skcpns)));
        $tahun_sekarang = $pkgb->tahunakhir;
    @endphp
    <table class="tb" style="border-collapse: collapse; border:1px solid black" width="60%">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Tanggal KGB</th>
            </tr>
        </thead>
        <tbody>
            @php
                $n = 0;
            @endphp
            @for ($i = $tahun;$i<=$tahun_sekarang;$i++)
                <tr>
                    <td align="center" width="40%">{{$i}}</td>
                @if ($n % $pertahun == 0)
                    @php
                        $tanggalKGB = $i."-".date('m-d', strtotime($pegawai->skcpns));
                        $kgb = DB::table('kgb')->where('nik', $pegawai->nik)->where('tanggalkgb', $tanggalKGB)->count();
                    @endphp
                    @if ($kgb == 1)
                        <td style="background: rgb(156, 255, 156)">
                            {{\Carbon\Carbon::parse($tanggalKGB)->isoFormat('dddd, D MMMM Y')}}
                        </td>
                        @else 
                        <td style="background: rgb(255, 158, 158)">
                            {{\Carbon\Carbon::parse($tanggalKGB)->isoFormat('dddd, D MMMM Y')}}
                        </td>
                    @endif
                @else
                    <td>-</td>
                @endif  

                </tr>
                @php
                    $n++;
                @endphp
            @endfor

        </tbody>
    </table>

    <br>

    <table width="80%">
        <tr>
            <td rowspan="10"></td>
            <td colspan="2">KETERANGAN :</td>
        </tr>
        <tr>
            <td width="45%" style="background: rgb(156, 255, 156)"></td>
            <td> : SUDAH TEREALISASI</td>
        </tr>
        <tr>
            <td style="background: rgb(255, 158, 158)"></td>
            <td> : BELUM TEREALISASI</td>
        </tr>
        </tr>
    </table>
</body>
</html>

