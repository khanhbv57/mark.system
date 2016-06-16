@extends('layouts.dashboard')

@section('title') Users @stop

@section('content')
<div class="col-lg-10 col-lg-offset-1" >
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success"><strong> {!! session('flash_message') !!}</strong></div>
    @endif

    @if(Session::has('flash_message_fail'))
    <div class="alert alert-warning alert-dismissible" role="alert"><strong>
        {!! session('flash_message_fail') !!}</strong>
    </div>
    @endif

    <h1><i class="fa fa-folder"></i> Quản lý file điểm </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Lớp môn học</th>
                    <th>Môn học</th>
                    <th>Năm học</th>
                    <th>Học kỳ</th>
                    <th>File điểm thi</th>
                    <th>Ngày tạo file</th>
                </tr>
            </thead>

            <tbody>
                @foreach($entries as $entry)
                
                <tr> 
                    <td>{{ $entry->getSubject($entry->subject_id)->subject_code}}</td>
                    <td>{{ $entry->getSubject($entry->subject_id)->subject_title}}</td>
                    <td><?php echo $entry->getYear($entry->getSemester($entry->getSubject($entry->subject_id)->semester_id)->year_id)->year_title."-".(intval($entry->getYear($entry->getSemester($entry->getSubject($entry->subject_id)->semester_id)->year_id)->year_title)+1) ?></td>
                    <td>{{ $entry->getSemester($entry->getSubject($entry->subject_id)->semester_id)->semester_title}}</td>
                    <td>
                        @role('admin')<a href="{{
                        url('admin/post/get/')."/".$entry->filename
                    }}" title="">{{$entry->original_filename}}</a>
                    @endrole
                    @role('teacher')<a href="{{
                        url('teacher/post/get/')."/".$entry->filename
                    }}" title="">{{$entry->original_filename}}</a>
                    @endrole</td>
                    <td>{{ $entry->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                        @role('admin')
                        <a href="{{url('admin/post/edit')."/".$entry->id}} " class="btn btn-info pull-left" style="margin-right: 3px;">Sửa</a>
                        {{ Form::open(['url' => 'admin/post/delete'. '/' . $entry->filename, 'method' => 'DELETE']) }}
                        {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
                        {{ Form::close() }}
                        @endrole
                        @role('teacher')
                        <a href="{{url('teacher/post/edit')."/".$entry->id}} " class="btn btn-info pull-left" style="margin-right: 3px;">Sửa</a>
                        {{ Form::open(['url' => 'teacher/post/delete'.'/' . $entry->filename, 'method' => 'DELETE']) }}
                        {{ Form::submit('Xóa', ['class' => 'btn btn-danger'])}}
                        {{ Form::close() }}
                        @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination pull-right">
            @if($entries->currentPage() > 1)
            <li><a href="{{ $entries->url($entries->currentPage() -1 )}}">Prev</a></li>
            @endif
            @for($i = 1; $i <= $entries->lastPage(); $i++)
            <li class="{!! $entries->currentPage() == $i ? 'active' : '' !!}">
                <a href="{!! $entries->url($i) !!}">{{ $i }}</a>
            </li>
            @endfor
            @if($entries->currentPage() < $entries->lastPage())
            <li><a href="{{ $entries->url($entries->currentPage() +1 )}}">Next</a></li>
            @endif
        </ul>
    </div>
    
    @role('admin')
    <form action="{{url('admin/post/add')}}" method="post" enctype="multipart/form-data">
    @endrole
    @role('teacher')
    <form action="{{url('teacher/post/add')}}" method="post" enctype="multipart/form-data">
    @endrole
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h1><i class="fa fa-folder"></i> Tải lên file điểm </h1>
        Năm học: <select id="year" name="year" class="form-control">
        <option value="0">Lựa chọn năm học</option>
        @foreach($years as $year)
        <option value="{{$year->id}}"
        ><?php echo $year->year_title."-".(intval($year->year_title)+1) ?> </option>
        @endforeach
        </select><br>
        Kỳ học: <select name="semester" id="semester" class="form-control">
        <option value="0">Lựa chọn học kỳ</option>
        </select><br>
        Môn học: <select name="subject" id="subject" class="form-control">
        <option value="0">Lựa chọn môn học</option>
        </select>
        <br>
        Nhập tên file:
        <input type="text" name="name"><br>
        <input type="file" name="filefield"><br>
        <input type="submit">
    </form>
</div>



<script type="text/javascript" charset="utf-8" async defer>
    
    $('div.alert').delay(5000).slideUp(300);

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

    $('#semester').on('change', function(e){
        console.log(e);

        var year_id = e.target.value;
        var semester_id = e.target.value;

        $.get('{{url('admin/post/ajax-submenu2')}}'+ '?year_id='+ year_id +'&semester_id=' + semester_id, function(data){
            $('#subject').empty();
            $('#subject').append('<option value=0>Lựa chọn môn học</option>');
            $.each(data, function(index, subjectObj){
                $('#subject').append('<option value='+subjectObj.id+'>'+subjectObj.subject_code+" "+subjectObj.subject_title+'</option>');
            });
        });
    });

</script>


@stop
