<ul class="list-group">
        <p>{{ $user->email }}</p>
        <a href="{{ route('projects.create') }}">Adicionar Projeto</a>
        @foreach ($projects as $project)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <p>{{ $project->name }}</p>
        </li>
    @endforeach
</ul>
