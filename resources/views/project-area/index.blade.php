@extends('layouts.master')

@section('title', $projectArea->name.' Kit Listesi')

@section('content-title', $projectArea->name)
@section('content-description', 'Kit Listesi')
@section('breadcrumb-title', $projectArea->name)

@section('content')
<section class="content">
    <div class="row">

        @include('layouts.include.alert')

        @foreach ($kits as $item)
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h2>{{ $item->name }}</h2>
                    </div>
                    <div class="icon sensor"></div>
                    <a href="{{ route('kit.show', $item->id) }}?project_area_id={{ $projectArea->id }}" class="small-box-footer">
                        İncele <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
 
@endpush 