<div id="left">
  <div class="media user-media bg-dark dker">
    <div class="user-media-toggleHover">
      <span class="fa fa-user"></span>
    </div>
    <div class="user-wrapper bg-dark">
      <!-- <a class="user-link" href="">
        <img class="media-object img-thumbnail user-img" alt="User Picture" src="/themes/admin/assets/img/user.gif">
        <span class="label label-danger user-label">16</span>
      </a> -->
      <div class="media-body">
        <h5 class="media-heading">{{Auth::user()->email}}</h5>
        <ul class="list-unstyled user-info">
          <li> <a href="">Administrator</a>  </li>
          <li>Last Access :
            <br>
            <small>
              <i class="fa fa-calendar"></i>&nbsp;&nbsp;
              @if(isset(Auth::user()->last_sign_in_at))
                {{Auth::user()->last_sign_in_at}}
              @else
                Never Login
              @endif

            </small>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- #menu -->
  <ul id="menu" class="bg-blue dker">

    <li class="nav-header">Menu</li>

    <li class="nav-divider"></li>
    <li {{ LayoutHelper::setActiveClass('dashboard') }}>
      <a href="/admin">
        <i class="fa fa-dashboard"></i>
        <span class="link-title">&nbsp;Dashboard</span>
      </a>
    </li>
    <li {{ LayoutHelper::setActiveClass('admin') }}>
      <a href="/admin/users">
        <i class="fa fa-users"></i>
        <span class="link-title">&nbsp;Admin Management</span>
        <span class="fa arrow"></span>
      </a>
      <ul>
        <li {{ LayoutHelper::setActiveClass('admin.list') }}>
          <a href="/admin/users">
            <i class="fa fa-list"></i>&nbsp;Admin List</a>
        </li>
        <li {{ LayoutHelper::setActiveClass('admin.new') }}>
          <a href="/admin/users/new">
            <i class="fa fa-plus-square-o"></i>&nbsp;New Admin</a>
        </li>
      </ul>
    </li>

    <li class="nav-divider"></li>
    <li {{ LayoutHelper::setActiveClass('admin.product') }}>
      <a href="/admin/products">
        <i class="fa fa-desktop"></i>
        <span class="link-title">&nbsp;Product Management</span>
        <span class="fa arrow"></span>
      </a>
      <ul>
        <li {{ LayoutHelper::setActiveClass('admin.product.list') }}>
          <a href="/admin/products">
            <i class="fa fa-list"></i>&nbsp;Product List</a>
        </li>
        <li {{ LayoutHelper::setActiveClass('admin.product.new') }}>
          <a href="/admin/products/new">
            <i class="fa fa-plus-square-o"></i>&nbsp;New Product</a>
        </li>
      </ul>
    </li>
    <li {{ LayoutHelper::setActiveClass('admin.distributor') }}>
      <a href="/admin/distributor">
        <i class="fa fa-globe"></i>
        <span class="link-title">&nbsp;Distributor Management</span>
        <span class="fa arrow"></span>
      </a>
      <ul>
        <li {{ LayoutHelper::setActiveClass('admin.distributor.list') }}>
          <a href="/admin/distributor">
            <i class="fa fa-list"></i>&nbsp;Distributor List</a>
        </li>
        <li {{ LayoutHelper::setActiveClass('admin.distributor.new') }}>
          <a href="/admin/distributor/new">
            <i class="fa fa-plus-square-o"></i>&nbsp;New Distributor</a>
        </li>
      </ul>
    </li>

    <li class="nav-divider"></li>
    <li {{ LayoutHelper::setActiveClass('admin.banner') }}>
      <a href="/admin/banner">
        <i class="fa fa-desktop"></i>
        <span class="link-title">&nbsp;Banner Management</span>
        <span class="fa arrow"></span>
      </a>
      <ul>
        <li {{ LayoutHelper::setActiveClass('admin.banner.list') }}>
          <a href="/admin/banner">
            <i class="fa fa-list"></i>&nbsp;Banner List</a>
        </li>
        <li {{ LayoutHelper::setActiveClass('admin.banner.new') }}>
          <a href="/admin/banner/new">
            <i class="fa fa-plus-square-o"></i>&nbsp;New Banner</a>
        </li>
      </ul>
    </li>
    <li {{ LayoutHelper::setActiveClass('admin.rateconversion') }}>
      <a href="/admin/rateconversion">
        <i class="fa fa-dollar"></i>
        <span class="link-title">&nbsp;Conversion Rates</span>
      </a>
    </li>
    <li {{ LayoutHelper::setActiveClass('admin.markupfee') }}>
      <a href="/admin/markupfee">
        <i class="fa fa-money"></i>
        <span class="link-title">&nbsp;Mark Up Fee</span>
      </a>
    </li>

    <li class="nav-divider"></li>
    <li {{ LayoutHelper::setActiveClass('admin.testimonials') }}>
      <a href="/admin/testimonials">
        <i class="fa fa-envelope"></i>
        <span class="link-title">&nbsp;Testimonials</span>
      </a>
    </li>
    <li {{ LayoutHelper::setActiveClass('admin.category') }}>
      <a href="/admin/category">
        <i class="fa fa-cog"></i>
        <span class="link-title">&nbsp;Category</span>
      </a>
      <ul>
        <li {{ LayoutHelper::setActiveClass('admin.category.newSubCategory') }}>
          <a href="/admin/category/new-category">
            <i class="fa fa-plus-square-o"></i>&nbsp;New Category</a>
        </li>
        <li {{ LayoutHelper::setActiveClass('admin.category.sortingCategory') }}>
          <a href="/admin/category/management-sorting-category/root">
            <i class="fa fa-cog"></i>&nbsp;Sorting Category</a>
        </li>
      </ul>
    </li>
    
    <li class="nav-divider"></li>
    <li>
      <a href="/">
        <i class="fa fa-home"></i>
        <span class="link-title">
          Go to Front End
        </span>
      </a>
    </li>
    <li>
      <a href="/admin/sessions" data-method="delete">
        <i class="fa fa-sign-out"></i>
        <span class="link-title">
          Sign Out
        </span>
      </a>
    </li>
  </ul><!-- /#menu -->
</div><!-- /#left -->
