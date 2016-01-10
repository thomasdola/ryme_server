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

        <div class="row margin-bottom">
            <div class="col-md-4">
                <div class="box collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Company</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Category Name">
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <span class="fa fa-plus"></span>
                                    Add
                                </button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-8">
                <div class="box collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Ad</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="adTitle">Title</label>
                                    <input type="text" name="title" required class="form-control" id="adTitle" placeholder="Ad Title">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adStartDate">Starting On</label>
                                            <input type="text" name="start_date" class="form-control" id="adStartDate"
                                                   placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adEndDate">Ending On</label>
                                            <input type="text" name="end_date" class="form-control" id="adEndDate"
                                                   placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyName">Name of Company</label>
                                    <select type="text" name="company_name" data-placeholder="Select company..."
                                            class="form-control select2" id="companyName"  style="width: 100%;">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <span class="fa fa-plus"></span>
                                    Create
                                </button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
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