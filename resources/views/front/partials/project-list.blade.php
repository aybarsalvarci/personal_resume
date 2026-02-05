@foreach($projects as $project)
    <div class="col-lg-6" data-aos="fade-up">
        <div class="project-card">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="card-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    <i class="{{$project['icon']}}"></i>
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="text-primary" title="GitHub"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-primary" title="Canlı Demo"><i
                            class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
            <div class="mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded me-2">
                                <i class="fas fa-circle" style="font-size: 0.5rem;"></i> Tamamlandı
                            </span>
            </div>
            <h3 class="project-title">{{$project->name}}</h3>
            <p class="project-description mb-4">
                Backend geliştirme becerilerimi geliştirmek için oluşturduğum kapsamlı e-commerce projesi.
                JWT authentication, role-based authorization, product management, order processing ve
                database design konularında pratik yaptım. Clean architecture prensipleri ile geliştirildi.
            </p>
            <div class="mb-3">
                <h6 class="text-secondary mb-2 small fw-semibold">Özellikler:</h6>
                <ul class="list-unstyled small text-secondary mb-0">
                    <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>JWT Authentication
                        & Authorization
                    </li>
                    <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>RESTful API Design
                    </li>
                    <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Database Relations
                        & Migrations
                    </li>
                    <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Docker
                        Containerization
                    </li>
                </ul>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="tech-tag">Laravel 10</span>
                <span class="tech-tag">JWT</span>
                <span class="tech-tag">MySQL</span>
                <span class="tech-tag">Docker</span>
                <span class="tech-tag">REST API</span>
            </div>
        </div>
    </div>
@endforeach
