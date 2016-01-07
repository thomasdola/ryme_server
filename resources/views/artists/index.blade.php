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

    <section class="content">

        <div class="row margin-bottom">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Artists Joined today</span>
                        <span class="info-box-number">1,410</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Artists Joined this Week</span>
                        <span class="info-box-number">410</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Artists Joined this month</span>
                        <span class="info-box-number">13,648</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Artists</span>
                        <span class="info-box-number">93,139</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div>

        <div class="row margin">
            <div class="input-group col-md-5 col-md-offset-3">
                <input type="text" class="form-control" placeholder="search for artists...">
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" type="button">
                          <span class="fa fa-search"></span>
                      </button>
                    </span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Trending Artists</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Categories</th>
                                <th>followers</th>
                                <th>tracks</th>
                            </tr>
                            <tr>
                                <td>183</td>
                                <td>John Doe</td>
                                <td>John Doe</td>
                                <td>11-7-2014</td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vouching Request(s)</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Stage Name</th>
                                <th>Categories</th>
                                <th>Vouch(es)</th>
                                <th>Days Left</th>
                                <th>Request Made</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>John Doe</td>
                                <td>John Doe</td>
                                <td>John Doe</td>
                                <td>11-7-2014</td>
                                <td>1</td>
                                <td>
                                    <button type="button">cancel</button>
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection