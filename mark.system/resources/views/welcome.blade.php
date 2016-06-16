@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('flash_message_empty'))
        <div class="alert alert-warning alert-dismissible" role="alert"><strong> {!! session('flash_message_empty') !!}</strong></div>
    @endif

    <div class="row">
        <form action="{{url('/search')}}" method="post" accept-charset="utf-8">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tra cứu điểm thi</div>

                <div class="panel-body">
                    <div class="col-md-3">
                        Năm học:
                        <select name="year" id="year" class="form-control">
                            <option value="0"
                                >Lựa chọn năm học </option>
                            @foreach($years as $year)
                            <option value="{{$year->id}}"
                                ><?php echo $year->year_title."-".(intval($year->year_title)+1) ?> </option>
                            @endforeach
                        </select>    
                    </div>
                    <div class="col-md-3">
                        Kỳ học: 
                        <select name="semester" id="semester" class="form-control">
                            <option value="1">Học kỳ một</option>
                        </select>    
                    </div>
                    <div class="col-md-3">
                        Nhập mã môn học cần tìm: 
                        <input class="form-control" type="text" name="mamh" value="" placeholder="">
                        
                    </div>
                    <div class="col-md-3">
                        Nhập tên môn học cần tìm: 
                        <input class="form-control" type="text" name="tenmh" value="" placeholder="">
                        
                    </div>               
                </div>
                <div class="col-md-12" align="middle">
                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                <br><br>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã lớp môn học</th>
                                    <th>Tên môn học</th>
                                    <th>File điểm thi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach($results as $re)
                                    <tr>
                                    <td>{{$re->subject_code}}</td>

                                    <td>{{$re->subject_title}}</td>
                                    <td>
                                        @if($re->hasMark())
                                            <a href="{{url('/get/')."/".$re->getMark()->filename}}" title="">{{$re->getMark()->original_filename}}
                                            </a>
                                        @else
                                            <?php echo "Chưa có điểm" ?>
                                        @endif
                                    </td>
                                    
                                 </tr>
                                    @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        </form>
        
        
    </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
    $('div.alert').delay(5000).slideUp(300);

    $('#year').on('change', function(e){
        console.log(e);

        var year_id = e.target.value;

        $.get('{{url('/ajax-submenu')}}' + '?year_id=' + year_id, function(data){
            $('#semester').empty();
            $('#semester').append('<option value=0>Lựa chọn học kỳ</option>');
            $.each(data, function(index, semesterObj){
                $('#semester').append('<option value='+semesterObj.id+'>'+semesterObj.semester_title+'</option>');
            });
        });
    });
</script>
@endsection
