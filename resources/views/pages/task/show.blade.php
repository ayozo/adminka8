@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Show</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6 offset-3">
                             <tr class="center">
                                <td> <h5>{{ $task->name }}</h5></td>
                                 <td><p><b>Start date: </b>{{ $task->start }}</p></td>
                                 <td><p><b>End date: </b>{{ $task->end}}</p></td>
                             </tr>

                                {{--            <img src="{{ asset('storage/'.$product->image) }}" alt="bu yerda rasm bolish kerak edi">--}}
                            </div>
                        </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">Update</button>
                                <a href="{{ route('task.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

