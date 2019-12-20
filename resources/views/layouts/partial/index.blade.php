@extends('layouts.partial.container')
@section('content')
<section class="content">
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header" style="padding: 20px 10px">
            <h3 class="box-title">{{$title}} Türleri</h3>

            <div class="box-tools" style="top: 12px">
              <a href="{{ route($route.'.create') }}" class="btn btn-block btn-success">
                <i class="fa fa-plus"></i> Yeni Ekle
              </a>
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th style="width: 35px">#</th>
                @foreach ($fillables_titles as $fillable)
                <th style="width: 100px">{{$fillable}}</th>
                @endforeach
              <th style="width: {{$empty_space}}px;"></th>
              </tr>
              @foreach ($data as $key => $item)
                <tr>
                  <td>{{ ++$key }}</td>
                  @foreach ($fillables as $fillable)
                  <td>{{ $item->$fillable}}</td>
                @endforeach

                  <td style="text-align: right;">
                    <a href="{{ route($route.'.edit', $item->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Düzenle">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <form action="{{ route($route.'.destroy', $item->id)}}" method="POST" style="display: initial">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Sil" onclick="return confirm('Bu {{strtolower($title)}} silmek istediğinizden emin misiniz?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>

                  </td>
                </tr>
              @endforeach
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
