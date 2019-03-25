@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')

<section id="searchresult" class="hotelSearchResultSection">
    <div class="hotelSearchResultInner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                @if(!empty($roomavailability))
                    <div class="heading">
                        Search Results <br />
                        <span class="sub-heading">The following suites are available for the selected criteria.</span>
                    </div>
                    <?php //print_r($propertyDetail['roomimgs']);
                        //$bg_img = '';
                        //if(!empty($propertyDetail['roomimgs'][0]->file_name)){
                        //    $bg_img = $propertyDetail['propimage'][0]->imgsrc.$propertyDetail['propimage'][0]->file_name;
                        //}
                    ?><div class="row">
                        <div class="col-xs-8">
                    {{--*/ $req_room = (int)$booking_rooms; $total_price = 0 ; $arr_items = array(); $remianing_adult = 0; /*--}}
                    <?php
                        $number_of_nights = '';
                        if($arrive_new != '' && $departure_new != '') {
                            $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure_new)));
                            $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_new)));
                            $diff = date_diff($date1, $date2);
                            $number_of_nights = $diff->format("%a");
                            $number_of_nights;
                        }
                    ?>
                    @foreach($roomavailability as $si)
                    
                            <div class="box">
                                <div class="rw">
                                    <div class="col-3">
                                        <img src="{{$si['img_url']}}" class="img-responsive"  />
                                    </div>
                                    <div class="col-3">
                                        <div class="inner-box">
                                            <div class="suite-name">{{$si['rooms']}} x {{$si['cat_name']}}</div>
                                            <div class="line"><hr /></div>
                                            <div class="price">&euro;{{$si['price']}}</div>
                                            <div class="room-available">
                                                @if($req_room > 0)
                                                    {{--*/ 
                                                    
                                                    $arr_item['room_avail'] = $si['rooms'];
                                                    $arr_item['price'] = $si['price'];
                                                    $arr_item['type'] = $si['cat_name'];
                                                    $arr_item['cat_id'] = $si['cat_id'];
                                                    
                                                    $req_room = (int)$req_room - (int)$si['rooms']; 
                                                    $checked = "checked='checked'";
                                                     
                                                    if($booking_rooms < $si['rooms']){
                                                        $room_av = $booking_rooms;
                                                    }else{
                                                        $room_av = $si['rooms'];
                                                    }  
                                                    $total_price = (int)$total_price + (int)($si['price'] * $room_av); 
                                                    
                                                    $arr_items[] = $arr_item;
                                                    
                                                    /*--}}                                                   
                                                    
                                                @else
                                                    {{--*/ $checked = "" /*--}}
                                                @endif
                                                <div class="available"><input type="text" class="form-control" name="available-room-{{$si['cat_id']}}" value="{{$room_av}}" id="noOfRooms-{{$si['cat_id']}}" /></div>
                                                <div class="add-room">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="roomType-{{$si['cat_id']}}" {{$checked}} value="{{$si['cat_id']}}" />
                                                            Add to reservation
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        {{--@if($si['rooms'] > $booking_rooms) --}}
                                        <div class="tbl tbl-width-200">
                                            @if(!empty(Session::get('travellerType'))) 
                                                {{--*/ $travellerType = Session::get('travellerType') /*--}} 
                                            @else
                                                {{--*/ $travellerType = '' /*--}} 
                                            @endif
                                            @if(!empty(Session::get('booking_rooms'))) 
                                                {{--*/ 
                                                    $rooms = Session::get('booking_rooms');
                                                    if($rooms >= $si['rooms']){
                                                        $rooms = $si['rooms'];
                                                    }
                                                /*--}}
                                            @else
                                                {{--*/ $rooms = 1 /*--}} 
                                            @endif
                                            @if(!empty(Session::get('booking_adults'))) 
                                                {{--*/ 
                                                    $rooms2 = Session::get('booking_rooms');
                                                    $totalAdults = Session::get('booking_adults');
                                                    $adult = Session::get('booking_adults');
                                                    $adultAssign = 0; 
                                                    if($travellerType!=''){
                                                        if($travellerType==0){
                                                            $adultAssign = 1;    
                                                        }else if($travellerType==1){
                                                            $adultAssign = 2;    
                                                        }else{
                                                            $perroomadult = ceil($adult/$rooms2);
                                                            $adultAssign = $perroomadult;
                                                        }
                                                    }
                                                    
                                                    if($totalAdults >= $adultAssign){
                                                        //$adult = $adultAssign;
                                                        //$remianing_adult = $remianing_adult - $adultAssign;
                                                    }else{
                                                        
                                                    }
                                                /*--}} 
                                            @else
                                                {{--*/ $adult = 1 /*--}} 
                                            @endif
                                            @if(!empty(Session::get('booking_children'))) 
                                                {{--*/ $child = Session::get('booking_children') /*--}} 
                                            @else
                                                {{--*/ $child = 0 /*--}} 
                                            @endif
                                            
                                            
                                            <div class="rw">
                                                <div class="col-20 minus-room-available" data-id="{{$si['cat_id']}}">
                                                    -
                                                    <input type="hidden" name="hid-minus-plus-room" id="hid-minus-plus-room-{{$si['cat_id']}}" value="{{$rooms}}" />
                                                </div>
                                                <div class="col-60 minus-plus-room-{{$si['cat_id']}}" data-id="{{$si['cat_id']}}" data-room='{{$rooms}}' data-adult='{{$adult}}' data-child='{{$child}}' data-available-room="{{$si['rooms']}}">{{$rooms}} room</div>
                                                <div class="col-20 plus-room-available" data-id="{{$si['cat_id']}}">+</div>
                                            </div>
                                            <div class="rw">
                                                <div class="col-20 minus-adult-available" data-id="{{$si['cat_id']}}">
                                                    -
                                                    <input type="hidden" name="hid-minus-plus-adult" id="hid-minus-plus-adult-{{$si['cat_id']}}" value="{{$adult}}" />
                                                </div>
                                                <div class="col-60 minus-plus-adult-{{$si['cat_id']}}" data-id="{{$si['cat_id']}}" data-room='{{$rooms}}' data-adult='{{$adult}}' data-child='{{$child}}' data-max-guest="{{$si['max_guest']}}">{{$adult}} adult</div>
                                                <div class="col-20 plus-adult-available" data-id="{{$si['cat_id']}}">+</div>
                                            </div>

                                            <div class="rw child-minus-plus">
                                                <div class="col-20 minus-child-available" data-id="{{$si['cat_id']}}">
                                                    -
                                                    <input type="hidden" name="hid-minus-plus-child" id="hid-minus-plus-child-{{$si['cat_id']}}" value="{{$child}}" />
                                                </div>
                                                <div class="col-60 minus-plus-child-{{$si['cat_id']}}" data-id="{{$si['cat_id']}}" data-room='{{$rooms}}' data-adult='{{$adult}}' data-child='{{$child}}'>{{$child}} children</div>
                                                <div class="col-20 plus-child-available" data-id="{{$si['cat_id']}}">+</div>
                                            </div>
                                            
                                        </div>
                                        <div class="tbl child-age-{{$si['cat_id']}}">
                                            @if(!empty($child_age))
                                                {{--*/  $sr = 1;  /*--}}
                                                @foreach($child_age as $age)
                                                    <div class="col-30">
                                                        <div class="lable">Child {{$sr}}</div>
                                                        <select name="child{{$sr}}" class="form-control child-age">
                                                            @for($i=0; $i<=14; $i++)
                                                                <option value="$i" {{$i==$age ? 'selected="selected"' : ''}} >{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div> 
                                                    {{--*/  $sr = $sr + 1;  /*--}}   
                                                @endforeach
                                            @endif
                                        </div>
                                        {{-- @endif --}}
                                    </div>
                                    {{--<div class="col-3">                                    
                                        <a href="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" class="btn yellowbtn">Make Reservation</a>
                                    </div>--}}
                                </div>
                            </div> 
                             
                              
                    @endforeach
                    </div>
                        <div class="col-xs-4 padding-margin">
                            <div class="your-stay-box">
                                <div class="col-xs-12"><h3>Your stay</h3></div>
                                <div class="col-xs-6">
                                    <h5>Arrival Date</h5>
                                    <span><?php echo date('d M Y', strtotime($arrive_new)) ?></span>
                                </div>
                                <div class="col-xs-6">
                                    <h5>Departure Date</h5>
                                    <span><?php echo date('d M Y', strtotime($departure_new)) ?></span>
                                </div>
                                <div class="col-xs-6">
                                    <h5>#Nights(s)</h5>
                                    <span>
                                    {{$number_of_nights}}
                                    </span>
                                </div>                                
                                @if(!empty($arr_items))
                                    @foreach($arr_items as $item)
                                        <div class="col-xs-12"><hr /></div>
                                        <div class="row">
                                            <div class="col-xs-12">                                                                                    
                                                <div class="col-xs-6">{{$item['type']}}</div>
                                                <div class="col-xs-6 text-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{$item['price']}}<br />price per night </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="col-xs-4">#Room(s)</div>
                                                <div class="col-xs-8 yourStayRoom-{{$item['cat_id']}}">{{$item['room_avail']}} </div>
                                                <div class="col-xs-4">Guests</div>
                                                <div class="col-xs-8 yourStayGuest-{{$item['cat_id']}}">
                                                    {{($booking_adults > 1) ? $booking_adults." adults" : $booking_adults." adult"}}
                                                    @if($booking_children > 0)
                                                    , {{($booking_children > 1) ? $booking_children." children" : $booking_children." child"}}                                                                        @endif                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-xs-12"><hr /></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-xs-6">Total Amount</div>
                                        <div class="col-xs-6 text-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($total_price*$number_of_nights, 2)}}</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-center btn-pad-20">
                                    <button type="submit" class="btn yellowbtn" id="make-reservation">Make Reservation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php //print_r($roomavailability); ?>
                    <div class="footer">
                        <form class="available-booking-form" action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get" id="available-booking-form">
                            <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}"/>
                            <input type="hidden" name="arrive" id="arrive" value="{{$arrive}}"/>
                            <input type="hidden" name="departure" id="departure" value="{{$departure}}"/>
                            <input type="hidden" name="booking_rooms" id="booking_rooms" value="{{$booking_rooms}}"/>
                            <input type="hidden" name="booking_adults" id="booking_adults" value="{{$booking_adults}}"/>
                            <input type="hidden" name="booking_children" id="booking_children" value="{{$booking_children}}"/>
                            <input type="hidden" name="travellerType" id="travellerType" value="{{$travellerType}}"/>
                            <input type="hidden" name="roomType" id="roomType" value=""/>
                            <input type="hidden" name="child_age" id="child_age" value=""/>
                            <!--<button type="submit" class="btn yellowbtn" id="make-reservation">Make Reservation</button>-->
                        </form>
                    </div>
                @else
                    <span class="search-result-error">Unfortunately we have no rooms available for you date range, Please change you dates or we can suggest the following hotels</span>
                @endif
                    
                
                </div>
            </div>
        </div>
    </div>
</section>
	
@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')
    @include('frontend.themes.emporium.layouts.sections.pdp_right_iconbar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    @include('frontend.themes.emporium.layouts.sections.pdp_top_search_bar')
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.pdp_sidebar')
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    <link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
    
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
    function checkRoomAdultChild(id, type, plusMinus, aroom=0){
        var t_type = id; 
        var type_val = '';
        var type_text = '';
        console.log(id+', '+type+', '+plusMinus);
        //var room = $(".minus-plus-room-"+t_type).attr('data-room');
        //var adult = $(".minus-plus-room-"+t_type).attr('data-adult');
        //var child = $(".minus-plus-room-"+t_type).attr('data-child');
        if(type!=""){
            type_val = $(".minus-plus-"+type+"-"+t_type).attr('data-'+type);  
            console.log(type_val);      
            if(plusMinus=="plus"){
                if(type=="room"){
                    if(type_val >= 0 && type_val < aroom){
                        type_val = parseInt(type_val) + 1;
                        $("#hid-minus-plus-room-"+id).val(type_val);
                        
                        $(".yourStayRoom-"+t_type).html('');
                        $(".yourStayRoom-"+t_type).html(type_val)
                    }else{
                        alert("No more rooms available");
                    }
                }
                else{
                    var rm = $(".minus-plus-room-"+id).attr("data-room");
                    var mg = $(".minus-plus-adult-"+id).attr("data-max-guest");
                    var ad = $(".minus-plus-adult-"+id).attr("data-adult");
                    var ch = $(".minus-plus-child-"+id).attr("data-child");
                    var t_g = parseInt(ad) + parseInt(ch);
                    var tmg = parseInt(rm) * parseInt(mg);
                    console.log(t_g);
                    if(type_val >= 0 && t_g < tmg){
                        type_val = parseInt(type_val) + 1;
                        $("#hid-minus-plus-"+type+"-"+id).val(type_val);
                        if(type=="child"){
                            room_avail_add_child(t_type, type_val);
                        }
                    }else{
                        if(type=="child"){                            
                            alert("No more child will be added");
                        }else{
                            alert("No more adult will be added");
                        }
                    }
                    /*if(type_val >= 0){
                        type_val = parseInt(type_val) + 1;
                    }*/
                    
                }
            }else{
                if(type=="child"){
                    if(type_val > 0){
                        type_val = parseInt(type_val) - 1;
                        $("#hid-minus-plus-"+type+"-"+id).val(type_val);
                        room_avail_remove_child(t_type, type_val);
                    }
                }else{
                    if(type_val > 1){
                        type_val = parseInt(type_val) - 1;
                        $("#hid-minus-plus-"+type+"-"+id).val(type_val);
                        if(type=="room"){
                            $(".yourStayRoom-"+t_type).html('');
                            $(".yourStayRoom-"+t_type).html(type_val)
                        }
                    }
                }
                //$(".yourStayGuest-"+t_type).html('');
            }
            if(type_val > 1){
                if(type=="child"){
                    type_text = type_val+' children';
                }else{
                    type_text = type_val+' '+type+'s';
                }    
            }else{
                if(type=="child"){
                    if(type_val==1){                        
                        type_text = type_val+' child';
                    }else{
                        type_text = type_val+' children';
                    }
                }else{
                    type_text = type_val+' '+type;
                }   
                //type_text = type_val+' '+type+'s';
            }
            $(".minus-plus-"+type+"-"+t_type).html('');
            $(".minus-plus-"+type+"-"+t_type).html(type_text);
            $(".minus-plus-"+type+"-"+t_type).attr('data-'+type, type_val);
            if(type=="room"){                
                $("#noOfRooms-"+t_type).val(type_val);
            }
        }        
    }
    $(document).ready(function(){
        $(document).on('click', '.minus-room-available', function () { 
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-room-"+t_type).attr('data-room');
            var adult = $(".minus-plus-room-"+t_type).attr('data-adult');
            var child = $(".minus-plus-room-"+t_type).attr('data-child');
            
            checkRoomAdultChild(t_type, 'room', 'minus');
            /*if(room > 1){
                room = parseInt(room) - 1;
                
            }
            $(".minus-plus-room-"+t_type).attr('data-room', room);
            var noOfRooms = $("#noOfRooms-"+t_type).val(room);*/         
        });
        $(document).on('click', '.plus-room-available', function () {            
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-room-"+t_type).attr('data-room');
            var adult = $(".minus-plus-room-"+t_type).attr('data-adult');
            var child = $(".minus-plus-room-"+t_type).attr('data-child');
            var aroom = $(".minus-plus-room-"+t_type).attr('data-available-room');
            
            checkRoomAdultChild(t_type, 'room', 'plus', aroom);
            /*if(room > 0){
                room = parseInt(room) + 1;
                
            }
            $(".minus-plus-room-"+t_type).attr('data-room', room);
            var noOfRooms = $("#noOfRooms-"+t_type).val(room);*/
                      
        });
        $(document).on('click', '.minus-adult-available', function () { 
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-adult-"+t_type).attr('data-room');
            var adult = $(".minus-plus-adult-"+t_type).attr('data-adult');
            var child = $(".minus-plus-adult-"+t_type).attr('data-child');
            
            checkRoomAdultChild(t_type, 'adult', 'minus');  
        });
        $(document).on('click', '.plus-adult-available', function () { 
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-adult-"+t_type).attr('data-room');
            var adult = $(".minus-plus-adult-"+t_type).attr('data-adult');
            var child = $(".minus-plus-adult-"+t_type).attr('data-child');
            var maxGuest = $(".minus-plus-adult-"+t_type).attr('data-max-guest');
            checkRoomAdultChild(t_type, 'adult', 'plus', maxGuest);    
        });
        
        $(document).on('click', '.minus-child-available', function () { 
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-child-"+t_type).attr('data-room');
            var adult = $(".minus-plus-child-"+t_type).attr('data-adult');
            var child = $(".minus-plus-child-"+t_type).attr('data-child');
            
            checkRoomAdultChild(t_type, 'child', 'minus');  
        });
        $(document).on('click', '.plus-child-available', function () { 
            var t_type = $(this).attr('data-id'); 
            var room = $(".minus-plus-child-"+t_type).attr('data-room');
            var adult = $(".minus-plus-child-"+t_type).attr('data-adult');
            var child = $(".minus-plus-child-"+t_type).attr('data-child');
            
            checkRoomAdultChild(t_type, 'child', 'plus');  
        });
        
        $("#make-reservation").click(function(e){
           e.preventDefault();
           var flag = 0;
           var r_val = '';
           $("input[type='checkbox']").each(function(index, value){
                if($(this).is(':checked')){
                    var t_id = $(this).val();                    
                    var r_avail = $("#noOfRooms-"+t_id).val();
                    var adul = $("#hid-minus-plus-adult-"+t_id).val();
                    var chd = $("#hid-minus-plus-child-"+t_id).val();
                    if(adul == undefined){
                        adul = {{$booking_adults}};
                    }
                    if(chd == undefined){
                        chd = '{{$booking_children}}';    
                    }
                    if(r_val==''){
                        r_val = t_id+"-"+r_avail+"-"+adul+"-"+chd;
                    }else{
                        r_val = r_val + '#'+t_id+"-"+r_avail+"-"+adul+"-"+chd;
                    }                    
                    flag = 1;
                }
           });
           $("#roomType").val(r_val); 
           //console.log(flag);
           if(flag){
                $("#available-booking-form").submit();
           }else{
                alert("Please checked at least one room");
           }
        });
        
        $(document).on('click', 'input[type="checkbox"]', function(){
            $('input[type="checkbox"]').each(function(index, value){
                console.log(index+"/"+value);
                if($(this).is(':checked')){
                    console.log($(this).val());
                }
            });
        }); 
        
    });
    function room_avail_add_child(type, child_no){
        var _html = '';
        //_html += '<div class="rw ">';
            _html += '<div class="col-30">';
                _html += '<div class="lable">Child '+child_no+'</div>';
                    _html += '<select name="child'+child_no+'" class="form-control child-age">';
                    for(i=0; i<=14; i++){
                         _html += '<option value='+i+'>'+i+'</option>';        
                    }
                    _html += '</select>';
                _html += '</div>';
            _html += '</div>';
        //_html += '</div>';
        
        $('.child-age-'+type).append(_html);
    }
    function room_avail_remove_child(type){    
        $('.child-age-'+type+' .col-30:last').remove();
    }

    </script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
