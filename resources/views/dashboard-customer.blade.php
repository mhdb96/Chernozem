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
@endsection   