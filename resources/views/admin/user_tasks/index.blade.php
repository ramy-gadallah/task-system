@extends('admin.layouts.master')
@section('title')
    users
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Users Tasks</h4>
                     
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                    
                                <tr>
                                    <th></th>
                                    <th>Tasks</th>
                                    <th>Sub Tasks</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse ($user_tasks as $user_task)
                                <tr >
                                    <td>{{ $user_task->id }}</td>
                                    <td>{{ $user_task->task->name }}</td>
                                    @foreach ($user_task->task->sub_tasks as $sub_task)
                                        <td>{{ $sub_task->sub_task }}</td>
                                    @endforeach
                                 
                                </tr>
                                @empty                            
                                <tr>
                                    <td colspan="3">No data found</td>
                                </tr>


                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


