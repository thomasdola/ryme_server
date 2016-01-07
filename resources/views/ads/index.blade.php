@extends('master-pages.master')

@section('content')

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
                    <span class="info-box-icon bg-aqua"><i class="fa fa-tv"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Active Ads</span>
                        <span class="info-box-number">1,410</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-tv"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Paused Ads</span>
                        <span class="info-box-number">410</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-tv"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Ads</span>
                        <span class="info-box-number">13,648</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Companies</span>
                        <span class="info-box-number">93,139</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div>

        <div class="row margin">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Active Ads</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Schedule</th>
                            <th>Started On</th>
                            <th>Ending On</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>
                                <button type="button">stop</button>
                            </td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </section>
@endsection