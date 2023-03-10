<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader " data-option="home" data-option-type="logo"><a href="{{url('/')}}"><img
                            src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage"
                            class="img-responsive"/></a></div>
            <div class="mobilenavheader hide" data-option="child-global">
                <h3 data-option-title="global"></h3>
                <a  class="homelinknav backtohomelink cursor" data-option-action="back"
                   data-option-action-type="home" data-id="0"><i class="fa fa-angle-left"></i> <span>HOME</span></a>
            </div>
            <ul class="mobilemenulist common-search-bar" data-option="search-bar">
                {{-- Global Search Bar --}}
                @include('frontend.themes.emporium.layouts.sections.global-search-bar')
                {{-- End Global Search Bar --}}

                <li data-option="intro-text" class="hide">
                    <p></p>
                </li>
                <li class="hide" data-option="selected-thumb">
                    <div class="navheadimage">
                        <img data-option="selected-thumb-img" alt=""/>
                        <div class="headingoverlay" data-option="selected-thumb-text"></div>
                    </div>
                </li>
            </ul>
            <ul class="mobilemenulist" data-option="home">
                <li><a class="cursor">Hotel Social Channels</a></li>
				@if(!empty($propertiesArr))
				{{--*/ usort($propertiesArr, function($a, $b) {
						return trim($a->property_name) > trim($b->property_name);
				}); /*--}}
					<li>
						<ul class="mobilesublinks">
							@foreach($propertiesArr as $property)
								<li><a class="cursor menu_item" href="{{URL::to('social-stream?sp='.$property->property_slug)}}">{{$property->property_name}}</a></li>
							@endforeach
						</ul>
					</li>
				@endif
                <li><a class="cursor" data-action="select-menu" data-position="business" data-id="0">COMPANY</a></li>
            </ul>
            <ul class="mobilemenulist hide socialyoutubemenu" data-option="selected-option-list">
            </ul>
            @if (!Auth::check())

            <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob"
                                                                                     href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
            </div>
            @endif
        </div>
        <div class="left-carousal">
            <div id="owl-carousel" class="owl-carousel">

                <div class="item">
                    <div class="side-bar-why-book-with-us">
                        <div class="book-with-us-tittles">
                            <h2>Why book with us?</h2>
                        </div>
                        {{--*/ $uspmod = CommonHelper::getUspMod() /*--}}
                        @if(!empty($uspmod['whybookwithus']))
                            <ul class="side-bar-book-with-us-list">
                                @foreach ($uspmod['whybookwithus'] as $usps)
                                    <li>
                                        <h3>{{$usps->title}}</h3>
                                        <p>{{$usps->sub_title}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                {{--*/ $sidebarads = CommonHelper::getSidebarAds('social_media_page', 'Hotel') /*--}}
                @if(!empty($sidebarads['leftsidebarads']))
                    @foreach($sidebarads['leftsidebarads'] as $ads)
                        <div class="item">
                            <a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}"></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>