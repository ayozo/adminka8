@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>API @lang('cruds.userManagement.title')</h1>--}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('api-userIndex') }}">API @lang('cruds.user.title')</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.add')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('task.update', ['task_id'=>$task->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Task name</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" placeholder="Task name" value="{{ old('name')?:$task->name }}">
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Start date</label>
                                <input type="text" name="start" class="form-control {{ $errors->has('start') ? "is-invalid":"" }}" value="{{ old('start')?:$task->start }}">
                                @if($errors->has('start'))
                                    <span class="error invalid-feedback">{{ $errors->first('start') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>End date</label>
                                <input type="text" name="end" class="form-control {{ $errors->has('end') ? "is-invalid":"" }}" value="{{ old('end')?:$task->end  }}">
                                @if($errors->has('end'))
                                    <span class="error invalid-feedback">{{ $errors->first('end') }}</span>
                                @endif
                            </div>
                            {{--                            <div class="form-group">--}}
                            {{--                                <label>@lang('cruds.user.fields.password')</label>--}}
                            {{--                                <input type="password" name="password" id="password-field" class="form-control {{ $errors->has('password') ? "is-invalid":"" }}" required>--}}
                            {{--                                <span toggle="#password-field" class="fa fa-fw fa-eye toggle-password field-icon"></span>--}}
                            {{--                                @if($errors->has('password'))--}}
                            {{--                                    <span class="error invalid-feedback">{{ $errors->first('password') }}</span>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label>@lang('global.login_password_confirmation')</label>--}}
                            {{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
                            {{--                                <span toggle="#password-confirm" class="fa fa-fw fa-eye toggle-password field-icon"></span>--}}
                            {{--                                @if($errors->has('password_confirmation'))--}}
                            {{--                                    <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">Update</button>
                                <a href="{{ route('task.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
