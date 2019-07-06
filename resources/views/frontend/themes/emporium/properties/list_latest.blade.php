@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Page's Content Part --}}
@section('content')
    <!-- Restaurant slider starts here -->
    <section id="search-result-slider" class="luxuryHotelSlider">
		 @if(!empty($slider))
			<div id="myCarousel" class="carousel" data-ride="carousel">
				<!-- Indicators -->
				{{--  Wrapper for slides --}}
				<div class="carousel-inner">
					@foreach($slider as $key => $slider_row)
						<div class="item {{($key == 0)? 'active' : ''}}" style="background-image:url({{url('uploads/slider_images/'.$slider_row->slider_img)}});">
							<div class="carousel-caption">
								<h6>{{$slug}}</h6>
								<h2>
									@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}">{{$slider_row->slider_title}}</a>
									@else
										{{$slider_row->slider_title}}
									@endif
								</h2>
								<p>@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}" style="color:white;	">{{$slider_row->slider_description}}</a>
									@else
										{{$slider_row->slider_description}}
									@endif


								</p>
							</div>
						</div>
					@endforeach
					{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $sliderads = CommonHelper::getSliderAds('grid_slider', $adscatid) /*--}}
					@if(!empty($sliderads['leftsidebarads']))
						@foreach($sliderads['leftsidebarads'] as $ads)
							<div class="item" style="background-image:url({{URL::to('uploads/users/advertisement/'.$ads->adv_img)}});">
								<div class="carousel-caption">
									<h6>Advertisement</h6>
									<h2>
										@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a>
										@else
											{{$ads->adv_title}}
										@endif
									</h2>
									<p>@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_desc}}</a>
										@else
											{{$ads->adv_desc}}
										@endif


									</p>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				@if(count($slider) > 1)
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon"/>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon"/>
					</a>
				@endif
			</div>
		@endif
    </section>
    
    <?php if(!empty($search_for)){ ?>
    <section class="search-tab {{ $search_for=='experience' ? 'tab-show' : 'tab-hide' }}">
        <?php 
            $sel_collection = '';
            $sel_experience = '';
            if($req_for=="luxury_experience"){
               $sel_experience = 'active';     
            }else{
               $sel_collection = 'active'; 
            } 
        ?>
        <ul class="nav nav-tabs">
            <?php /* <li class="{{$sel_collection}}"><a href="#ourCollection" data-toggle="tab">Our Collections</a></li> */ ?>
            <li class="{{$sel_experience}}"><a href="#experiences" data-toggle="tab">Experiences</a></li>            
        </ul>
        <div class="tab-content">
            <?php /* <div id="ourCollection" class="tab-pane {{$sel_collection}}">
            @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)
                        <?php
                            $lnth = 0;
                            $coll_ttl = $coll->category_name;
                            $exp_ttl = explode(' ', $coll_ttl); 
                            if(!empty($exp_ttl)){
                                $arr_key = $exp_ttl[0];       
                            }
                            if(!empty($prop_packages)){ //print_r($prop_packages);
                                //foreach($prop_packages as $pkg){ print_r($pkg);
                                    if(array_key_exists($arr_key, $prop_packages)){
                                        $lnth = count($prop_packages[$arr_key]);        
                                    }    
                                //}
                            }
                               
                        ?>
                        <li class="<?php echo ($k==1) ? 'active' : '' ?> collection" data-name="{{$coll->category_alias}}"><a href="#{{$coll->category_alias}}" data-toggle="tab">{{$coll->category_name}} ({{$lnth}})</a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
            @endif
            </div> */ ?>
            
            <div id="experiences" class="tab-pane {{$sel_experience}} experinces">
                <select name="experience" id="experience">  
                    @if(!empty($experiences))                  
                        @foreach($experiences as $exp)
                            <option value="{{$exp->category_alias}}" <?php echo ($sel_exp==$exp->category_alias) ? 'selected="selected"' : '' ?>>{{$exp->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach 
                    @endif
                </select>
                <?php /* <ul class="nav nav-tabs">
                    @foreach($experiences as $exp)
                        <li class="<?php echo ($sel_exp==$exp->category_alias) ? 'active' : '' ?>"><a href="{{URL::to('luxury_experience')}}/{{$exp->category_alias}}">{{$exp->category_name}}</a></li>    
                        {{--*/ $i++;  /*--}}
                    @endforeach                           
                </ul> */ ?>   
                
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)
                        <?php
                            $lnth = 0;
                            $coll_ttl = $coll->category_name;
                            $exp_ttl = explode(' ', $coll_ttl); 
                            if(!empty($exp_ttl)){
                                $arr_key = $exp_ttl[0];       
                            }
                            if(!empty($prop_packages)){ //print_r($prop_packages);
                                //foreach($prop_packages as $pkg){ print_r($pkg);
                                    if(array_key_exists($arr_key, $prop_packages)){
                                        $lnth = count($prop_packages[$arr_key]);        
                                    }    
                                //}
                            }
                               
                        ?>
                        <?php /*<li class="<?php echo ($k==1) ? 'active' : '' ?> collection" data-name="{{$coll->category_alias}}"><a href="#{{$coll->category_alias}}" data-toggle="tab">{{$coll->category_name}} ({{$lnth}})</a></li> */ ?>
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('luxury_experience')}}/{{$sel_exp}}/{{$coll->category_alias}}" >{{$coll->category_name}} ({{$lnth}})</a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                           
            </div>
            <input type="hidden" name="req_for" id="req_for" value="{{@!empty($req_for)? $req_for : ''}}" />
            <input type="hidden" name="sel_exp" id="sel_exp" value="{{@!empty($sel_exp) ? $sel_exp : ''}}" />
            <input type="hidden" name="m_type" id="m_type" value="{{@!empty($m_type) ? $m_type : ''}}" />
        </div>
    </section>
    
    <section class="search-tab {{ $search_for=='destinations' ? 'tab-show' : 'tab-hide' }}">        
        <ul class="nav nav-tabs">           
            <li class="active"><a href="#tab-destination" data-toggle="tab">Destination</a></li>            
        </ul>
        <div class="tab-content">
            
            {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}                
            
            <div id="tab-destination" class="tab-pane active destinatin">
                <select name="dd-destination" id="dd-destination">                    
                    @foreach($destinations as $dest)
                        <option value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                        {{--*/ $i++;  /*--}}
                    @endforeach 
                </select>
                              
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)
                        <?php
                            $lnth = 0;
                            $coll_ttl = $coll->category_name;
                            $exp_ttl = explode(' ', $coll_ttl); 
                            if(!empty($exp_ttl)){
                                $arr_key = $exp_ttl[0];       
                            }
                            if(!empty($prop_packages)){ //print_r($prop_packages);
                                //foreach($prop_packages as $pkg){ print_r($pkg);
                                    if(array_key_exists($arr_key, $prop_packages)){
                                        $lnth = count($prop_packages[$arr_key]);        
                                    }    
                                //}
                            }
                               
                        ?>                        
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('/')}}" >{{$coll->category_name}} ({{$lnth}})</a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                           
            </div>
            <input type="hidden" name="" id="" value="" />
            
            <input type="hidden" name="dest_cat" id="dest_cat" value="{{@!empty($dest_cat)? $dest_cat : ''}}" />
            <input type="hidden" name="dest_url" id="dest_url" value="{{@!empty($dest_url)? $dest_url : ''}}" />
        </div>
    </section>
            <input type="hidden" name="sel_exp" id="sel_exp" value="{{!empty($sel_exp) ? $sel_exp : ''}}" />
<?php } ?>    
<input type="hidden" name="dest_collection" id="dest_collection" value="{{!empty($m_type) ? $m_type : ''}}" /> 
<div id="load_ajax">
@if(count($editorPropertiesArr)>0)
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
    		<h4 class="gridheading">{{ count($editorPropertiesArr) }} <span class="newfont"> Editor's choice</span> Hotels Found for {{ $slug }}  {{$dateslug}}</h4>
    <div class="slider multiple-items">


@foreach($editorPropertiesArr as  $props)
<?php
				$url=URL::to(rtrim($props->property_slug,'-'));
				if(Request::has("departure") || Request::has("arrive"))
				{
					$url.='?arrive='.Request::input("arrive")."&departure=".Request::input("departure");
				}
			?> 

      <div>
        <div class="col-md-6 col-sm-6 col-xs-12">
         <a  href="{{ $url }}" >
		          <img src="{{ URL::to('sximo/images/transparent.png') }}" data-src="{{ URL::to('propertysliderimagebyid/'.$props->id)}}" class="img-responsive rad-img" alt="{{ $props->property_name}}" title="{{ $props->property_name}}" data-ajax-link="{{ URL::to('ajax-rproperty-images/'.$props->id.'/3') }}" />
    		  </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 slidertext">
          <h6 class="cat-links">
                      
                    </h6>
                    <h5 class="entry-title">
                    <a href="{{ $url }}" rel="bookmark" tabindex="0" style="outline: none;"> {{ $props->property_name}}</a>
                </h5>
             <p> <a  href="{{ $url }}" >    {{ $props->property_usp}}  </a></p>
             <a class="remoreslider" href="{{ $url }}"><span class="newfont"> Discover</span></a>
        </div>
      </div>

@endforeach   


     </div>
    </div>
  </div>
@endif

  <div class="col-md-12 col-sm-12 col-xs-12 misonrysection">
  
    <div class="row">

 



@if(!empty($featurePropertiesArr))
		<h4 class="gridheading"> {{ count($featurePropertiesArr) }}<span class="newfont"> Featured </span> Hotels Found for {{ $slug }}  {{$dateslug}}</h4>
			<div class="grid">

        <?php $frw = 1 ?>
		@foreach($featurePropertiesArr as $props)
			
			<?php
				$url=URL::to(rtrim($props->property_slug,'-'));
				if(Request::has("departure") || Request::has("arrive"))
				{
					$url.='?arrive='.Request::input("arrive")."&departure=".Request::input("departure");
				}
                $femotional_gallery = array();
                if(isset($emotional_gallery)){                
                    if(($frw == 1) && (count($emotional_gallery) > 0)){
                        for($i = 0; $i<9; $i++){
                            if(count($emotional_gallery) > 0){ $femotional_gallery[] = array_shift($emotional_gallery); }
                        }
                    }
                }                
                $frw++;
			?> 


    <div class="col-md-6 col-sm-6 col-xs-12 biggrid">
        <div class="row">
          <div class="gridinner">
            <a href="{{ $url }}" title="{{ $props->property_name}}">
          		  <img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertysliderimagebyid/'.$props->id)}}" class="img-responsive rad-img" alt="{{ $props->property_name}}" title="{{ $props->property_name}}" />
                  
                  {{-- <img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="http://staging.emporium-voyage.com/propertysliderimagebyid/61" class="img-responsive rad-img" alt="The Soho Hotel " title="The Soho Hotel"
                  data-imagessrc='[{"src":"http://staging.emporium-voyage.com/propertysliderimagebyid/61"},{"src":"http://staging.emporium-voyage.com/propertysliderimagebyid/69"},{"src":"http://staging.emporium-voyage.com/propertyimagebyid/213"}]' />  --}}
               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
           	</a>
            <div class="gridtext">
              <h5 class="entry-title">
                  <a href="{{ $url}}" rel="bookmark" style="">{{ $props->property_name}} -- Featured  </a>
                   <a href="{{ $url }}"><i class="fa fa-shopping-cart"></i></a>
              </h5>
               <p>  {{ $props->property_usp}}</p>
                  <a class="read-more-link" href="{{ $url }}"  title="Discover" ><span class="newfont"> Discover</span></a>
            </div>
          </div>
        </div>
      </div>
      
      @if(count($femotional_gallery) > 0)
      <?php
        $images_arr = array();
        foreach($femotional_gallery as $si_g_image){
            //$images_arr[] = array("src"=>\URL::to('container-image/'.$si_g_image->id));
            //$images_arr[] = array("src"=>\URL::to('uploads/thumbs/format_'.$si_g_image->folder_id.'_'.$si_g_image->file_name));
            $images_arr[] = array("src"=>$si_g_image->imgsrc.$si_g_image->file_name);
        }
        $img_str = json_encode($images_arr);
        ?>
      <div class="col-md-6 col-sm-6 col-xs-12 biggrid">
        <div class="row">
          <div class="gridinner">
            <a href="javascript:false;">
          		  <img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{$images_arr[0]['src']}}" data-imagessrc="{{$img_str}}" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />
           	</a>
            <div class="gridtext">
              <h5 class="entry-title"></h5>
               <p></p>
            </div>
          </div>
        </div>
      </div>
      @endif
      
	@endforeach
</div>
@endif

      <div class="clearfix"></div>
      	@if($propertiesArr)
  	<h4 class="gridheading">{{$total_record}} 	<span class="newfont"> Luxury Hotel(s)</span> Found for {{$slug}} {{$dateslug}}</h4>
	@endif
    <div class="grid">
    


@if($propertiesArr)
{{--*/ $rw = 1 /*--}}
		@foreach($propertiesArr as $props)
			<?php
				$url=URL::to(rtrim($props->property_slug,'-'));
				if(Request::has("departure") || Request::has("arrive"))
				{
					$url.='?arrive='.Request::input("arrive")."&departure=".Request::input("departure");
				}
                $temotional_gallery = array();
                /*if(((($rw % 19) == 0) || ($rw == count($propertiesArr))) && (count($emotional_gallery) > 0)){
                    for($i = 0; $i<9; $i++){
                        if(count($emotional_gallery) > 0){ $temotional_gallery[] = array_shift($emotional_gallery); }
                    }
                }*/
			?> 
			@if($rw%19==0)
							{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $resultads = CommonHelper::getGridResultAds('grid_results', $adscatid) /*--}}
                            
							@if(!empty($resultads['resultads']))
								 <div class="col-md-4 col-sm-4 col-xs-12 grid-item">
							        <div class="row">
							           <div class="gridinner">
							            <a href="#" >
							          		  <img src="{{URL::to('uploads/users/advertisement/'.$resultads['resultads']->adv_img)}}" class="img-responsive" >
							               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
							           	</a>
							            <div class="gridtext">
							              <h5 class="entry-title">
							                  <a href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}" rel="bookmark" style="">{{ $resultads['resultads']->adv_title}}   </a>
							                  <a href="#">Advertisement</a>
							              </h5>
							               
							                  <a class="read-more-link" href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}">{{ $resultads['resultads']->adv_title}}</a>
							            </div>
							          </div>
							        </div>
							      </div>
							@endif
							@else
							      <div class="col-md-4 col-sm-4 col-xs-12 grid-item">
							        <div class="row">
							           <div class="gridinner">
							           	<div class="image">
							           		    {{-- <a class="showhide" href="{{$url}}" rel="bookmark" style="">{{ $props->property_name}}   </a> --}}
							            <a href="{{ $url }}" title="{{ $props->property_name}}">
							          		  <img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertyimagebyid/'.$props->id)}}" class="img-responsive rad-img" alt="{{ $props->property_name}}" title="{{ $props->property_name}}"  />
							               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
							           	</a>

							           </div>
							            <div class="gridtext">
							              <h5 class="entry-title">
							                  <a href="{{$url}}" rel="bookmark" style="">{{ $props->property_name}}   </a>
							                  <a href="{{$url}}"><i class="fa fa-shopping-cart"></i></a>
							              </h5>
							               <p>  {{ $props->property_usp}}</p>
							                  <a class="read-more-link" href="{{$url}}" title="discover"><span class="newfontsimple">Discover</span></a>
							            </div>
							          </div>
							        </div>
							      </div>
							 @endif
                             
                             @if(count($temotional_gallery) > 0)
                                <?php
                                $images_arr = array();
                                foreach($temotional_gallery as $si_g_image){
                                    //$images_arr[] = array("src"=>\URL::to('container-image/'.$si_g_image->id));
                                    $images_arr[] = array("src"=>\URL::to('uploads/thumbs/format_'.$si_g_image->folder_id.'_'.$si_g_image->file_name));
                                }
                                $img_str = json_encode($images_arr);
                                ?>
                                <div class="col-md-4 col-sm-4 col-xs-12 grid-item">
							        <div class="row">
							           <div class="gridinner">
							           	<div class="image">
							           		    {{-- <a class="showhide" href="{{$url}}" rel="bookmark" style="">{{ $props->property_name}}   </a> --}}
							            <a href="javascript:false;">
							          		 <img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{$images_arr[0]['src']}}" data-imagessrc="{{$img_str}}" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />
							           	</a>

							           </div>
							            <div class="gridtext">
							              <h5 class="entry-title"></h5>
							               <p></p>
							            </div>
							          </div>
							        </div>
							      </div>
                            @endif

      		{{--*/ $rw++ /*--}}
      @endforeach 
@endif

     
  </div>
  </div>
</div>

  <div class="col-md-12 col-xs-12 col-xs-12 text-center">
  	<div class="row">
  @if($total_pages>1)
				<ul class="pagination">
	 				@for($i=1;$i<=$total_pages;$i++)
	 					<?php
							$url=Request::url().'?';
							$queryStrings=Request::query();
							if(isset($queryStrings['page']))
							{
								unset($queryStrings['page']);
							}
							foreach($queryStrings as $keyQuery=>$querystring):
								$url.=$keyQuery.'='.$querystring.'&';
							endforeach;
						?>
	 					 <li class="@if($i==$active_page) active @endif"><a href="{{ $url.'page='.$i }}">{{ $i }}</a></li>
	 				@endfor
	 
				</ul>
				@endif
	</div>
</div>
  









	<!-- Instagram Gallery Section -->
	@if($destination_category > 0)
		@if($destination_category_instagram != '')
			<section id="instagram-section">
				<div class="col-sm-12 text-center">
					<h2 class="heading">{{$slug}}</h2>
				</div>
				<section id="instagran" class="sections-instagram">
					<div class="full-width">
						<div data-is data-is-api="{{ url('runInsta')}}"
							 data-is-source="{{ $destination_category_instagram }}"
							 data-is-rows="2" data-is-limit="0" data-is-columns="5" ></div>
					</div>
				</section>
			</section>
		@endif
	@endif
</div>
@endsection

{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@show

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.grid_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/search-result.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/rad-photos-swap.css') }}" rel="stylesheet">

@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
	
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
	  <?php /*<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>*/ ?>
      <script src="{{ asset('themes/emporium/js/masonry.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/imagesloaded.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/rad-photos-swap.js')}}"></script>
   <script type="text/javascript">
   $('.multiple-items').slick({
    dots: true,
    arrows: false,
    autoplay: true,
    infinite: false,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    vertical: true,
    speed: 1000,
    autoplaySpeed:1000,
  });
  </script>
  <script type="text/javascript">
 // init Masonry
var $grid = $('.grid').masonry({
  // options...
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});
  </script>
@endsection
{{-- For custom style  --}}
@section('custom_css')
    @parent
    
            <style>
                
                <!-- Start Modal popup -->
                #showMemberLoginPopup .modal-dialog{
                    width: 700px !important;
                }
                #showMemberLoginPopup .modal-header{
                    border: 0px;        
                    padding:0px !important;
                }
                #showMemberLoginPopup .modal-content{
                    background: #252525 !important;        
                    min-height: 300px;
                }
                #showMemberLoginPopup .modal-content .popup-title{
                    color: #fff !important;
                    padding: 0px;
                    margin-top: 0px;
                    font-family: DomaineDisplay;
                }
                #showMemberLoginPopup .modal-content p{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .modal-content h6{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .btnMembershipTypeJoin{
                    margin-top: 25px;
                    float: none;
                    width: 90%;
                    /*margin: 0px auto;*/
                    text-align: center;
                    display: block;
                    cursor: pointer;
                }
                .btnMembershipTypeBack {
                    border: 1px solid #fff;
                    border-radius: 0px;
                    color: #fff;
                    font-size: 12px;
                    padding: 12px 20px;
                    text-transform: uppercase;
                    /*margin-left: 10px;*/
                    float: left;
                    text-decoration: none;
                    /*margin-top: 93px;*/
                    margin-top: 25px;
                    cursor: pointer;
                }
                .btnMembershipTypeBack:hover, .btnMembershipTypeBack:focus {
                    color:#fff;
                }
                .modal-backdrop{background-color:#252525 !important}
                .modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}
                .modal-backdrop.in{filter:alpha(opacity=95);opacity:.95}
                
                .calendar-left-box{
                    margin: 10px 0px;
                }
                .calendar-left-box .season-search{
                    background: #aba00b;
                    color: #fff;
                    border-radius: 0px;
                    text-transform: uppercase;
                    margin-top: 2px;
                    margin-left: -7px;
                }
                .calendar-left-box .pad-0{
                    padding: 0px;
                }
                .t-datepicker-box .t-check-in, .t-datepicker-box .t-check-out {
                    width: 97% !important;
                }
                
                
                @media (max-width:1199px){
                    #showMemberLoginPopup .modal-dialog{
                        width:auto !important;
                    }
                    .btnMembershipTypeBack{
                        width: 100%;
                        text-align: center;
                    }
                }
                <!-- End Modal popup -->
            </style> 
                   
