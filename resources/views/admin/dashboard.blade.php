@extends('admin.layouts.master')

@section('title', 'Yönetim Paneli | İstatistikler')

@push('css')
    <style>
        /* Daha modern bir görünüm için küçük dokunuşlar */
        .info-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }
        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
@endpush

@section('breadcrumb-title', 'Genel Bakış')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i> Anasayfa</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Aktif Oturumlar</span>
                    <span class="info-box-number text-lg">10 <small>%</small></span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Toplam Beğeni</span>
                    <span class="info-box-number text-lg">41,410</span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Aylık Satış</span>
                    <span class="info-box-number text-lg">760</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-plus text-white"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Yeni Üyeler</span>
                    <span class="info-box-number text-lg">2,000</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold">Son Aktiviteler</h3>
                        <a href="javascript:void(0);" class="text-primary text-sm">Tümünü Gör</a>
                    </div>
                </div>
                <div class="card-body">
                    <p>Dashboard ana verileriniz burada listelenecek. İsterseniz buraya bir grafik veya tablo ekleyebiliriz.</p>
                    <div class="alert alert-light border">
                        <i class="fas fa-info-circle text-info"></i> Bugün sisteme 50 yeni kayıt geldi.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-bolt text-warning"></i> Hızlı İşlemler</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#" class="btn btn-block btn-outline-primary btn-sm text-left">
                                <i class="fas fa-plus mr-2"></i> Yeni Ürün Ekle
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="btn btn-block btn-outline-secondary btn-sm text-left">
                                <i class="fas fa-envelope mr-2"></i> Mesajları Kontrol Et
                            </a>
                        </li>
                        <li class="list-group-item text-center">
                            <small class="text-muted">Son güncelleme: Az önce</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
