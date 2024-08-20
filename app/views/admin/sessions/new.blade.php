<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Central PC Amin | Login</title>
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/themes/admin/assets/lib/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/themes/admin/assets/lib/font-awesome/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="/themes/admin/assets/css/main.min.css">
    <link rel="stylesheet" href="/themes/admin/assets/lib/animate.css/animate.min.css">
  </head>
  <body class="login">
    <div class="form-signin">
      <div class="text-center">
        <img style="width:60%" src="/assets/userweb/images/centralpc_logo.png" alt="CentralPC Logo">
      </div>
      <hr>
      <div class="tab-content">
        <div id="login" class="tab-pane active">
          {{ Form::open(array('action' => 'admin\SessionsController@create')) }}
            @if( isset($error) && !empty($error) )
              <div id="error_explanation" class="alert alert-danger" role="alert">
                <p>{{ $error }}</p>
              </div>
            @endif
            <p class="text-muted text-center">
              Enter your e-mail and password
            </p>
            {{ Form::email('session[email]', '', array(
              'class' => 'form-control top',
              'placeholder' => 'E-mail'
            )) }}
            {{ Form::password('session[password]', array(
              'class' => 'form-control bottom',
              'placeholder' => 'Password'
            )) }}
            <div class="checkbox">
              <label>
                {{ Form::checkbox('session[remember_check]', '1') }}Remember Me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          {{ Form::close() }}
        </div>
        <div id="forgot" class="tab-pane">
          <form action="index.html">
            <p class="text-muted text-center">Enter your valid e-mail</p>
            <input type="email" placeholder="mail@domain.com" class="form-control">
            <br>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
          </form>
        </div>
        <div id="signup" class="tab-pane">
          <form action="index.html">
            <input type="text" placeholder="username" class="form-control top">
            <input type="email" placeholder="mail@domain.com" class="form-control middle">
            <input type="password" placeholder="password" class="form-control middle">
            <input type="password" placeholder="re-password" class="form-control bottom">
            <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
          </form>
        </div>
      </div>
      <hr>
      <div class="text-center">
        <ul class="list-inline">
          <li> <a class="text-muted" href="#login" data-toggle="tab">Login</a>  </li>
          <li> <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a>  </li>
          <li> <a class="text-muted" href="#signup" data-toggle="tab">Signup</a>  </li>
        </ul>
      </div>
    </div>
    <script src="/themes/admin/assets/lib/jquery/jquery.min.js"></script>
    <script src="/themes/admin/assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      (function($) {
        $(document).ready(function() {
          $('.list-inline li > a').click(function() {
            var activeForm = $(this).attr('href') + ' > form';
            //console.log(activeForm);
            $(activeForm).addClass('animated fadeIn');
            //set timer to 1 seconds, after that, unload the animate animation
            setTimeout(function() {
              $(activeForm).removeClass('animated fadeIn');
            }, 1000);
          });
        });
      })(jQuery);
    </script>
  </body>
</html>
