<table class="table table-hover table-striped text-nowrap text-center">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Thumbnail</th>
            <th>Blog Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <img class="img-fluid" src="{{ $data->thumb }}" width="40" alt="Product Image">
                </td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->category->title }}</td>
                <td>
                    @if ($data->status == 1)
                        <span class="badge badge-pill badge-success">Published</span>
                    @else
                        <span class="badge badge-pill badge-danger">Drift</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                            data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="#" target="_blank">
                                <i class="fas fa-tag mr-1"></i>
                                Inspect
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.admin.edit.blog', $data->id) }}">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.admin.delete.blog', $data->id) }}"
                                onclick="return confirm('Are you sure ?')">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="col-md-12">
    {{ $blogs->links() }}
</div>
