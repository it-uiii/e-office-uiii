<div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($services as $service)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $service->title }}</td>
            <td>{{ $service->category->name }}</td>
            <td>{{ $service->created_at }}</td>
            <td>{{ $service->updated_at }}</td>
            <td>
                <a class="btn btn-info" href="/services/{{ $service->slug }}"><i class="fas fa-eye"></i></a>
                @can('service-edit')
                <a class="btn btn-warning" href="/services/{{ $service->slug }}/edit"><i class="fas fa-pen"></i></a>    
                @endcan
                @can('service-delete')
                <form action="/services/{{ $service->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this service?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                @endcan
            </td>
        </tr>  
        @endforeach
        </tbody>
    </table>
</div>
