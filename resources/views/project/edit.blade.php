@extends('layouts.master')

@section('title', ' Kit Ekleme Formu')

@section('content-title', 'asd')
@section('content-description', 'Kit Ekleme Formu')
@section('breadcrumb-title', 'Pakete Kit Ekle')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">asd Kit Ekleme Formu</h3>
        </div>

        <form class="form-horizontal" action="{{ route('project.store') }}" method="POST">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="kits" class="col-sm-2 control-label">Kitler</label>
                    <div class="col-sm-8">
                        
                        
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('project.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Ekle</button>
            </div>

        </form>

      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')

@endpush 