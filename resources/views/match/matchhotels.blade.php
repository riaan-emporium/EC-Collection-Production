
@extends('layouts.app')

@section('content')
<div id="guestValidationMsg" class="alert alert-success fade show mt-4" style="display: none;">
    <p id="massage" class="mb-0"></p>
</div>
<div class="page-content row">
    <div class="page-content-wrapper m-t">      
        <div class="sbox animated fadeInRight">    
            <div class="sbox-content">  
                <div class="toolbar-line">
                   <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name='property_category' id='property_category' style="height: 28px; margin-left: 5px;" 
                            onchange="machhotels(this.value);"> 
                            <option>Select</option>
                                @if(!empty($category))
                                    @foreach($category as $catlist)
                                        <option value="{{$catlist->category_name}}" <?php if(Request::get('selcat') == $catlist->category_name){ echo 'selected';} ?>>{{$catlist->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        <div>
                    </div>         
                </div>
            </div>
        </div>
        @if(isset($hotels))
            <div class="table-responsive" style="min-height:300px;">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Emporium Hotel</th>
                            <th>Booking.com Hotel</th>
                            <th>Booking.com Prices</th>
                            <th>Edit Prices</th>
                            <th>Booking.com Suites</th>
                            <th>PropertyRoomImage</th>
                            <th>Actions</th>
                          </tr>
                    </thead>
                    <tbody>
                    <?php //if($prop->id == $val['property_id']){ echo ' selected="selected"';} 
                    $shown = [];
                    print count($matched);exit;
                    ?>
                    @if(isset($hotels))
                    @foreach ($matched as $key => $val)
                        <?php 
                        $hotelId = $val['hotel_id'];
                        $pId = $val['property_id'];
                        /*
                        $matchedKey = array_search($val->id, array_column($matched, 'hotel_id'));
                        if($matchedKey !== false){// && !in_array($val->id, $shown)
                            $hotelId = $matched[$matchedKey]['hotel_id'];
                            $pId = $matched[$matchedKey]['property_id'];
                            $shown[] = $val->id;
                        }else{
                            continue;
                        }
                        */
                        ?>
                        <tr id="match-row-{{ $key.'-'.$val['property_id'] }}">
                            <td width="30">
                                <select class="form-control emp-property" name="matched_property" style="height: 28px; margin-left: 5px;" id="emp-property"> 
                                    <option value="">Select</option>
                                    @foreach ($allprops as $prop)
                                        <option value="{{ $prop->id }}" 
                                            <?php 
                                            if($prop->id == $pId){
                                                echo ' selected="selected"';
                                            }
                                            ?>
                                            >{{ $prop->property_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="50">
                                <select class="form-control booking-property" name='hotel_property'style="height: 28px; margin-left: 5px;" id="booking-property"> 
                                    <option value="">Select</option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel['hotel_id'] }}" 
                                        <?php
                                        if($hotel['hotel_id'] == $hotelId){
                                            echo ' selected="selected"';
                                        }
                                        ?>
                                        >{{ $hotel['hotel_name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="30">
                                <a href="javascript:void(0)" onclick="viewPrice('{{ $key.'-'.$val['property_id'] }}')">View Prices</a>
                            </td>
                            <td width="30">
                                <a href="javascript:void(0)" onclick="editPrice('{{ $key.'-'.$val['property_id'] }}')">Edit Prices</a>
                            </td>
                            <td width="30">
                                <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal">View Suites</a>
                            </td>
                            <td width="30">
                                <a class="text-secondary" data-toggle="modal" id="displayButton" data-target="#displayImages" onclick="DisplayImages('{{ $key.'-'.$val['property_id'] }}');">RoomImage</a>
                            </td>
                            <td width="30"><button class="btn btn-primary form-control " onclick="savematch('{{ $key.'-'.$val['property_id'] }}');">Approve</button>
                            <button class="btn btn-primary form-control" onclick="importHotelDetail('{{ $key.'-'.$val['property_id'] }}');">Import</button></td>
                            <input type="hidden" name="dest_id" id="dest_id" value="{{ $val['dest_id'] }}">
                        </tr>
                    @endforeach
                    @endif    
                    </tbody>
                </table>  
            </div>
        @endif    
    </div>        
</div>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hotel Rooms</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mediumBody">
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="displayImages" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Display Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="roomPhotos">
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function editPrice(id){
        var property_id = $('.emp-property', $('#match-row-' + id)).val();
        if(!property_id){
            alert("Please select emporium hotel");
            return false;
        }
        window.open("/properties_settings/"+property_id+"/price");
    }

    function viewPrice(id){
        var hotel_id = $('.booking-property', $('#match-row-' + id)).val();
        if(!hotel_id){
            alert("Please select booking.com hotel");
            return false;
        }
        window.open("https://secure.booking.com/book.html?hotel_id=" + hotel_id + "&checkout={{ date ('Y-m-d', strtotime ('+180 day')) }}&checkin={{ date ('Y-m-d', strtotime ('+178 day')) }}&interval=2&stage=1&nr_rooms_729233401_325315371_3_0_0=1");
    }

    function machhotels(catg)
    {
        window.location.href = "{{URL::to('matchhotels')}}?selcat="+catg;
    }

    function savematch(id){
        var hotel_id = $('.booking-property', $('#match-row-' + id)).val();
        var property_id = $('.emp-property', $('#match-row-' + id)).val();

        if(!property_id || !hotel_id){
            alert("Please select both emporium and booking.com hotels");
            return false;
        }

        $.ajax({
            url: '/savematchhotels',
            data:{ hotel_id: hotel_id,
                property_id: property_id },
            type: 'post',
            dataType: 'json',

            success:function(response){
                if(response.status === true){
                    console.log(response);  
                    $('#guestValidationMsg').find('#massage').html("Data Submitted Succesfully");
                    $('#guestValidationMsg').show();
                }   
            }
        });
    }

    function importHotelDetail(id){
        var hotel_id = $('.booking-property', $('#match-row-' + id)).val();
        var dest_id = $("#dest_id").val();
        $.ajax({
            url: '/import/hotels',
            data: { hotel_id: hotel_id,
                    dest_id: dest_id },
            type: 'post',

            success:function(response){
                console.log(response)
                if(response.status === true){
                    $('#guestValidationMsg').find('#massage').html("Hotel Data is Imported from booking.com");
                    $('#guestValidationMsg').show();
                }   
                if(response.status === false){
                    $('#guestValidationMsg').find('#massage').html("This hotel data is already Imported");
                    $('#guestValidationMsg').show();
                }
          }
        });
    }

    function DisplayImages(id){
        var hotel_id = $('.booking-property', $('#match-row-' + id)).val();
        $('#roomPhotos').html("");
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'dipslay/room/',
            data: { hotel_id: hotel_id },

            success:function(response){
                $('#roomPhotos').html(response.roomphotos);
                $('#displayImages').modal("show");
            }
        });

    }

     $(document).on('click', '#mediumButton', function(event) {        
            event.preventDefault();
            $('#mediumBody').html("");
            var hotel_id = $('.booking-property', $(event.target).parents('tr')).val();

            if(!hotel_id){
                alert("Please select booking.com hotel");
                return false;
            }

            $.ajax({
                type:'GET',
                dataType: 'json',
                url: 'roomdetail/'+hotel_id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumBody').html(result.roomdetail);
                    $('#mediumModal').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    $(document).ready(function () {
        $('.matched_property').selectize({
            sortField: 'text'
        });
        $('.emp-property').selectize({
            sortField: 'text'
        });
        $('.booking-property').selectize({
            sortField: 'text'
        });
    });

</script> 
@stop
