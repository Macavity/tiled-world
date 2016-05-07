<?php
/**
 * @param \App\User $user currently logged in user
 */
?>
<!-- Left side column -->
<aside class="main-sidebar">
  <!-- sidebar -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset("images/avatars/51.head.png") }}" class="img-circle" alt="" />
      </div>
      <div class="pull-left info">
        <p>{{ $user->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..." />
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- sidebar menu -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{{route('admin::dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-picture"></i>
          <span>Image Positions</span>
          <span class="label label-primary pull-right">2</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/images/job/')}}"><i class="fa fa-circle-o"></i> Job</a></li>
          <li><a href="{{url('admin/images/headgear/')}}"><i class="fa fa-circle-o"></i> Headgear</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>