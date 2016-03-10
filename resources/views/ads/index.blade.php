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
                        <h3 class="box-title">Add Ad Session</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form" @submit.prevent="saveSession">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Session Name</label>
                                    <input
                                            v-model="newSession.name"
                                            type="text" class="form-control"
                                            id="name" placeholder="Session Name">
                                </div>
                                <div class="form-group">
                                    <label for="start">Start Time</label>
                                    <input type="time"
                                           v-model="newSession.start"
                                           class="form-control" id="start" placeholder="Start time">
                                </div>
                                <div class="form-group">
                                    <label for="end">End Time</label>
                                    <input type="time"
                                           v-model="newSession.end"
                                           class="form-control" id="end" placeholder="End time">
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
                    <div class="overlay" v-show="savingSession">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div><!-- /.box -->
                <div class="box collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Company</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form" @submit.prevent="saveCompany">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <input
                                            v-model="newCompany.name"
                                            type="text" class="form-control"
                                            id="name" placeholder="Category Name">
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
                    <div class="overlay" v-show="savingCompany">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-8">
                <div class="box collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Ad</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="active"><a href="#event_ad_tab" data-toggle="tab">Event Ads</a></li>
                                <li><a href="#audio_ad_tab" data-toggle="tab">Audio Ads</a></li>
                                <li class="pull-left header"><i class="fa fa-th"></i> Ads</li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="event_ad_tab">
                                    <form role="form" @submit.prevent="saveEventAd">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="adTitle">Title</label>
                                                <input v-model="newEventAd.title" type="text"
                                                       name="title" required class="form-control"
                                                       id="adTitle" placeholder="Ad Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="adVenue">Venue</label>
                                                <input v-model="newEventAd.venue" type="text"
                                                       name="venue" required class="form-control"
                                                       id="adVenue" placeholder="Ad Venue">
                                            </div>
                                            <div class="form-group">
                                                <label for="adDateTime">Date & Time</label>
                                                <input v-model="newEventAd.dateTime" type="datetime-local"
                                                       name="date_time" required class="form-control"
                                                       id="adDateTime" placeholder="Ad Date and Time">
                                            </div>
                                            <div class="form-group">
                                                <label for="adDescription">Description</label>
                                                <input v-model="newEventAd.description" type="text"
                                                       name="description" required class="form-control"
                                                       id="adTitle" placeholder="Ad Description">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adStartDate">Starting On</label>
                                                        <input required v-model="newEventAd.startDate" type="date"
                                                               name="start_date" class="form-control"
                                                               id="adStartDate" placeholder="Start Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adEndDate">Ending On</label>
                                                        <input required v-model="newEventAd.endDate" type="date"
                                                               name="end_date" class="form-control"
                                                               id="adEndDate" placeholder="End Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adSession">Ad Categories</label>
                                                        <select multiple required v-model="newEventAd.category_id"
                                                                class="form-control" id="adSession"  style="width: 100%;">
                                                            <option v-for="category in categories"
                                                                    :value="category.id">
                                                                @{{ category.name | capitalize }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adSession">Ad sessions</label>
                                                        <select multiple required v-model="newEventAd.session_id" name="session_id"
                                                                data-placeholder="Select session..."
                                                                class="form-control" id="adSession"  style="width: 100%;">
                                                            <option v-for="session in sessions"
                                                                    :value="session.id">
                                                                @{{ session.name | capitalize }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Name of Company</label>
                                                <select required v-model="newEventAd.company_id" name="company_name"
                                                        data-placeholder="Select company..."
                                                        class="form-control" id="companyName"  style="width: 100%;">
                                                    <option v-for="company in companies"
                                                            :value="company.id">
                                                        @{{ company.name | capitalize }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="audio">Ad Cover</label>
                                                <input accept="image/*" required @change="onImageChange" v-el="image" type="file"
                                                       name="image" id="image" class="form-control">
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <span class="fa fa-plus"></span>
                                                Create
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="audio_ad_tab">
                                    <form role="form" @submit.prevent="saveAd">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="adTitle">Title</label>
                                                <input v-model="newAd.title" type="text"
                                                       name="title" required class="form-control"
                                                       id="adTitle" placeholder="Ad Title">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adStartDate">Starting On</label>
                                                        <input required v-model="newAd.startDate" type="date"
                                                               name="start_date" class="form-control"
                                                               id="adStartDate" placeholder="Start Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adEndDate">Ending On</label>
                                                        <input required v-model="newAd.endDate" type="date"
                                                               name="end_date" class="form-control"
                                                               id="adEndDate" placeholder="End Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adSession">Ad Categories</label>
                                                        <select multiple required v-model="newAd.category_id"
                                                                class="form-control" id="adSession"  style="width: 100%;">
                                                            <option v-for="category in categories"
                                                                    :value="category.id">
                                                                @{{ category.name | capitalize }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="adSession">Ad sessions</label>
                                                        <select multiple required v-model="newAd.session_id" name="session_id"
                                                                data-placeholder="Select session..."
                                                                class="form-control" id="adSession"  style="width: 100%;">
                                                            <option v-for="session in sessions"
                                                                    :value="session.id">
                                                                @{{ session.name | capitalize }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Name of Company</label>
                                                <select required v-model="newAd.company_id"
                                                        data-placeholder="Select company..."
                                                        class="form-control" id="companyName"  style="width: 100%;">
                                                    <option v-for="company in companies"
                                                            :value="company.id">
                                                        @{{ company.name | capitalize }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="audio">Ad Audio file</label>
                                                <input accept="audio/*" required @change="onAudioChange" type="file"
                                                       name="audio" id="audio" class="form-control">
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <span class="fa fa-plus"></span>
                                                Create
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div><!-- /.tab-content -->
                        </div>
                    </div><!-- /.box-body -->
                    <div class="overlay" v-show="savingAd">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
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

@section('scripts')
    <script src="{{ asset('js/companies.js') }}"></script>
@endsection