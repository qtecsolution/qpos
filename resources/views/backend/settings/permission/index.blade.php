@extends('backend.master')

@section('title', 'Permissions')

@section('content')
<div class="card">

    @can('role_view')
    <div class="mt-n5 mb-3 d-flex justify-content-end">
        <a href="{{ route('backend.admin.roles') }}" class="btn bg-gradient-primary">
            <i class="fas fa-ruler-vertical"></i>
            Roles
        </a>
    </div>
    @endcan
    <div class="card-body">
        <div class="row">
            <!-- @if (env('APP_ENV') == 'local')
                    <div class="col-md-12">
                        <fieldset>
                            <form action="{{ route('backend.admin.permissions.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Enter permission name" name="name"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-control" id="floatingSelectGrid" name="type" required>
                                                <option value="">-- Select a type --</option>
                                                <option value="1">Normal</option>
                                                <option value="2">Resource</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn bg-gradient-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                        <hr>
                    </div>
                @endif -->

            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>

                            <!-- @if (env('APP_ENV') == 'local')
                                    <th class="text-center">Actions</th>
                                @endif -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $data)
                        <tr>
                            <td>{{ snakeToTitle($data->name) }}</td>
                            <td>{{ $data->name }}</td>

                            <!-- @if (env('APP_ENV') == 'local')
                                        <td>
                                            <div class="text-center">
                                                <button title="Edit permission" type="button" class="btn bg-gradient-primary btn-xs"
                                                    data-toggle="modal" data-target="#editpermission-{{ $data->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <a title="Delete permission"
                                                    href="{{ route('backend.admin.permissions.delete', $data->id) }}"
                                                    type="button" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Are you sure ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            <div class="modal fade" id="editpermission-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    {!! Form::open(['method' => 'put', 'route' => ['backend.admin.permissions.update', $data->id]]) !!}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                Edit permission
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="control-label">Name:</label>
                                                                {!! Form::text('name', $data->name, ['class' => 'form-control', 'placeholder' => 'permission Name']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn bg-gradient-primary">
                                                                Save changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    @endif -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection