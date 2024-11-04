@extends('backend.master')

@section('title', $role->name . ' Role Permission')

@section('content')
@can('role_view')
<div class="mt-n5 mb-3 d-flex justify-content-end">
    <a href="{{ route('backend.admin.roles') }}" class="btn bg-gradient-primary">
        <i class="fas fa-ruler-vertical"></i>
        Roles
    </a>
</div>
@endcan
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('backend.admin.update.role-permissions', $role->id) }}" method="post">
                @csrf
                <table class="table">
                    <tbody>
                        @foreach ($permissions->chunk(4) as $permission)
                        <tr>
                            @foreach ($permission as $data)
                            <td>
                                <?php
                                $per_found = null;

                                if (isset($role)) {
                                    $per_found = $role->hasPermissionTo($data->name) ?? null;
                                }

                                if (isset($user)) {
                                    $per_found = $user->hasDirectPermission($data->name);
                                }
                                ?>

                                <div
                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input"
                                        id="customSwitch{{ $data->id }}" name="permissions[]"
                                        value="{{ $data->name }}"
                                        {{ $data->name == $per_found ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch{{ $data->id }}">
                                        {{ snakeToTitle($data->name) }}
                                    </label>
                                </div>

                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mb-3">
                    <button type="submit" class="btn bg-gradient-primary w-25"> Submit </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection