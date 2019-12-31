@extends('layouts.master')

@section('title', $project->name.' Listesi')

@section('content-title', $project->name)
@section('content-description', 'Listesi')
@section('breadcrumb-title', $project->name)

@section('content')
<section class="content">
    <div class="row">
        @foreach ($projectAreas as $item)
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h2>{{ $item->name }}</h2>
                    </div>
                    <div class="icon greenhouse"></div>
                    <a href="{{ route('project-area.show', $item->id) }}" class="small-box-footer">
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