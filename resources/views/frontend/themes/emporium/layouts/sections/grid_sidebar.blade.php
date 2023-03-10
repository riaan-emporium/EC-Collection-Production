<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader " data-option="home" data-option-type="logo">
                {{-- <a href="{{url('/')}}">
                    <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                </a> --}}
                @if(defined('CNF_FRONTEND_LOGO'))
                    @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                        <a href="{{url('/')}}">
                            <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                        </a>
                    @else
                        <a href="{{url('/')}}">
                            <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                        </a>
                    @endif
                @else
                    <a href="{{url('/')}}">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                    </a>
                @endif
            </div>
            <!--<div class="mobilenavheader hide" data-option="child-global">
                <h3 data-option-title="global"></h3>
                <a href="javascript:void(0)" class="homelinknav backtohomelink" data-option-action="back"
                   data-option-action-type="home" data-id="0"><i class="fa fa-angle-left"></i> <span>HOME</span></a>
            </div>-->
            <ul class="mobilemenulist common-search-bar" data-option="search-bar">
                {{-- Global Search Bar --}}
                @include('frontend.themes.emporium.layouts.sections.global-search-bar')
                {{-- End Global Search Bar--}}
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
               <!-- <li><a class="cursor" data-action="select-filter">FILTER BY PRICE</a></li>-->
                <li><a class="cursor" data-action="select-collection">SEARCH OUR COLLECTION</a></li>
                <li><a class="cursor" data-action="search-by-date">Search availability</a></li>
                <li><a class="cursor" data-action="select-destination" data-id="0">Search by destination</a></li>
                <li><a class="cursor" data-action="select-experience" >Search by Experience</a></li>
                <!--li><a href="javascript:void(0)" >PERSONALIZED SERVICE</a></li-->
                <!--<li><a class="cursor" data-action="company">COMPANY</a></li>-->
                <li><a class="cursor" data-action="select-destination-youtube">Search Destination Channel</a></li>
                <li><a class="cursor" data-action="select-menu" data-position="business" data-id="0">Company & Info</a></li>
                <li><a class="cursor EGloader" href="{{URL::to('memberships')}}" >Membership</a></li>
            </ul>
            <ul class="mobilemenulist hide" data-option="search-our-collection">
                <?php 
                    $m_collection = \DB::table('tb_categories')->where('category_alias', 'our-collection')->where('category_approved', 1)->where('category_published', 1)->first();                
                    if(!empty($m_collection)){
                    $cat_collection = \DB::table('tb_categories')->where('parent_category_id', $m_collection->id)->where('category_approved', 1)->where('category_published', 1)->orderBy('category_order_num', 'asc')->get();                
                        if(count($cat_collection)>0){
                            $str_title = '';
                ?>
                            @foreach ($cat_collection as $si)
                                <li>
            						<div class="navheadimage">
                                        <?php 
                                            //$str_title = strtolower($si->package_title); 
                                            //$str_title = str_replace(' ', '-', $str_title);
                                            $str_title = $si->category_alias;
                                        ?>
            							<a class="EGloader" href="{{URL::to('luxurytravel/Hotel')}}/{{$str_title}}">
            								<img src="{{URL::to('uploads/category_imgs/'.$si->category_image)}}" alt=""/>			
            								<div class="headingoverlay">
            									<span class="destinationTitle">
            										{{$si->category_name}}
            									</span>
            								</div>
            							</a>
            						</div>
            					</li>
                            @endforeach
                <?php
                        }        
                    }
                ?>
                <?php /* {{--*/ $colection_menus = SiteHelpers::menus('top') /*--}}
				@if(!empty($colection_menus))
					@foreach ($colection_menus as $cmenu)
						<li>
							<div class="navheadimage">
								<a @if($cmenu['menu_type'] =='external') href="{{ URL::to($cmenu['url'])}}" @else href="{{ URL::to($cmenu['module'])}}" @endif>
									@if($cmenu['image']!='')
										<img src="{{ URL::to('uploads/menu_imgs/'.$cmenu['image']) }}" alt=""/>
									@else
										<img src="{{ asset('themes/emporium/images/mountain-image.jpg') }}" alt=""/>
									@endif
									<div class="headingoverlay">
										<span class="destinationTitle">
											@if(CNF_MULTILANG ==1 && isset($cmenu['menu_lang']['title'][Session::get('lang')]))
											  {{ $cmenu['menu_lang']['title'][Session::get('lang')] }}
											@else
											  {{$cmenu['menu_name']}}
											@endif
										</span>
									</div>
								</a>
							</div>
						</li>
					@endforeach
				@endif */ ?>
            </ul>
            <ul class="mobilemenulist hide" data-option="selected-option-list">
            </ul>
            {{-- For Gobal Search List --}}
            @include('frontend.themes.emporium.layouts.sections.global-search-list')
            {{-- End  Gobal Search List --}}
            @if (!Auth::check())

                <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob"
                                                                         href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
                </div>
            @endif
            <div class="hide"  data-option="search-by-date">
                <form action="{{url('search')}}" method="get">
                    <input type="hidden" name="action" value="bydate">
                    {{--*/
                            $setDateArvStr = date('j-n-Y');
                            $setDateDepStr = date('j-n-Y',strtotime('+1 day'));
                            $setDateArvArr = explode('-',$setDateArvStr);
                            $setDateDepArr = explode('-',$setDateDepStr);
                            $setDateDefaultArv = date('d-m-Y');
                            $setDateDefaultDep = date('d-m-Y',strtotime('+1 day'));
                    /*--}}
                    @if(isset($_GET['action']) && $_GET['action']=='bydate' )
                        @if(isset($_GET['arrive']) && $_GET['arrive']!='')
                            {{--*/
                                $setDateArvStr = date('j-n-Y',strtotime($_GET['arrive']));
                                $setDateArvArr = explode('-',$setDateArvStr);
                               $setDateDefaultArv = date('d-m-Y',strtotime($_GET['arrive']));

                            /*--}}
                        @endif
                        @if(isset($_GET['departure']) && $_GET['departure']!='')
                            {{--*/

                               $setDateDepStr = date('j-n-Y',strtotime($_GET['departure']));
                               $setDateDepArr = explode('-',$setDateDepStr);
                               $setDateDefaultDep = date('d-m-Y',strtotime($_GET['departure']));
                            /*--}}
                        @endif
                    @endif
                    <input name="arrive" type="hidden" value="{{$setDateDefaultArv}}">
                    <input name="departure" type="hidden" value="{{$setDateDefaultDep}}">
                    <ul class="mobilemenulist">
                        <li>
                            <p>Emporium Voyage is your deal, vogue vacation planner!</p>
                        </li>
                        <li>
                            <div id="t-sidebar-picker" class="rsidebar t-datepicker">
                                <div class="t-check-in"></div>
                                <div class="t-check-out"></div>
                            </div> 
                            <button class="searchButton btn" type="submit">Search</button>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="bottomlink text-center hide" data-option="search-by-date">@if (!Auth::check()) View, Modify or Cancel your
                Booking<br/> <a href="javascript:void(0)" class="loginSecForMob">Login</a> @else <a href="{{URL::to('dashboard')}}">View, Modify or Cancel your Booking</a> @endif</div>
            <div class="hide" data-option="select-filter">
                <div class="rangeslidercontainer">
                      <div class="slidecontainer">
                            <input type="range" min="1" max="6000" value="0" class="slider" id="myRange">
                            <div class="sliderlegend">High - Low</div>
                            <select name="currencyOption" class="form-control">
                                <option value="EUR">Currency</option>
								{{--*/ $currencyList=(CommonHelper::getCurrencyList()); /*--}}
                                @if(!empty($currencyList))
								@foreach($currencyList as $currencyCode => $currencyName)

									<option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
								</option>

								@endforeach
                                @endif
                            </select>
                            <p>$<span id="pricevalue">1</span> - $0</p>
                            <div class="clearfix"></div>
                      </div>
                </div>
            </div>     

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
                {{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $sidebarads = CommonHelper::getSidebarAds('grid_sidebar', $adscatid) /*--}}
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