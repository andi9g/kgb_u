@extends('layout.layoutAdmin')

@section('activekukgb')
    activeku
@endsection

@section('judul')
    <i class="fa fa-chart-line"></i> Kenaikan Gaji Berkala
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <a href="{{ route('cetak.kgb.keseluruhan') }}" target="_blank" class="btn btn-secondary my-2">
            <i class="fa fa-print"></i> Cetak KGB
        </a>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}" class="form-inline justify-content-end">
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
            
        </form>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl. SK CPNS</th>
                        <th>Data KGB</th>
                        <th>Cetak Satuan</th>
                        <th>Proses KGB</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pegawai as $item)
                    
                        <tr>
                            <td>{{$loop->iteration + $pegawai->firstItem() - 1}}</td>
                            <td class="text-bold">{{$item->nik}}</td>
                            <td class="text-capitalize">{{$item->nama}}</td>
                            <td>{{date('d F Y', strtotime($item->skcpns))}}</td>
                            <td nowrap>

                                <button type="button" class="badge badge-primary badge-btn border-0 d-inline" data-toggle="modal" data-target="#lihatpegawai{{$item->idpegawai}}">
                                  <i class="fa fa-eye"></i> Lihat KGB
                                </button>

                                <form action="{{ route('normalkan.kgb', [$item->nik]) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Lanjutkan proses?')" class="badge badge-btn badge-warning border-0">
                                        <b>Normalkan</b>
                                    </button>
                                </form>

                            </td>
                            <td>
                                <a href="{{ route('cetak.kgb.satuan', [$item->nik]) }}" class="badge badge-btn badge-secondary border-0" target="_blank">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            </td>
                            <td nowrap>
                                @php
                                    $tanggalkgbberikutnya = date('Y')."-".date('m-d', strtotime($item->skcpns));
                                    $tanggalsekarang = date('Y-m-d');
                                    $cek = DB::table('kgb')->where('nik', $item->nik)->whereBetween('tanggalkgb', [$item->skcpns,$tanggalkgbberikutnya])->count();

                                    $tahunkgb = date('Y', strtotime($item->skcpns));
                                    $tahun = (int) ($pkgb->tahunakhir);
                                    $datakgb = [];
                                    for ($i=$tahunkgb; $i <=(int) ($pkgb->tahunakhir) ; $i=$i+$pkgb->pertahun) { 
                                        $datakgb[] = $i."-".date('m-d',strtotime($item->skcpns));
                                    }
                                    
                                @endphp

                                @if ($cek == 0 && in_array($tanggalkgbberikutnya, $datakgb))
                                    <form action="{{ route('proses.kgb', [$item->nik,$tanggalkgbberikutnya]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" onclick="return confirm('lanjutkan proses KGB?')" class="badge badge-danger w-100 badge-btn border-0 text-bold">Proses KGB</button>
                                    </form>
                                @else
                                    <small class="badge badge-success">Telah melakukan KGB</small>
                                @endif
                            </td>
                        </tr>


                        
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>    


    @foreach ($pegawai as $item)
    <div class="modal fade" id="lihatpegawai{{$item->idpegawai}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data KGB {{ucwords($item->nama)}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @php
                        $tahunmulai = date('Y-m-d', strtotime($item->skcpns));
                        $pertahun = $pkgb->pertahun;
                        $tahun = (int)date('Y', strtotime("+".$pertahun." year", strtotime($item->skcpns)));
                        $tahun_sekarang = (int) ($pkgb->tahunakhir);
                    @endphp
                    <table class="table table-sm table-striped table-bordered">
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
                                    <td>{{$i}}</td>
                                @if ($n % $pertahun == 0)
                                    @php
                                        $tanggalKGB = $i."-".date('m-d', strtotime($item->skcpns));
                                        $kgb = DB::table('kgb')->where('nik', $item->nik)->where('tanggalkgb', $tanggalKGB)->count();
                                    @endphp
                                    @if ($kgb == 1)
                                        <td class="bg-success">{{date("d F Y", strtotime($tanggalKGB))}}</td>
                                        @else 
                                        <td class="bg-danger">{{date("d F Y", strtotime($tanggalKGB))}}</td>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection