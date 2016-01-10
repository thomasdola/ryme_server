@extends('master-pages.master')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number">201.21 k</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Artist</span>
          <span class="info-box-number">41 k</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Tracks</span>
          <span class="info-box-number">760.121 k</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active Ads</span>
          <span class="info-box-number">2,000</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-8">
      <!-- TABLE: TRENDING TRACKS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Trending</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Title</th>
                <th>Artist(s)</th>
                <th>Category</th>
                <th>Streams</th>
                <th>Download</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="label label-warning">Pending</span></td>
                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>iPhone 6 Plus</td>
                <td><span class="label label-danger">Delivered</span></td>
                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="label label-info">Processing</span></td>
                <td><div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="label label-warning">Pending</span></td>
                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>iPhone 6 Plus</td>
                <td><span class="label label-danger">Delivered</span></td>
                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
              </tr>
              </tbody>
            </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-12">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Popular Artists</h3>
              <div class="box-tools pull-right">
                {{--<span class="label label-danger">8 New Members</span>--}}
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                <li>
                  <img src="{{ asset('img/user1-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Alexander Pierce</a>
                  <span class="users-list-date">Today</span>
                </li>
                <li>
                  <img src="{{ asset('img/user8-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Norman</a>
                  <span class="users-list-date">Yesterday</span>
                </li>
                <li>
                  <img src="{{ asset('img/user7-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Jane</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('img/user6-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">John</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('img/user2-160x160.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Alexander</a>
                  <span class="users-list-date">13 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('img/user5-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Sarah</a>
                  <span class="users-list-date">14 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('img/user4-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Nora</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('img/user3-128x128.jpg') }}" alt="User Image">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
              </ul><!-- /.users-list -->
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript::" class="uppercase">View More</a>
            </div><!-- /.box-footer -->
          </div><!--/.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

@endsection