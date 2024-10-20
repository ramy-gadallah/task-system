@extends('admin.layouts.master')
@section('title')
    Tasks
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Tasks</h4>
                        <a class="nav-link btn btn-success create-new-button" data-toggle="modal" data-target="#create"
                            aria-expanded="false" href="#">+ New Task</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    
                                <tr class="rowOffer{{$task->id}}">
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>
                                        <a 
                                        data-id="{{ $task->id }}"
                                        data-name="{{ $task->name }}"
                                        data-toggle="modal" data-target="#edit" class="badge badge-primary"><span
                                         class="mdi mdi-pencil-outline"></span>
                                        </a>
                                        <a 
                                        data-id="{{ $task->id }}"
                                        data-toggle="modal" data-target="#delete" class="badge badge-danger deleteBtn"><span
                                                class="mdi mdi-delete ">
                                            </span>
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
                    <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                     
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btnForm">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
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
                <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                 
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btnForm">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('js')
    {{-- create script --}}
    <script>
        $(document).ready(function() {
            $('#createForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting via the browser.
                var formData = new FormData(this);

                $.ajax({
                    method: "POST",
                    enctype: 'multipart/form-data',
                    url: "{{ route('tasks.store') }}", // Make sure this URL is rendered correctly by the server-side template.
                    data: formData,
                    processData: false, // Necessary for file data, do not process data.
                    contentType: false, // Necessary for file data, do not set a content type.
                    cache: false, // Prevent caching.

                    success: function(data) {
                        console.log(data);
                        if (data.status == 'true') {
                            $('#create').modal('hide');  
                            $('#createForm')[0].reset(); 
                            window.location.href = data.redirect;
                            toastr.success(data.message);           
                        }
                        if (data.status == 'false') {
                            $.each(data.message, function(key, value) {
                                let msg = value[0];
                                toastr.error(msg);
                            });
                        }
                    },
                    error: function(data) {
                    }
                });
            });
        });
    </script>

    {{-- edit script --}}
    <script>
        $(document).ready(function() {
            $('#edit').on('show.bs.modal', function(event) {             
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id');          // Extract info from data-* attributes
                var name = button.data('name');
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            });
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    enctype: 'multipart/form-data',
                    url: "{{ route('tasks.update',1) }}", // Make sure this URL is correct according to your routes in Laravel
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
    
                     success: function(data) {
                            if (data.status == 'true') {
                                $('#edit').modal('hide');                    
                                window.location.href = data.redirect;  // Redirect on success
                                toastr.success(data.message);  // Show success message            
                            }
                            if (data.status == 'false') {
                                $.each(data.message, function(key, value) {
                                    let msg = value[0];
                                    toastr.error(msg);
                                });
                            }
                        },
                    error: function(error) {               
                    }
                });
            });
        });  
    </script>
    
{{-- delete script --}}
<script>
    $(document).ready(function() {
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                method: 'delete',
                url: "{{ route('tasks.destroy',1) }}",
                data : {
                    '_token': '{{  csrf_token() }}',
                    'id':id,
                  
                },
                success: function(data) {
                    if (data.status == '200') {
                      	 $('.rowOffer'+ data.id).remove();   // مهمة اووووى دى اللى هتخلينى امسح 

                        toastr.success(data.success);
                    } 
                },
                error: function(url) {
                },
            
                cache: false,
            });
        });
    });
</script>	

@stop
