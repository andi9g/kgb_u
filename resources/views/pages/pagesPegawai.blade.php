@extends('layout.layoutAdmin')

@section('activekupegawai')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> Data pegawai
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambah_pegawai">
            Tambah Pegawai
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="tambah_pegawai" tabindex="-1" aria-labelledby="tambah_pegawaiLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="tambah_pegawaiLabel">Form Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('pegawai.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class='form-group'>
                            <label for='fornik' class='text-capitalize'>NIK</label>
                            <input type='number' name='nik' id='fornik' class='form-control form-control-sm' placeholder='masukan nik'>
                        </div>
                        <div class='form-group'>
                            <label for='fornama' class='text-capitalize'>nama</label>
                            <input type='text' name='nama' id='fornama' class='form-control form-control-sm' placeholder='masukan nama'>
                        </div>
                        <div class='form-group'>
                            <label for='forjk' class='text-capitalize'>Jenis kelamin</label>
                            <select name='jk' required id='forjk' class='form-control form-control-sm'>
                                <option value=''>Jenis Kelamin</option>
                                <option value='l'>Laki-laki</option>
                                <option value='p'>Perempuan</option>
                            <select>
                        </div>
                        <div class='form-group'>
                            <label for='forskcpns' class='text-capitalize'>TMT.SK CPNS</label>
                            <input type='date' name='skcpns' id='forskcpns' class='form-control form-control-sm' placeholder='masukan tanggal yang ada pada sk cpns'>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
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
                        <th>Jenis Kelamin</th>
                        <th>Tgl. SK CPNS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pegawai as $item)
                        <tr>
                            <td>{{$loop->iteration + $pegawai->firstItem() - 1}}</td>
                            <td class="text-bold">{{$item->nik}}</td>
                            <td class="text-capitalize">{{$item->nama}}</td>
                            <td>{{($item->jk=='l')?'Laki-laki':'Perempuan'}}</td>
                            <td>{{date('d F Y', strtotime($item->skcpns))}}</td>
                            <td nowrap>
                                <form action="{{ route('pegawai.destroy', [$item->idpegawai]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge badge-btn badge-danger border-0"><i class="fa fa-trash"></i></button>
                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="badge badge-primary badge-btn border-0" data-toggle="modal" data-target="#ubahpegawai{{$item->idpegawai}}">
                                  <i class="fa fa-edit"></i>
                                </button>
                                
                            </td>
                        </tr>


                        <div class="modal fade" id="ubahpegawai{{$item->idpegawai}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah Data {{ucwords($item->nama)}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form action="{{ route('pegawai.update', [$item->idpegawai]) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                    
                                        <div class="modal-body">
                                            <div class='form-group'>
                                                <label for='fornik' class='text-capitalize'>NIK</label>
                                                <input type='number' value="{{$item->nik}}" name='nik' disabled id='fornik' class='form-control form-control-sm text-bold text-capitalize' placeholder='masukan nik'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='fornama' class=''>nama</label>
                                                <input type='text' value="{{$item->nama}}" name='nama' id='fornama' class='form-control form-control-sm text-capitalize' placeholder='masukan nama'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='forjk' class='text-capitalize'>Jenis kelamin</label>
                                                <select name='jk' required id='forjk' class='form-control form-control-sm'>
                                                    <option value=''>Jenis Kelamin</option>
                                                    <option value='l' @if ($item->jk == 'l')
                                                        selected
                                                    @endif>Laki-laki</option>
                                                    <option value='p' @if ($item->jk == 'p')
                                                        selected
                                                    @endif>Perempuan</option>
                                                <select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='forskcpns' class='text-capitalize'>TMT.SK CPNS</label>
                                                <input type='date' value="{{$item->skcpns}}" name='skcpns' id='forskcpns' class='form-control form-control-sm' placeholder='masukan tanggal yang ada pada sk cpns'>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>    


@endsection