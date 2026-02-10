<div class="project-card h-100" data-aos="fade-up">
    <div class="project-image-box">
        @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" class="project-main-img" alt="{{$project->name}}">
        @else
            <div class="project-img-placeholder">
                <i class="{{ $project->icon }} opacity-25"></i>
            </div>
        @endif

        <div class="badge-overlay-top">
            <span class="glass-tag">
                <i class="fas fa-tag"></i> {{ $project->category->name }}
            </span>
        </div>

        <div class="action-overlay">
            <a href="{{ $project->github_url }}" target="_blank" class="glass-btn" title="GitHub"><i class="fab fa-github"></i></a>
            <a href="{{ $project->demo_url }}" target="_blank" class="glass-btn" title="Live"><i class="fas fa-external-link-alt"></i></a>
        </div>

        <div class="floating-project-icon">
            <i class="{{$project->icon}}"></i>
        </div>
    </div>

    <div class="project-body">
        <div class="status-box mb-3">
            @switch($project->status)
                @case('completed')
                    <span class="status-chip success"><span class="pulse"></span> Tamamlandı</span> @break
                @case('in-progress')
                    <span class="status-chip warning"><span class="pulse"></span> Devam Ediyor</span> @break
                @case('upcoming')
                    <span class="status-chip info"><span class="pulse"></span> Yakında</span> @break
            @endswitch
        </div>

        <h3 class="project-title-new">{{$project->name}}</h3>

        <p class="project-desc-new">
            {{ str(strip_tags($project->description))->limit(110) }}
        </p>

        <div class="tech-stack-new mt-auto">
            @foreach(explode(',', $project->keys) as $key)
                <span class="tech-pill">{{trim($key)}}</span>
            @endforeach
        </div>
    </div>
</div>
