<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- <style>
		body {
			margin: 0;
			padding: 0;
			background-color: #f1f1f1;
		}

		.box {
			width: 1270px;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-top: 25px;
		}
	</style> -->
</head>

<body>


	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">

				<a class="navbar-brand" href="#">Blogs</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/admin/home">Home</a></li>
					<li><a href="/user/stories/create">Create New Story</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">

					<li><a href="/logout">LogOut</a></li>

				</ul>
			</div>
		</div>
	</nav>

	<h2 style="margin-left: 45%; font-family: 'Comic Sans MS', cursive, sans-serif;">List of Stories</h2>

	<!-- <form method="post" action="/stories/search">
		{{csrf_field()}}
		<div class="form-group">
			<input type="text" name="username" class="form-control" id="uname" placeholder="User_name">
		</div>

		<div class="form-group">
			<input type="text" name="username2" class="form-control" id="uname" placeholder="User_name">
		</div>

		<div class="form-group">
			<input type="text" name="username1" class="form-control" id="uname" placeholder="User_name">
		</div>

		<button type="submit" value="Login" class="btn btn-default">Search</button>
	</form> -->

	<div class="container">

		<br />
		<br />

		<!-- <table id="user_data" class="table table-bordered table-striped"> -->

		@foreach($stories as $story)
		<!-- <div class="container-fluid"> -->
		<table id="user_data" class="table table-bordered table-striped">
			<tr>
				@if(Session::get('register'))
				<td>
					{{Session::get('register')->id}}
					<div class="div">

						Posted By {{$story->user["name"]}} {{" ---  "}} Post Date: {{$story->created_at}}
					</div>


				</td>
				@endif
			</tr>

			<tr>
				<td>Story Title: {{$story->title}}</td>
			</tr>

			<tr>
				<td>Story Section: {{$story->section}}</td>
			</tr>

			<tr>
				<td>Story Tags: {{$story->tags ? $story->tags:"--"}}</td>
			</tr>

			<tr>
				<td>Story story: {{$story->story ? $story->story:"--"}}</td>
			</tr>

			<tr>
				<td>Story Picture:(Image Caption: <b>{{$story->storycaption}}</b>)
				  
				<img src="/pic/{{$story->storyimage}}" style="height: 150px; width: 150px;border-radius:25%;" />
				</td>
			</tr>

			<tr>
				<td>Comments:
					</br>
					@foreach($story->comment as $commnet)
					{{$commnet->comments ?$commnet->comments : "--"}}
					@if(Session::get('register')->id == $commnet->user_id)
					<form method="post" action="/userposts/delete/{{$commnet->id}}">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="delete">

						<input style="background-color: red; color: white;" class="btn" type="submit" value="Delete">
					</form>
					@endif


					<!-- <a style="color: red;" href="/posts/delete/{{$commnet->id}}"><i class="fas fa-trash-alt"></i></a> -->
					</br>
					@endforeach

					<form method="post" action="/save">
						{{csrf_field()}}
						<input type="hidden" name="story_id" id="story_id" value="{{$story->id}}">
						<input type="text" name="comments" id="comments" placeholder="Add New Comment">

						@if($errors->any())
						<div class="form-group">
							<div class="alert alert-danger">
								<ul>
									<li>
										{{$errors->first('comments')}}
									</li>
								</ul>
							</div>
						</div>
						@endif

						<input style="background-color: green; color: white;" class="btn" type="submit" value="Save">
					</form>
				</td>
				<!-- <td>Comments 1</td> -->
			</tr>

			<tr>

			</tr>

			@if(Session::get('register')->id == $story->user_id)
			<tr>
				<a style="color: green;" href="/user/stories/edit/{{$story->id}}">Edit</i></a> |
				<!-- <a style="color: red;">Delete</i></a> -->
				<form method="post" action="/user/stories/{{$story->id}}">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="delete">

					<input style="background-color: red; color: white;" class="btn" type="submit" value="Delete">
				</form>
			</tr>
			@endif

		</table>
		@endforeach
		<!-- </table> -->

	</div>
</body>

</html>