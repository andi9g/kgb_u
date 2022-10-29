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

    <table class="tb" style="border-collapse: collapse;font-size: 9pt" width="100%">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama / Nip</th>
            <th rowspan="2">TMT SK CPNS</th>
            <th colspan="{{$selisih+1}}">TAHUN</th>
        </tr>
        <tr>
            @for ($i = $tahun_awal; $i <= $tahun_akhir;$i++)
            <th>{{$i}}</th>
            @endfor
        </tr>

        @foreach ($pegawai as $item)
            <tr>
                <td align="center">{{$loop->iteration}}</td>
                <td>{{ucwords($item->nama)}} <br> {{ucwords($item->nik)}}</td>
                <td>{{\Carbon\Carbon::parse($item->skcpns)->isoFormat('dddd, D MMMM Y')}}</td>
                
                @php
                    $n = 0;
                    $pertahun = $pkgb->pertahun;
                    $tahun_mulai = (int) date('Y', strtotime("+".$pertahun." years", strtotime($item->skcpns)))
                @endphp
                @for ($i = $tahun_awal; $i <= $tahun_akhir;$i++)
                    @if ($i >= $tahun_mulai)
                        @if ($n % $pertahun == 0)
                            @php
                                $tanggalkgb = $i."-".date('m-d', strtotime($item->skcpns));
                                $cek = DB::table('kgb')->where('nik', $item->nik)->where('tanggalkgb', $tanggalkgb)->count();
                            @endphp
                            @if ($cek == 1)
                                <td style="background: rgb(156, 255, 156)">
                                    {{\Carbon\Carbon::parse($tanggalkgb)->isoFormat('dddd,')}}<br>
                                    {{\Carbon\Carbon::parse($tanggalkgb)->isoFormat('D MMM Y')}}
                                </td>
                            @else 
                            <td style="background: rgb(255, 158, 158)">
                                {{\Carbon\Carbon::parse($tanggalkgb)->isoFormat('dddd,')}}<br>
                                {{\Carbon\Carbon::parse($tanggalkgb)->isoFormat('D MMM Y')}}
                            </td>
                            @endif
                        @else
                            <td></td>  
                        @endif
                        
                    @php
                        $n++;
                    @endphp
                    @else
                    <td></td>

                    @endif
                @endfor
            </tr>
        @endforeach
    </table>

    <br>

    <table width="100%">
        <tr>
            <td></td>
            <td width="50%">
                KETERANGAN : 
                <table width="100%">
                    <tr>
                        <td width="40%" style="background: rgb(156, 255, 156)"></td>
                        <td> : SUDAH TEREALISASI</td>
                    </tr>
                    <tr>
                        <td style="background: rgb(255, 158, 158)"></td>
                        <td> : BELUM TEREALISASI</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

