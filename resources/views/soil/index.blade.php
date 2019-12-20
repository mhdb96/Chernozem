@extends('layouts.partial.index')
{{-- @extends('layouts.master')

@section('title', 'Toprak Türleri')

@section('breadcrumb-title', 'Toprak Türleri')

@section('content')
<section class="content">
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header" style="padding: 20px 10px">
            <h3 class="box-title">Toprak Türleri</h3>

            <div class="box-tools" style="top: 12px">
              <a href="{{ route('soil.create') }}" class="btn btn-block btn-success">
                <i class="fa fa-plus"></i> Yeni Ekle
              </a>
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th style="width: 35px">#</th>
                <th style="width: 200px">Toprak Türü</th>
                <th>Verimliliği</th>
                <th style="width: 100px;"></th>
              </tr>
              @foreach ($soils as $key => $item)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->fertility }}</td>
                  <td style="text-align: right;">
                    <a href="{{ route('soil.edit', $item->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Düzenle">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <form action="{{ route('soil.destroy', $item->id)}}" method="POST" style="display: initial">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Sil" onclick="return confirm('Bu fakülteyi silmek istediğinizden emin misiniz?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>

                  </td>
                </tr>
              @endforeach
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
</section>
@endsection --}}
