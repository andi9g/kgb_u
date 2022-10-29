@extends('layout.layoutAdmin')

@section('activekuhome')
    activeku
@endsection

@section('judul')
    <i class="fa fa-home"></i> Home
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
        
        <div class="info-box-content">
            <span class="info-box-text">Jumlah Pegawai</span>
            <span class="info-box-number">
            {{$pegawai}}
            </span>
        </div>
        <!-- /.info-box-content -->
        </div>

    </div>

    <div class="col-md-12">
        <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-line"></i></span>
        
        <div class="info-box-content">
            <span class="info-box-text">Proses KGB {{date('Y')}}</span>
            <span class="info-box-number">
            {{$kgb}}
            </span>
        </div>
        <!-- /.info-box-content -->
        </div>

    </div>
</div>

@endsection