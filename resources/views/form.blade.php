@extends('layouts.master')

@section('title', 'Dashboard')

@section('content-title', 'Form Page')
@section('content-description', 'Form Page')
@section('breadcrumb-title', 'Form Page')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">Form Page</h3>
          </div>

          <form class="form-horizontal">

            <div class="box-body">
              <div class="form-group">
                <label for="example" class="col-sm-2 control-label">Example title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="example" id="example" placeholder="Example value">
                </div>
              </div>  

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-default">Back</button>
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>

          </form>

        </div>
      </div>
    </div>
</section>
@endsection