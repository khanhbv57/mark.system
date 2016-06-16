@extends('layouts.dashboard')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1" >

    <h1><i class="fa fa-users"></i> Quản lý giáo viên </h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    @if($user->hasRole('admin'))
                    {{"Người quản trị"}}
                    @else
                    {{"Giáo viên"}}
                    @endif
                    </td>
                    <td>
                        @if($user->hasRole('admin'))
                        <a href="{{url('admin/user') .'/'. $user->id . '/edit'}} " class="btn btn-info pull-left" style="margin-right: 3px;">Sửa</a>
                        @else
                        <a href="{{url('admin/user') .'/'. $user->id . '/edit'}} " class="btn btn-info pull-left" style="margin-right: 3px;">Sửa</a>
                        {{ Form::open(['url' => 'admin/user/' . $user->id, 'method' => 'DELETE']) }}
                        {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
                        {{ Form::close() }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination pull-right">
            @if($users->currentPage() > 1)
            <li><a href="{{ $users->url($users->currentPage() -1 )}}">Prev</a></li>
            @endif
            @for($i = 1; $i <= $users->lastPage(); $i++)
            <li class="{!! $users->currentPage() == $i ? 'active' : '' !!}">
                <a href="{!! $users->url($i) !!}">{{ $i }}</a>
            </li>
            @endfor
            @if($users->currentPage() < $users->lastPage())
            <li><a href="{{ $users->url($users->currentPage() +1 )}}">Next</a></li>
            @endif
         </ul>
    </div>

    <a href="{{url('admin/user/create')}}" class="btn btn-success">Thêm giáo viên</a>

</div>

@stop
