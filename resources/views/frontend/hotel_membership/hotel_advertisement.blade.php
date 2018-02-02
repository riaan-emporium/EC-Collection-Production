
@extends('frontend.layouts.ev.customer')
@section('content')
<style type="text/css">
    
.hotel-book-now {
                background: #ABA07C;
                color: #fff;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }

</style>
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                    <div class="container-fluid">


                    	       <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a  type="button" class="btn btn-default btn-circle cursor" >3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                        <div class="row equalize sm-equalize-auto">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
							@if (!empty($packages))
								<ul class="image-slider">
									{{--*/ $k=1; $tottyp = count($packages); /*--}}
									@foreach($packages as $key=>$package)
									<li class="{{($k==1) ? 'active' : ''}}">
                                        <a href="#">
                                            <img class="img-responsive object-fit-size" src="{{asset('uploads/properties_subtab_imgs/69726129-32146277.jpg')}}" style="height:580px; width: 100%;">
                                        </a>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="image-slider-btns-bg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="slider-sec-side-text-bg">
                                                            <div class="slider-side-sec-alignment">
                                                                <div class="expeience-small-text">Advertisement Packages</div>
                                                                <div class="slider-side-text-tittle">{{$package->space_title}}</div>
                                                                <div class="slider-side-description-text">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img class="slider-next-image-btn img-responsive" src="{{asset('uploads/properties_subtab_imgs/69726129-32146277.jpg')}}" alt="">
                                                                <a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn ClickButton">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
									{{--*/ $k++; /*--}}
												
									@endforeach

                                </ul>
                                <div class="clearfix"></div>
                                <div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
                                <div class="editorial-image-slider-btns image-slider-btns">
                                    <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt="">
                                    </a>
                                    <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt="">
                                    </a>
                                </div>
								@endif
                            </div>
                        </div>
                    </div>
                </section>



<!--Accordan Code -->
<div class="col-sm-12" >
@if (!empty($packages))
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  

{{--*/ $k=1; $tottyp = count($packages); /*--}}
@foreach($packages as $key=>$package)
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading{{ $k }}">
      <h4 class="panel-title">
        <a  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $k }}" {{($k==1) ? 'aria-expanded="true" ' : ' aria-expanded="false" class="collapsed"'}} aria-controls="collapse{{ $k }}">
          {{$package->space_title}}  :: {{ $package->id }} :: Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->space_cpd_price,2) }}
        </a>
      </h4>
    </div>
    <div id="collapse{{ $k }}" class="panel-collapse collapse {{($k==1) ? 'in ' : ''}}" role="tabpanel" aria-labelledby="heading{{ $k }}">
      <div class="panel-body">        
            <div>
                <div  style="width:20%; padding-right: 1%;" class="pull-left">
                    <img class="img-responsive object-fit-size" src="{{asset('uploads/properties_subtab_imgs/69726129-32146277.jpg')}}" >



                 

                </div>
                <div class="pull-right" style="width:80%">
                    <p>Package Duration ::  </p>  
                    <p>Package Details: </p>

                     <div class="book-btn-sec">
               
                    
                        <div class="hotel-book-price">
                          {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->space_cpd_price,2) }}
                        </div>
                       <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->space_cpd_price }});"><div class="hotel-book-now">Add to cart</div></a>
                 
                    
                 
                </div>
                </div>
           </div>
      </div>
    </div>
</div>


    {{--*/ $k++; /*--}}
                                                
 @endforeach


</div>
@endif
</div>
<!-- end accrodan code -->
  
@endsection


@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">

@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection
 <!-- contact email aside -->
 <script>


function addToCartHotel(packagePrice,PackageID){
    

        var packagePrice=packagePrice;
        var PackageID=PackageID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Package added to cart successfully.");
        }
        };
        xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+packagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
        xhttp.send();

}


 </script>


