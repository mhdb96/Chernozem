@extends('layouts.master')

@section('title', ' Kit Ekleme Formu')

@section('content-title', 'asd')
@section('content-description', 'Kit Ekleme Formu')
@section('breadcrumb-title', 'Pakete Kit Ekle')

@section('content')
<section class="content">
    <div class="row">
        @foreach ($projectAreas as $item)
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $item->name }}</h3>
                    </div>
                    <div class="icon greenhouse"></div>
                    <a href="#" class="small-box-footer">
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