@extends('layouts.master')

@section('title', 'Toprak Türleri')

@section('content-title', 'Toprak Türleri')
@section('content-description', $soil->name.' Güncelle')
@section('breadcrumb-title', 'Toprak Türleri')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">{{ $soil->name }} Güncelle</h3>
          </div>

          <form class="form-horizontal" action="{{ route('soil.update', $soil->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Ad</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Toprak Türü Adı" value="{{ $soil->name }}">
                    </div>
                </div>  

                <div class="form-group">
                    <label for="fertility" class="col-sm-2 control-label">Verimlilik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="fertility" id="fertility" placeholder="Toprak Verimliliği" value="{{ $soil->fertility }}">
                    </div>
                </div> 

            </div>

            <div class="box-footer">
                <a href="{{ route('soil.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Güncelle</button>
            </div>

          </form>

        </div>
      </div>
    </div>
</section>
@endsection