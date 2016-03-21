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
                        <span class="info-box-number">@{{ data.joinedToday.total | abbreviate }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Artists Joined this Week</span>
                        <span class="info-box-number">@{{ data.joinedThisWeek.total | abbreviate }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Artists Joined this month</span>
                        <span class="info-box-number">@{{ data.joinedThisMonth.total | abbreviate }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Artists</span>
                        <span class="info-box-number">@{{ data.all.total | abbreviate }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div>

        <div class="row margin">
            <search></search>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <trending-artists :artists="data.artists"></trending-artists>
            </div>

            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vouching Request(s)</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <vouching-requests :requests="data.requests"></vouching-requests>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/artists.js', false) }}"></script>
@endsection