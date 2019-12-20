@extends('layouts.master')

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
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$item->id}})">
                      <i class="fa fa-trash"></i>
                    </button>
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
            <p>Bu toprak türünü silmek istediğinizden emin misiniz?</p>       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hayır</button>
          <button type="button" class="btn btn-primary" onclick="formSubmit()">Evet</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("soil.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
@endpush