<!DOCTYPE html>
<html>

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
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="../admin/home">About Admin</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/login">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <h1 style="margin-left: 45%; font-family: 'Comic Sans MS', cursive, sans-serif;">Creat new Profile for User</h1>
      <hr>
      <div class="row">
        <!-- left column -->
        <div class="col-md-3">

        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info">

          <h3 style="margin-left: 45%; font-family: 'Comic Sans MS', cursive, sans-serif;">Personal info</h3>

          <form class="form-horizontal" method="post">
            {{csrf_field()}}

            <input type="hidden" name="type" value="user"></input>

            <div class="form-group">
              <label class="col-lg-3 control-label">Name:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="name">
              </div>
            </div>

            @if($errors->any())
            <div class="form-group">
              <div class="alert alert-danger">
                <ul>
                  <li>
                    {{$errors->first('name')}}
                  </li>
                </ul>
              </div>
            </div>
            @endif


            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="email">
              </div>
            </div>
            @if($errors->any())
            <div class="form-group">
              <div class="alert alert-danger">
                <ul>
                  <li>
                    {{$errors->first('email')}}
                  </li>
                </ul>
              </div>
            </div>
            @endif

            <div class="form-group">
              <label class="col-md-3 control-label">Username:</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="username">
              </div>
            </div>
            @if($errors->any())
            <div class="form-group">
              <div class="alert alert-danger">
                <ul>
                  <li>
                    {{$errors->first('username')}}
                  </li>
                </ul>
              </div>
            </div>
            @endif

            <div class="form-group">
              <label class="col-md-3 control-label">DOB:</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="dob">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Phone:</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="phone">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Gender:</label>
              <div class="col-md-8">
                <input type="radio" id="gender2" name="gender" value="0">MALE</label>
                <input type="radio" id="gender1" name="gender" value="1">FEMALE</label>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="password">
              </div>
            </div>

            @if($errors->any())
            <div class="form-group">
              <div class="alert alert-danger do">
                <ul>
                  <li>
                    {{$errors->first('password')}}
                  </li>
                </ul>
              </div>
            </div>
            @endif

            <div class="form-group">
              <label class="col-md-3 control-label">Confirm password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="cpassword">
              </div>
            </div>
            @if($errors->any())
            <div class="form-group">
              <div class="alert alert-danger">
                <ul>
                  <li>
                    {{$errors->first('cpassword')}}
                  </li>
                </ul>
              </div>
            </div>
            @endif
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <input type="submit" class="btn btn-primary " value="Save">

              </div>
          </form>
        </div>
      </div>
    </div>
    <hr>

    <!--  <div class="form-group" >
             <div class="alert alert-danger">
               <ul>
                 @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                 @endforeach

                
                  
                

               </ul>
             </div>
           </div> -->

  </section>





</body>

</html>