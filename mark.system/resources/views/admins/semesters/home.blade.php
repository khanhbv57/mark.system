@extends('layouts.dashboard')

@section('content')
<div class="col-lg-5 col-lg-offset-1" >
    <h1><i class="fa fa-folder"></i> Quản lý kỳ học </h1>
    {{ Form::open(['method' => 'DELETE']) }}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Lựa chọn</th>
					<th>STT</th>
					<th>Học kỳ</th>
					<th>Năm học</th>
					<th>Chức năng quản lý</th>
				</tr>
			</thead>
			<tbody>
				@foreach($semesters as $sem)
				<tr>
					<td><input type="checkbox" name="selectMany[]" value="{{$sem->id}}"></td>
					<td>{{$i++}}</td>
					<td>{{$sem->semester_title}}</td>
					<td><?php echo $sem->getYear($sem->year_id)->year_title ."-".(intval($sem->getYear($sem->year_id)->year_title)+1) ?>
					</td>
					<td>@role('admin')
			            {{ Form::open(['url' => 'admin/semester/' . $sem->id, 'method' => 'DELETE']) }}
			            {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
			            {{ Form::close() }}
			            @endrole
			            @role('teacher')
			            {{ Form::open(['url' => 'teacher/semester/' . $sem->id, 'method' => 'DELETE']) }}
			            {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
			            {{ Form::close() }}
			            @endrole

		            </td>
		            
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{ Form::submit('Xóa nhiều', ['class' => 'btn btn-danger'])}}
	{{ Form::close() }}


</div>	

<div class="col-lg-5 col-lg-offset-1" >
	@if ($errors->has())
        @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
        @endforeach
    @endif

    <h1><i class='fa fa-user'></i> Thêm học kỳ</h1>
	@role('admin')
    {{ Form::open(['role' => 'form', 'url' => '/admin/semester']) }}
	@endrole
	@role('teacher')
    {{ Form::open(['role' => 'form', 'url' => '/teacher/semester']) }}
	@endrole
    Lựa chọn năm học:
    <select class='form-control' name="year" >
    	@foreach($years  as $year)
		<option value="{{$year->id}}"
><?php echo $year->year_title."-".(intval($year->year_title)+1) ?> </option>
    	@endforeach
    </select>
	
	<div class='form-group'>
        {{ Form::label('semester', 'Kỳ học') }}
        {{ Form::text('semester', null, ['placeholder' => 'Kỳ học', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit('Xác nhận', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>
@stop