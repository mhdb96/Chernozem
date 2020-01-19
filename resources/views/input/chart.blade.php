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
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Gecmis {{$input->name}} Degerlerin Ortamalri</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="userChart" style="height: 230px; width: 787px;" width="787" height="230"></canvas>
                    </div>
                </div>
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

        new Chart(document.getElementById("userChart"), {
            type: 'line',
            data: {
            labels: [
                @foreach($time as $t)
                    '{{ $t }}',
                @endforeach
            ],
            datasets: [
                    { 
                        data: [
                            @foreach($values as $value)
                                {{ $value }},
                            @endforeach
                        ],
                        label: '{{$input->name}} Ortamalar',
                        borderColor: "#00C0EF",
                        fill: true
                    }
                ]
            }
        });

        setInterval(function() {            
            drawChart(chart, fetchedData, '{{$input->firebase_code}}', '{{$input->name}}');
        }, 5000);


    });
</script>    
@endpush 