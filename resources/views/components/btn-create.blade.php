<div>
    <!-- An unexamined life is not worth living. - Socrates -->

    @php
        $create = 'Create.' . Str::ucfirst($route);
    @endphp
    <div class="d-flex">
        <div class="top-addon ms-auto">
            <button class="btn btn-primary px-2" onclick="window.location='/{{ $route }}'"><i class='bx bx-refresh'></i></button>
            @can($create)
                <button class="btn btn-success" onclick="window.location='/{{ $route }}/create'">Create</button>
            @endcan
        </div>
    </div>
</div>
