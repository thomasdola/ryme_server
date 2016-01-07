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
    <div class="row">
        <div class="col-md-3">

            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">New Category</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Category Name">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-plus"></span>
                                Create
                            </button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Categories</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="#">
                                <i class="fa fa-box"></i>
                                Dancehall
                                <span class="label label-danger pull-right">12 k</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->

        </div><!-- /.col -->
        <div class="col-md-9">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#trending_tracks" data-toggle="tab">Trending Tracks</a></li>
                    <li><a href="#trending_artists" data-toggle="tab">Trending Artists</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="trending_tracks">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Artist(s)</th>
                                        <th>Stream(s)</th>
                                        <th>Download(s)</th>
                                        <th>Favorite(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                    <td class="mailbox-attachment"></td>
                                </tr>
                                </tbody>
                            </table><!-- /.table -->
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="trending_artists">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>followers</th>
                                        <th>tracks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject">AdminLTE 2.0 Issue</td>
                                    <td class="mailbox-attachment"></td>
                                </tr>
                                </tbody>
                            </table><!-- /.table -->
                        </div>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection