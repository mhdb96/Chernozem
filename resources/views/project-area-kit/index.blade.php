@extends('layouts.partial.container')
@section('content')
<section class="content">
    <div class="row">
      @include('layouts.include.alert')

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header" style="padding: 20px 10px">
            <h3 class="box-title">Kitlere {{$title}} Adresleri ekle</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th style="width: 35px">#</th>
                @foreach ($fillables_titles as $fillable)
                <th style="width: 200px">{{$fillable}}</th>
                @endforeach
              <th style="width: {{$empty_space}}px;"></th>
              </tr>
              @foreach ($data as $key => $item)
                <tr>
                  <td>{{ ++$key }}</td>
                  @foreach ($fillables as $fillable)                  
                  @if (is_array($item->$fillable))                
                    <td style="width : 500px;">
                      @foreach ($item->$fillable as $f)                                            
                      {{$f}} <br>                      
                      @endforeach
                    </td>
                  @else
                    <td>{{ $item->$fillable}}</td>
                  @endif
                @endforeach

                  <td style="text-align: right;">
                    <a href="{{ route($route.'.edit', $item->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Düzenle">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
          </div>
        </div>
      </div>
    </div>
</section>

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" id="deleteForm">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">UYARI</h4>
          </div>
          <div class="modal-body">
              @csrf
              @method('DELETE')
              <p>Bu {{$title}} türünü silmek istediğinizden emin misiniz?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hayır</button>
            <button type="button" class="btn btn-primary" onclick="formSubmit()">Evet</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script type="text/javascript">
    function deleteData(id, route)
    {
        var id = id;
        var url = `{{ route("${route}.destroy", ":id") }}`;
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
@endpush
