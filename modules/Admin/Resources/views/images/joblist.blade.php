@extends('admin::layouts.admin')

@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Jobs</h3>

      <div class="box-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input name="table_search" class="form-control pull-right" placeholder="Search" type="text">

          <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tbody><tr>
          <th>ID</th>
          <th>Job</th>
          <th>Male</th>
          <th>Female</th>
          <th>&nbsp;</th>
        </tr>
        @foreach($jobs as $jobId => $job)
          <tr>
            <td>{{$jobId}}</td>
            <td>{{$job->name}}</td>
            <td></td>
            <td><span class="label label-success">Approved</span></td>
            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop