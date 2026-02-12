@extends('admin.layouts.master')

@section('title', 'Yönetim Paneli | İstatistikler')

@push('css')
    <style>
        .info-box {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: none;
        }
        .info-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .card {
            border-radius: 15px;
            border: none;
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .btn-action {
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }
        .btn-action:hover {
            background-color: #f8f9fa;
            padding-left: 15px;
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
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Toplam Proje</span>
                    <span class="info-box-number text-lg">12</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-pen-nib"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Blog Yazıları</span>
                    <span class="info-box-number text-lg">45</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-envelope text-white"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Yeni Mesajlar</span>
                    <span class="info-box-number text-lg">3</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-eye"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Görüntülenme</span>
                    <span class="info-box-number text-lg">1,250</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-list mr-1"></i> Son İçerikler
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Kategori</th>
                                <th>Tarih</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Laravel Dashboard Tasarımı</td>
                                <td><span class="badge badge-info">Blog</span></td>
                                <td>12 Şubat 2026</td>
                                <td><a href="#" class="text-muted"><i class="fas fa-search"></i></a></td>
                            </tr>
                            <tr>
                                <td>E-Ticaret Arayüz Çalışması</td>
                                <td><span class="badge badge-primary">Proje</span></td>
                                <td>10 Şubat 2026</td>
                                <td><a href="#" class="text-muted"><i class="fas fa-search"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center bg-white">
                    <a href="{{ route('admin.blogs.index') }}" class="text-sm font-weight-bold">Tümünü Yönet <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-bolt text-warning mr-2"></i> Hızlı İşlemler</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-block btn-outline-info btn-action text-left">
                        <i class="fas fa-plus-circle mr-2"></i> Yeni Blog Yazısı
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-block btn-outline-primary btn-action text-left">
                        <i class="fas fa-folder-plus mr-2"></i> Yeni Proje Ekle
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-block btn-outline-secondary btn-action text-left">
                        <i class="fas fa-sliders-h mr-2"></i> Site Ayarlarını Düzenle
                    </a>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('js')
@endpush
