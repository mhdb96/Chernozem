@extends('layouts.master')

@section('title', 'Pakete Kit Listesi')

@section('breadcrumb-title', 'Pakete Kit Listesi')

@section('content')
<section class="content">
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header" style="padding: 20px 10px">
            <h3 class="box-title">Paket Kit Listesi</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th style="width: 35px">#</th>
                <th style="width: 200px">Paket Adı</th>
                <th>Kitler</th>
                <th style="width: 100px;"></th>
              </tr>
              @foreach ($packets as $key => $packet)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $packet->name }}</td>
                  <td>
                    @if (count($packet->kits))
                      @foreach ($packet->kits as $kit)
                          {{ $kit->name }}<br>
                      @endforeach
                    @else
                        Henüz kit eklenmemiş.
                    @endif
                      
                  </td>
                  <td style="text-align: right;">
                    <a href="{{ route('packet-kit.edit', $packet->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Düzenle">
                      <i class="fa fa-plus"></i>
                    </a>
                    <form action="{{ route('packet-kit.destroy', $packet->id)}}" method="POST" style="display: initial">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Sil" onclick="return confirm('Bu veriyi silmek istediğinizden emin misiniz?');">
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
@endsection 