
@extends('frontend.themes.EC.layouts.main')
{{--  For Title --}}
@section('title', 'Global search availability')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
<style>
    .experiences{
        cursor: pointer;
    }
</style>
@section('content')
<div class="content-em">
  <div class="top-wrapper">
    <div class="container ">

      @include('frontend.themes.EC.reservation.nav_wizard')
      
      <div id="step-4" class="tab-pane" role="tabpanel">
        <h2 class="mb-5 d-flex align-items-center">
          <a href="#" class="backwizard btn-backwizard">
            <i class="ico ico-back mr-3"></i>
          </a>
          Suite Board 
        </h2>
      <div class="row">
      <div class="col-lg-9 col-md-8">
        <div class="suite-board d-block section-shadow">
          <div class="suite-board-header">
            <div class="row align-items-center">
              <div class="col-2 col---s">
                <img src="{{ asset('/images/car-acc-room-superior-double-inroom-breakfast01_320x266.jpg')}}" class="img-full"
                  alt="">
              </div>
              <div class="col">
                
                  <h3>{!! Session::get('suite_name') !!}</h3>
                
              </div>
            </div>
          </div>
          <div class="row suite-board-body">
            @foreach($suitesboards[0]->boards as $data)
              <div class="col-lg-4 col-md-12 suite-price-feature">
                <div class="suite-board-main">
                  <h4>{{ $data->board_name }}</h4>
                  <ul class="pl-3">
                    <li>Accommodation</li>
                    <li>Daily breakfast</li>
                  </ul>
                </div>
                <div class="suite-board-footer">                  
                  <div class="footer-sdse">
                    <p>€{{ $data->board_rackrate }} per night inclusive of all taxes and fees</p>
                    <a href="/reservation/policies" class="btn btn-dark btn-block rounded-0 btn-nextwizard">Select</a>
                  </div>
                </div>
              </div>
              @endforeach              
          </div>            
        </div>
      </div>
      <div class="col-lg-3 col-md-4">

        @include('frontend.themes.EC.reservation.reservation-summary')
        <?php $pos=1 ?>
        @if(!empty($suites))
        
          @foreach($suites as $suite)
            @foreach($suite as $value)
              <div class="reservation-summary section-shadow">
                <h4>SUITE &nbsp; {{ $pos++ }}</h4>
                <p><b>{{ $value->category_name }}</b></p>
                <table class="table table-borderless mb-0"> 
                    <tr>
                      <td class="px-0 py-1">Guests</td>
                      @foreach($selected_suite as $key => $select_suite)
                      <td class="px-0 py-1 text-right">{{ $key == $value->id ?  $select_suite : ''}}</td>
                      @endforeach
                    </tr>
                  <tr>
                    <td class="px-0 py-1">Suite</td>
                    <td class="px-0 py-1 text-right"> € {{ $value->guests_in_base_price }}</td>
                  </tr>
                  <tr>
                    <td class="px-0 py-1">Tax</td>
                    <td class="px-0 py-1 text-right">€299.00</td>
                  </tr>
                </table>
                <hr class="mb-2">
                <table class="table table-borderless mb-0">
                  <tr>
                    <td class="px-0 py-1">Gourmet Experience</td>
                    <td class="px-0 py-1 text-right">2</td>
                  </tr>
                </table>
                <hr class="mt-2">
                <table class="table table-borderless mb-0">
                  <tr>
                    <td class="px-0 py-1">Subtotal</td>
                    <td class="px-0 py-1 text-right"><b>€ {{ $value->guests_in_base_price }}</b></td>
                  </tr>
                </table>
              </div>
            @endforeach
          @endforeach
          @else
            <h2>Suite Not Found</h2>
        @endif  
        <div class="reservation-total">
          <table class="table table-borderless mb-0">
            <tr>
              <td class="px-0 py-1">Total</td>
              <td class="px-0 py-1 text-right">€4.598.00</td>
            </tr>
          </table>
        </div>
      </div>
      </div>
  </div>
  </div>
</div>
</div>
@endsection

