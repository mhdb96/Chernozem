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
@endsection   