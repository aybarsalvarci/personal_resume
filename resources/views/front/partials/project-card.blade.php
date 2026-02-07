<div class="project-card">
    <div class="d-flex align-items-start justify-content-between mb-3">
        <div class="card-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
            <i class="{{$project->icon}}"></i>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ $project->github_url ?? '#' }}" class="text-primary" title="GitHub"><i class="fab fa-github"></i></a>
            <a href="{{ $project->demo_url ?? '#' }}" class="text-primary" title="Canlı Demo"><i class="fas fa-external-link-alt"></i></a>
        </div>
    </div>

    <div class="mb-2 d-flex flex-wrap gap-2">
        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded">
            <i class="fas fa-tag me-1" style="font-size: 0.5rem;"></i> {{ $project->category->name }}
        </span>

        @switch($project->status)
            @case('completed')
                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded">
                    <i class="fas fa-check-circle me-1" style="font-size: 0.5rem;"></i> Tamamlandı
                </span>
                @break

            @case('in-progress')
                <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded">
                    <i class="fas fa-spinner fa-spin me-1" style="font-size: 0.5rem;"></i> Devam Ediyor
                </span>
                @break

            @case('upcoming')
                <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded">
                    <i class="fas fa-calendar-alt me-1" style="font-size: 0.5rem;"></i> Yakında
                </span>
                @break

            @default
                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded">
                    <i class="fas fa-question-circle me-1" style="font-size: 0.5rem;"></i> Planlandı
                </span>
        @endswitch
    </div>

    <h3 class="project-title">{{$project->name}}</h3>

    <p class="project-description mb-4">
        {!! $project->description !!}
    </p>

    <div class="d-flex flex-wrap gap-2 mt-auto">
        @foreach(explode(',', $project->keys) as $key)
            <span class="tech-tag">{{trim($key)}}</span>
        @endforeach
    </div>
</div>
