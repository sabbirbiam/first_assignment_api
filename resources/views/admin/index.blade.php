<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css" >
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
        <li class="active"><a href="/home">Home</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><form class="form-inline set" method="post">
        <div class="form-group">
          {{csrf_field()}}
          <input type="text" name="username" class="form-control" id="uname" placeholder="Admin username">
        </div>
        <div class="form-group">
          
          <input type="password" name="password" class="form-control" id="pwd" placeholder="password">
        </div>
        
        <button type="submit" value="Login" class="btn btn-default">Admin_Login</button>
    </form></li>

    
      </ul>

    </div>
    @if(session('message'))
    <label style="color: red; float: right;" >{{session('message')}}</label>
  @endif
  </div>

</nav>
  

    <div class="col-sm-8 text-left"> 
      <h1 align="center" style=" font-family: 'Comic Sans MS', cursive, sans-serif;">Admin login page</h1>

      
     

      
      
    </div>
    <div class="col-sm-2 sidenav">

      
</div>



</body>
</html>
