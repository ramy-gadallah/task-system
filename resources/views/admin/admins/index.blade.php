@extends('admin.layouts.master')
@section('title')
    admin
@endsection
@section('content')
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Admin</h4>
                        <a class="nav-link btn btn-success create-new-button" data-toggle="modal" data-target="#create"
                            aria-expanded="false" href="#">+ New admin</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td> {{ $admin->email }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#edit" class="badge badge-primary"
                                                data-id="{{ $admin->id }}" data-name="{{ $admin->name }}"
                                                data-email="{{ $admin->email }}" data-password="{{ $admin->password }}"><span
                                                    class="mdi mdi-pencil-outline"></span>
                                            </a>
                                            @if ($admin->id != 1)
                                                <a data-toggle="modal" data-target="#delete" class="badge badge-danger"
                                                    data-id="{{ $admin->id }}"><span class="mdi mdi-delete"></span>   
                                            @endif
                                        </a>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}

    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.store') }}" method="POST" id="createForm">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"></input>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"></input>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation"></input>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btnForm">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.update',1)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"></input>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"></input>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">confirm Password</label>
                            <input type="password" class="form-control" id="password"
                                name="password_confirmation"></input>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btnForm">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- modal delete --}}
    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div>
                    <form action="{{route('admins.destroy',1)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>are you sure delete this admin.</p>
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="modal-footer">
                            </a>
                            <button type="submit" class="btn btn-primary">Yes </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- show errors  --}}
    <script>
        $(document).ready(function() {

            @if ($errors->any())
                $('#create').modal('show');
            @endif

            $('.btnForm').click(function() {
                $('#createForm').submit();
            });
        });
    </script>

    {{-- delete  script --}}
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>

    {{-- edit script --}}
    <script>
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var password = button.data('password')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #password').val(password);
        })
    </script>
@stop