@endsection
{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
        var noImg = "{{ URL::to('sximo/images/noimg.jpg') }}";
        $(window).on('load', function(e){
            //load images after load full page
                $('img.rad-img').photoLoadAfterPageLoad(noImg);
            //End
    	});
		$(document).ready(function () {
		  //load images after load full page
          //$('img.rad-img').photoLoadAfterPageLoad(noImg);
          //End
          
			$(document).on('change', '#myRange', function () {
				var datObj = window.location.search;
				if(datObj.match(/filter_max_price/g))
				{
					var str = datObj.split("?");
					datObj =  str[0]+'?filter_max_price=' + $(this).val();
				}
				else
				{
					datObj =  datObj+'?filter_max_price=' + $(this).val();
				}
				window.history.pushState("object or string", "Title", datObj);
				priceFilterAjax();
			});
			
			@if($dateslug!='')
				$('[data-action="search-by-date"]').trigger('click');
			@endif
            
            $(".collection").click(function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                
                var cat = $("#sel_exp").val();
                var coll_type = 'experiences';
                //var token = $("input[name='_token']").val();
                //console.log(data_name);
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        console.log(response.type);
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/dedicated-collection';
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');  
                            }
                        }else{
                            window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
            
            $(".dest-collection").click(function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                var cat =  $("#sel_exp").val();                
                var coll_type = 'destinations';
                var cobj = $(this);
                //var token = $("input[name='_token']").val();
                //console.log(data_name);
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        //console.log(response.type);
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                //window.location.href = '{{URL::to('luxury_destinations')}}/'+cat+'/dedicated-collection';
                                getPropertyByCollection('dedicated-collection', cat, 1);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('dedicated-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                                getPropertyByCollection('bespoke-collection', cat, 1);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('bespoke-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');                               
                            }
                        }else{
                            getPropertyByCollection('lifestyle-collection', cat, 1);
                            $(".dest-collection").removeClass('active');
                            cobj.addClass('active');
                            $("#dest_collection").val('lifestyle-collection'); 
                            //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
            
            var mtype = $("#dest_collection").val();
            var _cat =  $("#sel_exp").val();
            getPropertyByCollection(mtype, _cat, 1);
		});
		
		var pageCounter = 2;
		var pagehgt = 1200;
		var it_scroll = false;
		var totalPage = '{{$total_pages}}';
		$(window).scroll(function () {
            if ($(window).scrollTop() < pagehgt) { return false; }

            if (pageCounter > totalPage) {
				return false;
			} else {
			//	it_scroll = true;
				//scrollDataAjax(it_scroll, pageCounter);
				//pagehgt = pagehgt + 1000;
			}
			pageCounter++;

		});
        
        
        
        function getPropertyByCollection(coll_type, cat, page){ console.log("hello");
            $.ajax({
                url:'{{URL::to("propertybycollection/")}}',
                //dataType:'html',
                dataType:'json',
                data: {coll_type:coll_type, cat:cat, page:page},
                type: 'post',
                success: function(data){ 
                    
                    listpagestructure(data);
                    
                    /*$("#load_ajax").html('');
                    $("#load_ajax").html(data);
                    $grid = $('.grid').masonry({
                      // options...
                    }); 
                    $grid.imagesLoaded().progress( function() {
                      $grid.masonry('layout');
                    });
                    $('img.rad-img').photoLoadAfterPageLoad(noImg);*/
                }
            });
        }
        
        function listpagestructure(data){                    
            //console.log(data.data.active_page,data);
            var _html = '';
            var jsonobj = data.data;
            if($.isEmptyObject(jsonobj)){
                
            }else{ 
                var editorPropertiesArr = jsonobj.editorPropertiesArr;                
                if (typeof editorPropertiesArr !== undefined && editorPropertiesArr.length > 0){
                     _html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        _html += '<div class="row">'
                            _html += '<h4 class="gridheading">'+ editorPropertiesArr.length +' <span class="newfont"> Editor\'s choice</span> Hotels Found for '+jsonobj.slug+' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="slider multiple-items">'; 
                            $.each(editorPropertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
             				    ?>
                    					_url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                    				}
                    			?>
                                _html += '<div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12">';
                                        _html += '<a  href="'+_url+'" >';
                                            _html += '<img src="{{ URL::to('sximo/images/transparent.png') }}" data-src="{{ URL::to('propertysliderimagebyid/')}}'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" data-ajax-link="{{ URL::to('ajax-rproperty-images')}}'+value['id']+'/3" />';
                                        _html += '</a>';
                                    _html += '</div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 slidertext">';
                                        _html += '<h6 class="cat-links">';                                      
                                        _html += '</h6>';
                                
                                        _html += '<h5 class="entry-title">';
                                            _html += '<a href="'+_url+'" rel="bookmark" tabindex="0" style="outline: none;">'+value['property_name']+'</a>';
                                        _html += '</h5>';
                                        _html += '<p><a  href="'+_url+'" >'+value['property_usp']+'</a></p>';
                                        _html += '<a class="remoreslider" href="'+_url+'"><span class="newfont"> Discover</span></a>';
                                    _html += '</div>';
                                _html += '</div>';
                                
                            });
                            _html += '</div>'; 
                        _html += '</div>';       
                    _html += '</div>';  
                }
                _html += '<div class="col-md-12 col-sm-12 col-xs-12 misonrysection">'
                     _html += '<div class="row">';
                        var featurePropertiesArr = jsonobj.featurePropertiesArr;
                        var i=1; 
                        if(typeof featurePropertiesArr !== undefined && featurePropertiesArr.length > 0){                            
                            _html += '<h4 class="gridheading"> '+ featurePropertiesArr.length +' <span class="newfont"> Featured </span> Hotels Found for '+ jsonobj.slug +' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="grid">';
                                $.each(featurePropertiesArr, function(key, value){ 
                                    var property_slug = value['property_slug'];                                    
                                    
                                    var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                    
                                    <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
                 				    ?>
                   					    _url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                    <?php
                     				}
                        			?>
                                    var femotional_gallery = [];
                                    var emotional_gallery = jsonobj.emotional_gallery;
                                    if(typeof emotional_gallery !== undefined){
                                        if(i==1 && emotional_gallery.length > 0){
                                            for(j=0; j<9; j++){
                                                if(emotional_gallery.length > 0){
                                                    femotional_gallery.push(emotional_gallery.shift());    
                                                }
                                            }
                                        }        
                                    }
                                    i++;
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">'; 
                                        _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
                                                _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                         	      _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertysliderimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" />';
                                                _html += '</a>';
                                                _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+' -- Featured  </a>';
                                                        _html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+  value['property_usp'] +'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'"  title="Discover" ><span class="newfont"> Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    _html += '</div>';
                                    
                                    if(femotional_gallery.length > 0){
                                        var images_arr = [];
                                        $.each(femotional_gallery, function(key, value){                                            
                                            var _img = {src: value['imgsrc']+value['file_name']}; 
                                            images_arr.push(_img);
                                        }); 
                                        //console.log(images_arr);
                                        var img_str = '';
                                        _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">';
                                            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="javascript:false;">';
                                        	           _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="'+images_arr[0]['src']+'" data-imagessrc="'+img_str+'" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />';
                                                    _html += '</a>';
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title"></h5>';
                                                        _html += '<p></p>';
                                                    _html += '</div>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }                                    
                                           
                                });
                            _html += '</div>';
                        }
                     
                
                        _html += '<div class="clearfix"></div>';
                        propertiesArr = jsonobj.propertiesArr;
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){
                            _html += '<h4 class="gridheading">'+ jsonobj.total_record +'<span class="newfont"> Luxury Hotel(s)</span> Found for '+jsonobj.slug+' '+jsonobj.dateslug +'</h4>';
                        }
            
                        _html += '<div class="grid">';  
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){  
                            var rw = 1;
                            
                            $.each(propertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                				if(Request::has("departure") || Request::has("arrive"))
                				{
             				    ?>
               					    _url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                 				}
                    			?>
                                if(rw%19==0){
                                    var resultads = jsonobj.resultads.resultads;
                                    
                                    if(typeof resultads !== undefined && resultads != null){
                                    
                                        _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
                				            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="#" >'
                                					   _html += '<img src="{{URL::to('uploads/users/advertisement/')}}/'+resultads['adv_img']+'" class="img-responsive" >';
                                                    _html += '</a>';
                                                    
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title">';
                                                            var advUrl = resultads['adv_link'];
                                                            if(advUrl.indexOf("http") < 0){
                                                                advUrl = "http://" + advUrl;        
                                                            }
                                                            _html += '<a href="'+advUrl+'" rel="bookmark" style="">'+resultads['adv_title']+'</a>';
                                                            _html += '<a href="#">Advertisement</a>';
                                                        _html += '</h5>';
                                                        _html += '<a class="read-more-link" href="'+advUrl+'">'+resultads['adv_title']+'</a>';
                          						    _html += '</div>';
                                                    
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }
                                }else{
                                
                                    _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
            				            _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
            				           	        _html += '<div class="image">';                							           		    
                                                    _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                                        _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertyimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'"  />';
                                                    _html += '</a>';
                                                _html += '</div>';
            				                    _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+'</a>';
                                                        _html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+value['property_usp']+'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'" title="discover"><span class="newfontsimple">Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
            				            _html += '</div>';
                                    _html += '</div>';
                                }
                                rw++;
                                
                                /*_html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
        				            _html += '<div class="row">';
                                        _html += '<div class="gridinner">';
                  						    _html += '<div class="image">';                							           		    
                                                _html += '<a href="javascript:false;">';
                                                _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="" data-imagessrc="" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />';
                                                _html += '</a>';
        				                    _html += '</div>';
        				                    _html += '<div class="gridtext">';
                                                _html += '<h5 class="entry-title"></h5>';
                                                _html += '<p></p>';
                        					_html += '</div>';
                        				_html += '</div>';
                        			_html += '</div>';
                        		_html += '</div>';*/
                                        
                            });    
                        }
                        _html += '</div>';
                    _html += '</div>';
                _html += '</div>';
                
                _html += '<div class="col-md-12 col-xs-12 col-xs-12 text-center">';
                    _html += '<div class="row">';
                        var total_pages = jsonobj.total_pages;
                        if(total_pages>1){
                    		_html += '<ul class="pagination">';
                    			for(i=1; i<=total_pages; i++){
                    				<?php
                    					$url=Request::url().'?';
                    					$queryStrings=Request::query();
                    					if(isset($queryStrings['page']))
                    					{
                    						unset($queryStrings['page']);
                    					}
                    					foreach($queryStrings as $keyQuery=>$querystring):
                    						$url.=$keyQuery.'='.$querystring.'&';
                    					endforeach;
                    				?>
                                    var act = (i==jsonobj.active_page) ? 'active' : '';
                    				_html += '<li class="'+act+' paging"><a href="{{ $url.'page='}}'+i+'" data-page="'+i+'">'+i+'</a></li>';
                    			}    
                    		_html += '</ul>';
                		}
                	_html += '</div>';
                _html += '</div>';
                
                _html += '<!-- Instagram Gallery Section -->';
                var destination_category = jsonobj.destination_category;
            	if(typeof destination_category !== undefined && destination_category > 0){
                    var destination_category_instagram = jsonobj.destination_category_instagram;
            		if(destination_category_instagram != ''){
            			_html += '<section id="instagram-section">';
            				_html += '<div class="col-sm-12 text-center">';
            					_html += '<h2 class="heading">{{$slug}}</h2>';
            				_html += '</div>';
            				_html += '<section id="instagran" class="sections-instagram">';
            					_html += '<div class="full-width">';
            						_html += '<div data-is data-is-api="{{ url('runInsta')}}" data-is-source="'+destination_category_instagram+'" data-is-rows="2" data-is-limit="0" data-is-columns="5" ></div>';
            					_html += '</div>';
            				_html += '</section>';
            			_html += '</section>';
            		}
            	}
            }
            $("#load_ajax").html('');
            $("#load_ajax").html(_html);
            $grid = $('.grid').masonry({
              // options...
            }); 
            $grid.imagesLoaded().progress( function() {
              $grid.masonry('layout');
            });
            $('img.rad-img').photoLoadAfterPageLoad(noImg);
        }
        
        $(document).on('click', '.paging a', function(e){
           e.preventDefault();
           //var _link = $(this).attr('href');
           //console.log("hello", _link);
           var cat = $("#sel_exp").val();                
           var coll_type = $("#dest_collection").val();
           var page = $(this).attr('data-page');
           getPropertyByCollection(coll_type, cat, page); 
        });
        
		function scrollDataAjax(it_scroll, pageCounter){
			if(it_scroll==true) {
				var str = window.location.search;
				if(str.match(/filter_max_price/g))
				{
					var datObj = window.location.search+'&page='+pageCounter;
				}
				else
				{
					var datObj = window.location.search+'?page='+pageCounter;
				}
                    datObj =  datObj+'&s={{$slug}}';


				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/search-property-ajax'+datObj;
				params['successCallbackFunction'] = renderPropertyList;
				doAjax(params);
			}
		}

		function renderPropertyList(data){
			$.each(data.properties, function (idx, obj) {
				if(idx==19)
				{
					if(data.resultads)
					{
						var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
						dataGridHtml +='<div class="hotel-card">';
						dataGridHtml +='<figure>';
						var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
						dataGridHtml += '<img src="' + imgscr + '" />';
						dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
						dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
						dataGridHtml +='</a>';
						dataGridHtml +='<div class="pricelabel">Advertisement</div>';
						dataGridHtml +='</figure>';
						dataGridHtml +='<div class="title">';
						dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						$('[data-option="property-grid-list"]').append(dataGridHtml);
					}
				}
				else
				{
					var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="content-overlay">';
					dataGridHtml +='<h5>'+obj.property_name+'</h5>';
					dataGridHtml +='</a>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+BaseURL+'/'+obj.property_slug+'">'+obj.property_name+'</a></h3>';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="cartlink"><i class="fa fa-shopping-cart"></i></a>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					$('[data-option="property-grid-list"]').append(dataGridHtml);
				}
			});
		}

		function priceFilterAjax(){

				var datObj = window.location.search;
                    datObj =  datObj+'&s={{$slug}}';

				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/search-property-ajax'+datObj;
				params['successCallbackFunction'] = renderPropertyListPriceFilter;
				doAjax(params);

		}

		function renderPropertyListPriceFilter(data){
			$('[data-option="property-grid-list"]').html('');
			var dataGridHtml = '';
			$.each(data.properties, function (idx, obj) {
				if(idx==19)
				{
					if(data.resultads)
					{
						dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
						dataGridHtml +='<div class="hotel-card">';
						dataGridHtml +='<figure>';
						var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
						dataGridHtml += '<img src="' + imgscr + '" />';
						dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
						dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
						dataGridHtml +='</a>';
						dataGridHtml +='<div class="pricelabel">Advertisement</div>';
						dataGridHtml +='</figure>';
						dataGridHtml +='<div class="title">';
						dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
					}
				}
				else
				{
					dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="content-overlay">';
					dataGridHtml +='<h5>'+obj.property_name+'</h5>';
					if(obj.category_name!=undefined && obj.category_name!=""){
						dataGridHtml +='<p>From € '+obj.price+' '+obj.category_name+'</p>';
					}else {
						dataGridHtml +='<p>From € '+obj.price+'</p>';
					}

					dataGridHtml +='</a>';
					dataGridHtml +='<div class="pricelabel">From EUR '+obj.price+' / night</div>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+BaseURL+'/'+obj.property_slug+'">'+obj.property_name+'</a></h3>';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="cartlink"><i class="fa fa-shopping-cart"></i></a>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
				}
			});
			$('[data-option="property-grid-list"]').html(dataGridHtml);
		}
        
        
        
        function show_modal_content(memtype){
            $.ajax({
                url:'{{URL::to("membershiptype/popup")}}',
                type: "POST",
                data: {memtype:memtype},
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    var popupHtml = '';
                    if (data.status == 'success') {
                        var obj = data.mem_package;
                        popupHtml += '<div class="row">';
                        
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<img class="img-responsive object-fit-size" src="{{URL::to("uploads/category_imgs")}}/'+obj.category_image+'" style="width: 100%;">';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<h2 class="popup-title">'+obj.category_name+'</h2>';
                                popupHtml += '<p>'+(obj.category_description).replace(/\n/g,"<br>")+'</p>';
                                //popupHtml += '<h6>{!! isset($currency->content)?$currency->content:"&euro;" !!}'+obj.package_price+'</h6>';
                                
                                str_mem = '';
                                str_mem2 = '';
                                if(memtype=="dedicated-collection"){
                                    str_mem = 'Dedicated';
                                    str_mem2 = 'dedicated';
                                }else if(memtype=="bespoke-collection"){
                                    str_mem = 'Bespoke';
                                    str_mem2 = 'bespoke';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}?type='+str_mem2+'">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';
                                
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">';
                                popupHtml += '<a class="btnMembershipTypeBack" href="#" data-dismiss="modal" aria-hidden="true">Back</a>';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6  col-xs-12">';
                                /*str_mem = '';
                                if(memtype=="dedicated-membership"){
                                    str_mem = 'Dedicated';
                                }else if(memtype=="bespoke-membership"){
                                    str_mem = 'Bespoke';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';*/
                            popupHtml += '</div>';
                        popupHtml += '</div>';
                    }
                    $(".mem-modal-popup").html(popupHtml);
                }
            });
        }
        
        $(document).on('change', '#experience', function () {  
            var expr = $(this).val();
            window.location.href = '{{URL::to("luxury_experience")}}/'+expr;
        });
        $(document).on('change', '#dd-destination', function () {  
            var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            window.location.href = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;
        });
        
        
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
