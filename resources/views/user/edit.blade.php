<!DOCTYPE html>
<html>

<head>
	<title></title>
	<title></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

	<style type="text/css">
		form input {
			margin-top: 5px;
			margin-left: 5px;
		}
	</style>

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
				</ul>
				<ul class="nav navbar-nav navbar-right">

					<li><a href="/logout">LogOut</a></li>


				</ul>
			</div>
		</div>
	</nav>

	<h2 style="margin-left: 45%; font-family: 'Comic Sans MS', cursive, sans-serif;">Edit User</h2>
	<div class="container">

		<br />
		<br />
		<form method="post" action="/updateuser/{{$user->id}} " style="margin-left: 40%; margin-top: 10px;  line-height: 20px; ">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$user->id}}">
			<input type="hidden" name="username" value="{{$user->username}}">
			<input type="hidden" name="_method" value="put">
			<table>

				<tr>
					<td>User Name</td>
					<td><input type="text" name="name" value="{{$user->name}}"></td>
				</tr>
				<tr>
					<td>User Email</td>
					<td><input type="text" name="email" value="{{$user->email}}"></td>
				</tr>
				<tr>
					<td>User DOB</td>
					<td><input type="text" name="dob" value="{{$user->dob}}"></td>
				</tr>
				<tr>
					<td>User Phone</td>
					<td><input type="text" name="phone" value="{{$user->phone}}"></td>
				</tr>

				<tr>
					<td>User Gender</td>
					<td>
						<input type="radio" id="gender2" name="gender" value="0" {{ ($user->gender=="0")? "checked" : "" }}>MALE</label>
						<input type="radio" id="gender1" name="gender" value="1" {{ ($user->gender=="1")? "checked" : "" }}>FEMALE</label>
					</td>
				</tr>

				<tr>
					<td></td>
					<td><input style="background-color: black; color: white;" class="btn" type="submit" value="Update"></td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>