@extends('layouts.admin')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Unversalbank dasturchilari vazifalari</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                            <li class="breadcrumb-item active">API-@lang('cruds.user.title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('cruds.user.title_singular')</h3>

{{--                            @can('user.add')--}}
                            <a href="{{ route('task.add') }}" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                                Task add
                            </a>
{{--                            @endcan--}}

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: scroll">
                            <table class="table table-bordered table-striped  dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                                @if(Session::has('started'))
                                    <p class="text-center alert alert-success">{{ Session::get('started') }}</p>
                                @endif
                                    @if(Session::has('ended'))
                                        <p class="text-center alert alert-success">{{ Session::get('ended') }}</p>
                                    @endif
                                <thead>
                                <tr class="text-center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Started Ended</th>
                                    <th>Edit Show Delete</th>
{{--                                    <th>Show</th>--}}
{{--                                    <th>Delete</th>--}}
{{--                                    <th>Created by</th>--}}
{{--                                    <th>Tokens</th>--}}
{{--                                    <th>Activate</th>--}}
{{--                                    <th style="width: 10px">@lang('global.actions')</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="text-center">
{{--                                        <td>--}}
{{--                                            @can('passport.view')<i class="fa fa-eye" onmousedown="showPassword({{ $user->id }})" onmouseup="hidePassword({{ $user->id }})"></i>@endcan--}}
{{--                                            {{ $user->name }}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <span style="display: block" id="hidden_{{ $user->id }}">*****</span>--}}
{{--                                            @can('password.view')<span style="display: none" id="password_{{ $user->id }}">{{ $user->password }}</span>@endcan--}}
{{--                                        </td>--}}
                                        <td>{{ $task->id}}</td>
                                        <td>{{ $task->name}}</td>
                                        <td>{{ $task->start }}</td>
                                        <td>{{ $task->end}}</td>
{{--                                        <td>{{ $user->is_active }}</td>--}}
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                    <a @if($task->status == 2)class=" btn btn-danger disabled"
                                                       @else class="clientID btn btn-success"
                                                       @endif
                                                        href="{{ route('task.started', ['task_id' => $task->id]) }}"><i class="far fa-play-circle"></i></a>
                                                    <a @if($task->status == 3)class="btn btn-danger disabled"
                                                       @else class="btn btn-primary"
                                                       @endif
                                                       href="{{ route('task.ended', ['task_id' => $task->id]) }}"><i class="far fa-stop-circle"></i></a>

                                            </div>

                                        </td>
                                        <td>
{{--                                            href="{{ route('product.edit', ['product' => $task->id]) }}--}}
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-success " href="{{ route('task.edit', ['task_id' => $task->id]) }}"><i class="far fa-edit"></i></a>
                                                <a class="btn btn-primary" href="{{ route('task.show', ['task_id' => $task->id]) }}"><i class="far fa-eye"></i></a>

                                                <a class="btn btn-danger" href="{{ route('task.delete', ['task_id' => $task->id]) }}"><i class="far fa-trash-alt"></i></a>
                                            </div>




                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 text-center">
                                {{ $tasks->links() }}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection
@section('scripts')
    <script>


        function showPassword(id){
            $("#hidden_"+id).hide();
            $("#password_"+id).show();
        }

        function hidePassword(id){
            $("#hidden_"+id).show();
            $("#password_"+id).hide();
        }
        function toggle_api_user(id){
            $.ajax({
                url: "/api-user/activate/?q=",
                type: "GET",
                data:{id},
                dataType: "JSON",
                success: function(result){
                    if (result.is_active == 1){
                        $('#api_user').attr('class',"fas fa-check-circle text-success");
                    }else{
                        $('#api_user').attr('class',"fas fa-times-circle text-danger");
                    }

                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
@endsection
