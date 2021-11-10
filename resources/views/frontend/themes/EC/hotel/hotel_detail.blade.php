@extends('frontend.themes.EC.layouts.main')
{{--  For Title --}}
@section('title', 'Global search availability')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
<script type="text/javascript" src="{{ asset('themes/EC/js/global-availability-search.js') }}"></script>
<div class="content-em">
<div class="top-wrapper" id="main-content">
  <div class="slide-023k4"></div>
  <div class="slider-bg-inner">
    <div class="container">
      <div class="row mt-5">
        <div class="col-lg-4 mb-4 pt-3">
            @include('frontend.themes.EC.hotel.sidebar_nav')
        </div>        
        @include('frontend.themes.EC.hotel.subtemplates.hotel_detail')
      </div>
    </div>
  </div>
</div>
</div>
@endsection
