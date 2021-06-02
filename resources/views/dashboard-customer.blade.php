@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    @foreach ($dashboardCountList as $listItem)
        <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-{{ $listItem['background'] }}">
                <div class="inner">
                    <h3>{{ $listItem['count'] }}</h3>
                    <p>{{ $listItem['name'] }}</p>
                </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-bullhorn"></i>
                <h3 class="box-title">Bildirimler</h3>
            </div>
            <div class="box-body">
                @foreach ($notifications as $notification)
                    <div class="callout callout-info">
                        <h4>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</h4>
                        <p>{{ $notification->notification }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-picture-o"></i>
                <h3 class="box-title">Yapay Zekayı kullanarak Bitkilerde hastalık tespit modülü</h3>
            </div>
            <div class="box-body">
                <p>Analiz etmek istediğiniz fotoğrafı yükleyin:</p>
                <form method=post action="" enctype=multipart/form-data id="myform">
                    <input style="margin-bottom: 5px;" type="file" id="file" name="file" />
                    <input class="btn btn-default" type="button" class="button" value="Analiz Et" id="but_upload">
                </form>
            </div>
            <div id="data_container">

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){
//     $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
$("#but_upload").click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files;

    // Check file selected or not
    if(files.length > 0 ){
       fd.append('file',files[0]);

       $.ajax({
          url: 'http://127.0.0.1:5000/analyze',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
              console.log("frgfre")
             if(response != 0){
                //alert(response);
                $("#data_container").html("");
                if(response.includes('Disease: No disease')){
                    $('#data_container').append(`<div  id="d_info" class="callout callout-success" style="background-color: #ffffff !important; color: #000000 !important;"></div>`);

                }
                else {
                    $('#data_container').append(`<div id="d_info" class="callout callout-danger" style="background-color: #ffffff !important; color: #000000 !important;"></div>`);
                }
                $('#d_info').append(response);
             }else{
                alert('file not uploaded');
             }
          },
       });
    }else{
       alert("Lütfen bir fotoğraf seçiniz");
    }
});
});
</script>
@endpush
