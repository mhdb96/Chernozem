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
    <div class="col-lg-12 col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Edinme Grafiği</h3>
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

    <div class="col-lg-12 col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Proje Oluşturulma Grafiği</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="projectChart" style="height: 230px; width: 787px;" width="787" height="230"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
    $(document).ready(function() { 
        new Chart(document.getElementById("userChart"), {
            type: 'line',
            data: {
            labels: [
                @foreach($montlyCustomerCount as $count)
                    {{ $count->month }},
                @endforeach
            ],
            datasets: [
                    { 
                        data: [
                            @foreach($montlyCustomerCount as $count)
                                {{ $count->count_customer }},
                            @endforeach
                        ],
                        label: "2019 Yılı Aylık Kullanıcı Sayıları",
                        borderColor: "#00C0EF",
                        fill: true
                    }
                ]
            }
        });

        new Chart(document.getElementById("projectChart"), {
            type: 'line',
            data: {
            labels: [
                @foreach($montlyProjectCount as $count)
                    {{ $count->month }},
                @endforeach
            ],
            datasets: [
                    { 
                        data: [
                            @foreach($montlyProjectCount as $count)
                                {{ $count->count_project }},
                            @endforeach
                        ],
                        label: "2019 Yılı Aylık Proje Sayıları",
                        borderColor: "#00A65A",
                        fill: true
                    }
                ]
            }
        });
    });
</script>    
@endpush 