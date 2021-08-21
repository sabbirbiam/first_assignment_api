<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script type="text/javascript" src="js/cal.js"></script>

</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">

        <a class="navbar-brand" href="#">Blog</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/admin">About Admin</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <form class="form-inline set" method="post">
              <div class="form-group">
                {{csrf_field()}}
                <input type="text" name="username" class="form-control" id="uname" placeholder="User_name">
              </div>
              <div class="form-group">

                <input type="password" name="password" class="form-control" id="pwd" placeholder="password">
              </div>

              <button type="submit" value="Login" class="btn btn-default">Login</button>
            </form>
          </li>


        </ul>

      </div>
      @if(session('message'))
      <label style="color: red; float: right;">{{session('message')}}</label>
      @endif
    </div>

  </nav>
</body>

</html>