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
                    <h3 class="box-title">New Role</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Role Title</label>
                                <input type="text" class="form-control" id="name" placeholder="Role Title">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-plus"></span>
                                Add
                            </button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                Role Title
                                <span class="label label-danger pull-right">12</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">New Staff</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Staff Name</label>
                                <input type="text" class="form-control" id="staffName" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">Staff Email</label>
                                <input type="email" class="form-control" id="StaffEmail" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="password">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-plus"></span>
                                Add
                            </button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
        <div class="col-md-9">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Staff</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td>
                                <button type="button">edit</button>
                            </td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection