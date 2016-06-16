@extends('layouts.dashboard')

@section('title') Sửa giáo viên @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

   @if ($errors->has())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach    
        </ul>
    @endif

    <h1><i class='fa fa-user'></i> Sửa thông tin giáo viên</h1>

    {{ Form::model($user, ['role' => 'form', 'url' => 'admin/user/' . $user->id, 'method' => 'PUT']) }}

    <div class='form-group'>
        {{ Form::label('name', 'Họ Tên') }}
        {{ Form::text('name', null, ['placeholder' => 'Họ Tên', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('password', 'Mật khẩu') }}
        {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('password_confirmation', 'Xác nhận mật khẩu') }}
        {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit('Xác nhận', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

</div>

@stop