@extends('layouts.master')

@section('title', $input->name.' Anlık Veri Akışı')

@section('content-title', $input->name)
@section('content-name', ' Anlık Veri Akışı')
@section('breadcrumb-title', $input->name)

@section('content')
<section class="content">    
    <div class="row">
        <div class="col-xs-12">
            <canvas id="input-chart" width="800" height="300"></canvas>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase.js"></script>
<script src="{{ asset('js/firebase.js') }}"></script>
<script src="{{ asset('js/jquery.flot.js') }}"></script>
<script src="{{ asset('js/jquery.flot.resize.js') }}"></script>

<script>
    $(document).ready(function() { 
        var chart = document.getElementById("input-chart").getContext("2d");  
        var fetchedData = firebase.database().ref('{{ $mac_adress }}/Data/{{ $input->firebase_code }}');

        drawChart(chart, fetchedData, '{{$input->firebase_code}}', '{{$input->name}}');

        setInterval(function() {            
            drawChart(chart, fetchedData, '{{$input->firebase_code}}', '{{$input->name}}');
        }, 5000);
    });
</script>    
@endpush 