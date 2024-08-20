<div id="top">
  <!-- .navbar -->
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">

      <!-- Brand and toggle get grouped for better mobile display -->
      <header class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="/admin" class="navbar-brand">
          <img src="/assets/userweb/images/centralpc_logo_white.png" alt="">
        </a>
      </header>
      <div class="topnav">
        <div class="btn-group">
          <a href="/admin/sessions" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm" data-method="delete">
            <i class="fa fa-power-off"></i>
          </a>
          <a href="/" data-toggle="tooltip" data-original-title="Exit" data-placement="bottom" class="btn btn-metis-2 btn-sm">
            <i class="fa fa-sign-out"></i>
          </a>
        </div>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">

        <!-- .nav -->
        <!-- <ul class="nav navbar-nav">
          <li class="active">
            <a href="dashboard.html">Dashboard</a>
          </li>
          <li> <a href="table.html">Tables</a>  </li>
          <li> <a href="file.html">File Manager</a>  </li>
          <li class='dropdown '>
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              Form Elements
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li> <a href="form-general.html">General</a>  </li>
              <li> <a href="form-validation.html">Validation</a>  </li>
              <li> <a href="form-wysiwyg.html">WYSIWYG</a>  </li>
              <li> <a href="form-wizard.html">Wizard &amp; File Upload</a>  </li>
            </ul>
          </li>
        </ul> --><!-- /.nav -->
      </div>
    </div><!-- /.container-fluid -->
  </nav><!-- /.navbar -->
  <header class="head">
    <div class="search-bar" style="visibility:hidden">
      <form class="main-search" action="">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Live Search ...">
          <span class="input-group-btn">
      <button class="btn btn-primary btn-sm text-muted" type="button">
          <i class="fa fa-search"></i>
      </button>
  </span>
        </div>
      </form><!-- /.main-search -->
    </div><!-- /.search-bar -->
    <div class="main-bar">
      <h3>
        {{ $template['main-bar-title'] }}
      </h3>
    </div><!-- /.main-bar -->
  </header><!-- /.head -->
</div><!-- /#top -->
