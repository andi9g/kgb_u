@extends('layout.layoutAdmin')

@section('activekuadmin')
    activeku
@endsection

@section('judul')
    <i class="fa fa-user"></i> Data Admin
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambah_admin">
            Tambah admin
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="tambah_admin" tabindex="-1" aria-labelledby="tambah_adminLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="tambah_adminLabel">Form admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('admin.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class='form-group'>
                            <label for='forusername' class='text-capitalize'>username</label>
                            <input type='text' name='username' id='forusername' class='form-control form-control-sm' placeholder='masukan username'>
                        </div>
                        <div class='form-group'>
                            <label for='fornama' class='text-capitalize'>nama</label>
                            <input type='text' name='nama' id='fornama' class='form-control form-control-sm' placeholder='masukan nama'>
                        </div>
                        <div class='form-group'>
                            <label for='forpassword' class='text-capitalize'>Password</label>
                            <input type='password' name='password' id='forpassword' class='form-control form-control-sm' placeholder='masukan password'>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah admin</button>
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
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admin as $item)
                        <tr>
                            <td width="5px">{{$loop->iteration + $admin->firstItem() - 1}}</td>
                            <td class="text-capitalize">{{$item->nama}}</td>
                            <td class="text-capitalize">{{$item->username}}</td>
                            <td nowrap>
                                <!-- Button trigger modal -->
                                <button type="button" class="badge badge-primary badge-btn border-0 d-inline" data-toggle="modal" data-target="#ubahadmin{{$item->idadmin}}">
                                  <i class="fa fa-edit"></i> Ubah
                                </button>

                                <form action="{{ route('admin.destroy', [$item->idadmin]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge badge-danger badge-btn border-0"><i class="fa fa-trash"></i></button>
                                </form>
                                
                                <!-- Modal -->
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="ubahadmin{{$item->idadmin}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Data : {{$item->nama}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form action="{{ route('admin.update', [$item->idadmin]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class='form-group'>
                                                <label for='forusername' class='text-capitalize'>username</label>
                                                <input type='text' name='username' id='forusername' disabled class='form-control form-control-sm' value="{{$item->username}}" placeholder='masukan username'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='fornama' class='text-capitalize'>nama</label>
                                                <input type='text' name='nama' id='fornama' class='form-control form-control-sm' value="{{$item->nama}}" placeholder='masukan nama'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='forpassword' class='text-capitalize'>Password</label>
                                                <input type='password' name='password' id='forpassword' class='form-control form-control-sm' required placeholder='masukan password'>
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