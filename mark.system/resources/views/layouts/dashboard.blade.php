<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{URL::asset('assets/css/footer-distributed-with-address-and-phones.css')}}">
	
<link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/datepicker3.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/styles.css')}}" rel="stylesheet">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!--Icons-->
<script src="{{URL::asset('assets/js/lumino.glyphs.js')}}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</style>
</head>

<body>
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					@include('includes.nav-bar')
				</div>
								
			</div><!-- /.container-fluid -->
		</nav>
			
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<form role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav menu">
				@role('admin')
				<li class=""><a href="{{url('/admin/user')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Quản lý giáo viên</a></li>
				<li class=""><a href="{{url('/admin/post')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Quản lý điểm</a></li>
				<li class="parent ">
					<a href="#">
						<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Cập nhật CSDL 
					</a>
					<ul class="children collapse" id="sub-item-1">
						<li>
							<a class="" href="{{url('admin/year')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý năm học
							</a>
						</li>
						<li>
							<a class="" href="{{url('admin/semester')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý kỳ học
							</a>
						</li>
						<li>
							<a class="" href="{{url('admin/subject')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý các môn học
							</a>
						</li>
					</ul>
				</li>
				@endrole
				@role('teacher')
				<li class=""><a href="{{url('/teacher/post')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Quản lý điểm</a></li>
				<li class="parent ">
					<a href="#">
						<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Cập nhật CSDL 
					</a>
					<ul class="children collapse" id="sub-item-1">
						<li>
							<a class="" href="{{url('teacher/year')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý năm học
							</a>
						</li>
						<li>
							<a class="" href="{{url('teacher/semester')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý kỳ học
							</a>
						</li>
						<li>
							<a class="" href="{{url('teacher/subject')}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý các môn học
							</a>
						</li>
					</ul>
				</li>
				@endrole
			</ul>

		</div><!--/.sidebar-->
		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
			@yield('content')
		</div>
		
		</div>	<!--/.main-->
	<header>
	
	
	<script src="{{URL::asset('assets/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
	<script>
		var menu = document.querySelector('.menu');
		var anchors = menu.getElementsByTagName('a');

		for (var i = 0; i < anchors.length; i += 1) {
		  anchors[i].addEventListener('click', function() { clickHandler(anchors[i]) }, false);
		}

		function clickHandler(anchor) {
		  var hasClass = anchor.getAttribute('class');
		  if (hasClass !== 'active') {
		    anchor.setAttribute('class', 'active');
		  }
}

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
