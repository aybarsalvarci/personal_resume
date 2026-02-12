@extends('admin.layouts.master')

@section('title', 'Anasayfa İçerik Yönetimi')

@push('css')
    <style>
        .form-control {
            background-color: #2d3244;
            border: 1px solid #3f475e;
            color: #fff;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #32374a;
            color: #fff;
            border-color: #6366f1;
            box-shadow: none;
        }

        .is-invalid {
            border-color: #ff4d4d !important;
        }

        .invalid-feedback {
            color: #ff4d4d;
            font-size: 0.85rem;
            display: block;
            margin-top: 5px;
            font-weight: 500;
        }

        .admin-tab-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .admin-tab-item {
            background-color: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            color: #a0aec0;
            padding: 14px 18px;
            text-align: left;
            transition: all 0.25s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            width: 100%;
            outline: none !important;
        }

        .admin-tab-item.active {
            background-color: rgba(99, 102, 241, 0.15) !important;
            color: #818cf8 !important;
            border-color: #6366f1 !important;
            font-weight: 600;
        }

        .section-divider {
            border-bottom: 1px solid #2d3244;
            margin: 25px 0 15px 0;
            color: #6366f1;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        .btn-save-custom {
            background: linear-gradient(45deg, #4f46e5, #6366f1);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: bold;
        }

        .repeater-item {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid #2d3244;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .card-custom {
            background-color: #1a1e2b;
            border: 1px solid #2d3244;
            border-radius: 12px;
        }

        .input-group-text {
            background-color: #3f475e;
            border: none;
            color: #a0aec0;
        }
    </style>
@endpush

@section('content')
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{route('admin.homepage.update', $homepage->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-custom shadow-lg sticky-top" style="top: 20px;">
                    <div class="card-body p-3">
                        <div class="admin-tab-menu">
                            <button class="admin-tab-item active" data-target="#hero" type="button"><i
                                    class="fas fa-terminal mr-2"></i> Hero
                            </button>
                            <button class="admin-tab-item" data-target="#about" type="button"><i
                                    class="fas fa-user mr-2"></i> Hakkımda Metinleri
                            </button>
                            <button class="admin-tab-item" data-target="#stats" type="button"><i
                                    class="fas fa-chart-line mr-2"></i> İstatistikler
                            </button>
                            <button class="admin-tab-item" data-target="#technical" type="button"><i
                                    class="fas fa-code mr-2"></i> Yetkinlikler
                            </button>
                            <button class="admin-tab-item" data-target="#principles" type="button"><i
                                    class="fas fa-brain mr-2"></i> Prensipler & Setup
                            </button>
                        </div>
                        <hr style="border-top: 1px solid #2d3244;">
                        <button type="submit" class="btn btn-save-custom btn-block mt-2"><i
                                class="fas fa-save mr-2"></i> Tümünü Kaydet
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="tab-content border-0">

                    <div class="tab-pane fade show active" id="hero">
                        <div class="card card-custom shadow-lg">
                            <div class="card-body p-4">
                                <h4 class="text-white mb-4">Giriş Alanı & Sosyal Medya</h4>
                                <div class="section-divider">Ana Metinler</div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-white-50 small">Badge Metni</label>
                                        <input type="text" name="hero_badge" class="form-control"
                                               value="{{ old('hero_badge', $homepage->hero_badge) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-white-50 small">Alt Başlık (Unvan)</label>
                                        <input type="text" name="hero_subtitle" class="form-control"
                                               value="{{ old('hero_subtitle', $homepage->hero_subtitle) }}">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small">Ana Başlık (HTML Destekli)</label>
                                    <input type="text" name="hero_title" class="form-control"
                                           value="{{ old('hero_title', $homepage->hero_title) }}">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small">Kısa Açıklama (Hero Description)</label>
                                    <textarea name="hero_description" class="form-control"
                                              rows="3">{{ old('hero_description', $homepage->hero_description) }}</textarea>
                                </div>

                                <div class="section-divider">Terminal Satırları</div>
                                <div id="terminal-repeater">
                                    @foreach($homepage->hero_terminal as $index => $cmd)
                                        <div class="repeater-item d-flex align-items-start mb-2">
                                            <div class="flex-grow-1">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span
                                                            class="input-group-text">➜</span></div>
                                                    <input type="text" name="term_cmd[]" class="form-control"
                                                           value="{{ $index }}" placeholder="Komut">
                                                </div>
                                                <input type="text" name="term_out[]" class="form-control mt-2"
                                                       value="{{ $cmd }}" placeholder="Çıktı">
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm ml-2 remove-btn">
                                                <i class="fas fa-trash"></i></button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                        onclick="addRepeater('#terminal-repeater')">+ Komut Ekle
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="about">
                        <div class="card card-custom p-4 shadow-lg">
                            <h4 class="text-white mb-4"><i class="fas fa-user-edit text-primary mr-2"></i> Hakkımda
                                Bölümü Yönetimi</h4>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="text-white-50 small text-uppercase">Bölüm Alt Başlığı</label>
                                    <input type="text" name="about_subtitle" class="form-control"
                                           value="{{ old('about_subtitle', $homepage->about->subtitle) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="section-divider">Sol Kart: Öğrenme Yolculuğum</div>
                                    <div class="form-group mb-3">
                                        <label class="text-white-50 small text-uppercase">Açıklama Metni</label>
                                        <textarea name="about_learning" class="form-control"
                                                  rows="5">{{ old('about_learning', $homepage->about->left->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white-50 small text-uppercase">Alt Etiketler (Virgülle
                                            Ayırın)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fas fa-tags"></i></span></div>
                                            <input type="text" name="about_learning_tags" class="form-control"
                                                   value="{{ old('about_learning_tags', $homepage->about->left->tags) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="section-divider">Sağ Kart: Teknik Yetkinlikler</div>
                                    <div class="form-group mb-3">
                                        <label class="text-white-50 small text-uppercase">Kısa Giriş Metni</label>
                                        <textarea name="about_technical_desc" class="form-control"
                                                  rows="2">{{ old('about_technical_desc', $homepage->about->right->description) }}</textarea>
                                    </div>

                                    <label class="text-white-50 small text-uppercase">Liste Maddeleri (Her Satıra Bir
                                        Madde)</label>
                                    <div id="about-skills-repeater">
                                        @foreach($homepage->about->right->list as $index => $skill)
                                            <div class="repeater-item d-flex mb-2">
                                                <input type="text" name="about_skills_list[]" class="form-control"
                                                       value="{{ $skill }}">
                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm ml-2 remove-btn"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                            onclick="addRepeater('#about-skills-repeater')">
                                        <i class="fas fa-plus mr-1"></i> Madde Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="stats">
                        <div class="card card-custom p-4 shadow-lg">
                            <h4 class="text-white mb-4">İstatistik Sayaçları</h4>
                            <div id="stats-repeater" class="row">
                                @foreach($homepage->stats as $index => $label)
                                    <div class="col-md-6 repeater-item-container">
                                        <div class="repeater-item">
                                            <div class="d-flex justify-content-between mb-2">
                                                <label class="text-primary small fw-bold">Sayaç Kartı</label>
                                                <button type="button" class="btn btn-link text-danger p-0 remove-btn"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                            <input type="text" name="stat_val[]" value="{{ $label ?? '' }}"
                                                   class="form-control mb-2" placeholder="Değer (15+)">
                                            <input type="text" name="stat_label[]" value="{{ $index }}"
                                                   class="form-control" placeholder="Etiket (Projeler)">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                    onclick="addRepeater('#stats-repeater', true)">+ Sayaç Ekle
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="technical">
                        <div class="card card-custom p-4 shadow-lg">
                            <h4 class="text-white mb-4">Uzmanlık Grupları</h4>
                            <div id="tech-repeater">
                                @foreach($homepage->techs as $index => $t)
                                    <div class="repeater-item mb-4" style="border-left: 3px solid #6366f1;">
                                        <div class="d-flex justify-content-between mb-3 align-items-center">
                                            <span
                                                class="badge badge-primary px-3 py-2">Grup #{{ $loop->iteration }}</span>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-btn"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 form-group"><label class="small">İkon
                                                    (FA)</label><input type="text" name="tech_icon[]"
                                                                       class="form-control" value="{{ $t->icon }}">
                                            </div>
                                            <div class="col-md-8 form-group"><label class="small">Başlık</label><input
                                                    type="text" name="tech_title[]" class="form-control"
                                                    value="{{ $t->title }}"></div>
                                            <div class="col-12 form-group"><label
                                                    class="small">Açıklama</label><textarea name="tech_description[]"
                                                                                            class="form-control"
                                                                                            rows="2">{{ $t->description }}</textarea>
                                            </div>
                                            <div class="col-12 form-group"><label class="small">Teknolojiler
                                                    (Virgülle)</label><input type="text" name="tech_tags[]"
                                                                             class="form-control"
                                                                             value="{{ $t->tags }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                    onclick="addRepeater('#tech-repeater')">+ Grup Ekle
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="principles">
                        <div class="card card-custom p-4 shadow-lg mb-4">
                            <h4 class="text-white mb-4">Mühendislik Prensipleri</h4>
                            <div id="principle-repeater">
                                @foreach($homepage->principles as $p)
                                    <div class="repeater-item d-flex align-items-center mb-2">
                                        <input type="text" name="principles[]" value="{{ $p }}"
                                               class="form-control mr-2">
                                        <button type="button" class="btn btn-outline-danger btn-sm ml-2 remove-btn"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="addRepeater('#principle-repeater')">+ Madde Ekle
                            </button>
                        </div>

                        <div class="card card-custom p-4 shadow-lg">
                            <h4 class="text-white mb-4">Development Setup</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-white-50 small">İşletim Sistemi</label>
                                    <input type="text" name="setup_os" class="form-control"
                                           value="{{ old('setup_os', $homepage->setup->os) }}"
                                           placeholder="Linux / Windows">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-white-50 small">Code Editor</label>
                                    <input type="text" name="setup_editor" class="form-control"
                                           value="{{ old('setup_editor', $homepage->setup->editor) }}"
                                           placeholder="VS Code">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-white-50 small">Terminal</label>
                                    <input type="text" name="setup_terminal" class="form-control"
                                           value="{{ old('setup_terminal', $homepage->setup->terminal) }}"
                                           placeholder="Bash / PowerShell">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-white-50 small">Database Tools</label>
                                    <input type="text" name="setup_db" class="form-control"
                                           value="{{ old('setup_db', $homepage->setup->db) }}" placeholder="DBeaver">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-white-50 small">Containerization Tools</label>
                                    <input type="text" name="setup_db" class="form-control"
                                           value="{{ old('setup_containerization', $homepage->setup->containerization) }}"
                                           placeholder="Docker">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.admin-tab-item').on('click', function() {
                $('.admin-tab-item').removeClass('active'); $(this).addClass('active');
                let target = $(this).data('target');
                $('.tab-pane').removeClass('show active'); $(target).addClass('show active');
            });

            $(document).on('click', '.remove-btn', function() {
                let item = $(this).closest('.repeater-item-container').length ? $(this).closest('.repeater-item-container') : $(this).closest('.repeater-item');
                if(item.parent().children().length > 1) item.fadeOut(200, function() { $(this).remove(); });
            });
        });

        function addRepeater(containerId, isGrid = false) {
            let selector = isGrid ? '.repeater-item-container:first' : '.repeater-item:first';
            let clone = $(containerId).find(selector).first().clone();
            clone.find('input, textarea').val('').removeClass('is-invalid');
            clone.find('.invalid-feedback').remove();
            clone.hide().appendTo(containerId).fadeIn(300);
        }
    </script>
@endpush
