@extends('layouts.dashboard')

@section('content')
<div class="col-lg-5 col-lg-offset-1" >
    <h1><i class="fa fa-folder"></i> Quản lý môn học </h1>
    {{ Form::open(['method' => 'DELETE']) }}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Lựa chọn</th>
					<th>STT</th>
					<th>Môn học</th>
					<th>Học kỳ</th>
					<th>Năm học</th>
					<th>Chức năng quản lý</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subjects as $subject)
				<tr>@role('admin')
					<td><input type="checkbox" name="selectMany[]" value="{{$subject->id}}"></td>
					<td>{{$i++}}</td>
					<th>{{$subject->subject_title}}</th>
					<td>{{$subject->getSemester($subject->semester_id)->semester_title}}</td>
					<td><?php echo $subject->getSemester($subject->semester_id)->getYear($subject->getSemester($subject->semester_id)->year_id)->year_title."-".(intval($subject->getSemester($subject->semester_id)->getYear($subject->getSemester($subject->semester_id)->year_id)->year_title)+1) ?></td>
					<td>
			            {{ Form::open(['url' => 'admin/subject/' . $subject->id, 'method' => 'DELETE']) }}
			            {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
			            {{ Form::close() }}
		            </td>
		            @endrole
		            @role('teacher')
					<td><input type="checkbox" name="selectMany[]" value="{{$subject->id}}"></td>
					<td>{{$i++}}</td>
					<th>{{$subject->subject_title}}</th>
					<td>{{$subject->getSemester($subject->semester_id)->semester_title}}</td>
					<td>{{$subject->getSemester($subject->semester_id)->getYear($subject->getSemester($subject->semester_id)->year_id)->year_title}}</td>
					<td>
						
			            {{ Form::open(['url' => 'teacher/subject/' . $subject->id, 'method' => 'DELETE']) }}
			            {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
			            {{ Form::close() }}
		            </td>
		            @endrole
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

    <h1><i class='fa fa-user'></i> Thêm môn học</h1>
	@role('admin')
    {{ Form::open(['role' => 'form', 'url' => '/admin/subject']) }}
	@endrole
	@role('teacher')
    {{ Form::open(['role' => 'form', 'url' => '/teacher/subject']) }}
	@endrole
	Lựa chọn năm học:
    <select class='form-control' name="year" id="year">
    	@foreach($years as $year)
		<option value="{{$year->id}}"
            ><?php echo $year->year_title."-".(intval($year->year_title)+1) ?> </option>
    	@endforeach
    </select>
    Lựa chọn học kỳ:
    <select class='form-control' name="semester" id="semester" >
		<option value="0">Lựa chọn kỳ học</option>}
    </select>
	
	<div class='form-group'>
        {{ Form::label('subject_code', 'Lớp môn học') }}
        {{ Form::text('subject_code', null, ['placeholder' => 'Lớp môn học', 'class' => 'form-control']) }}
    </div>

	<div class='form-group'>
        {{ Form::label('subject', 'Môn học') }}
        {{ Form::text('subject', null, ['placeholder' => 'Môn học', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit('Xác nhận', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>

<script type="text/javascript" charset="utf-8" async defer>
    $('#year').on('change', function(e){
        console.log(e);

        var year_id = e.target.value;

        $.get('{{url('admin/post/ajax-submenu')}}' + '?year_id=' + year_id, function(data){
            $('#semester').empty();
            $('#semester').append('<option value=0>Lựa chọn học kỳ</option>');
            $.each(data, function(index, semesterObj){
                $('#semester').append('<option value='+semesterObj.id+'>'+semesterObj.semester_title+'</option>');
            });
        });
    });
</script>
@stop