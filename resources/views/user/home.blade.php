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

                <a class="navbar-brand" href="#">Blogs</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/user/stories">Stories</a></li>
                    <!-- <li><a href="/userInfo">User Information</a></li> -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout">LogOut</a></li>


                </ul>

            </div>
            @if(session('message'))
            <label style="color: red; float: right;">{{session('message')}}</label>
            @endif
        </div>

    </nav>


    <div class="col-sm-8 text-left">
        <h1 align="center" style=" font-family: 'Comic Sans MS', cursive, sans-serif;">Welcome User</h1>
        <div class="container bootstrap snippet">
            <div class="panel-body inf-content">
                <div class="row">

                    <div class="col-md-6">
                        <strong>Information</strong><br>
                        <div class="table-responsive">
                            <table class="table table-condensed table-responsive table-user-information">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                                Identificacion
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            {{$de->id}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-user  text-primary"></span>
                                                Name
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            {{$de->name}}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-bookmark text-primary"></span>
                                                Username
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            {{$de->username}}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-eye-open text-primary"></span>
                                                Role
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            {{$de->type}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-envelope text-primary"></span>
                                                Email
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            {{$de->email}}
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>

                                       <td> <a style="color: green;" href="/user/info/edit/{{$de->id}}">Edit</i></a></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>


    </div>
    <div class="col-sm-2 sidenav">


    </div>



</body>

</html>