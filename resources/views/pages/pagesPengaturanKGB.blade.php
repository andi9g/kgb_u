@extends('layout.layoutAdmin')

@section('activekuBuku')
    activeku
@endsection

@section('judul')
    <i class="fa fa-book"></i> Data Buku
@endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Pengaturan KGB</h5>
            </div>
            <form action="{{ route('pengaturan.store') }}" method="post">
                @csrf
            
                <div class="card-body">
                    <div class='form-group'>
                        <label for='fortahunakhir' class='text-capitalize'>Max Tahun</label>
                        <input type='number' name='tahunakhir' id='fortahunakhir' class='form-control' value="{{$pkgb->tahunakhir}}" placeholder='masukan tahun'>
                    </div>
                    <div class='form-group'>
                        <label for='forpertahun' class='text-capitalize'>Per...Tahun</label>
                        <input type='number' name='pertahun' id='forpertahun' class='form-control' value="{{$pkgb->pertahun}}" placeholder='pertahun'>
                    </div>

                    
                </div> 
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update Data</button>
                </div>
            </form>
        </div>   

    </div>
</div>


@endsection