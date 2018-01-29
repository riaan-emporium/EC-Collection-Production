
@extends('frontend.layouts.ev.customer')
@section('content')
<section>

    <div>

  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
        <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i>ADS</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"><i class="fa fa-star-o" aria-hidden="true"></i>FAVOURITE</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"><i class="fa fa-rocket" aria-hidden="true"></i>Service</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Magazine</a></li>

    <li  role="presentation" class="<?php echo (isset($active_menu) && $active_menu == 'bookings')? 'active' : ''; ?>">
                                                        <a href="{{URL::to('bookings')}}">
                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>Bookings
                                                        </a>
                                                    </li>

     <li role="presentation"><a href="#accountOptions" aria-controls="accountOptions" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Account Settings</a></li>



       <li role="presentation"><a href="{{ URL::to('')}}" aria-controls="settings" role="tab" data-toggle="tab"> <i class="fa fa-home" aria-hidden="true"></i>Frontend</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Technical Support</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
                <form class="form-horizontal my-profile-main-form-align">
					<div class="form-group profile-page-submit-radio-align">        
                        <div class="col-sm-12">
                            <div class="radio">
                                <label class="radio-label"><input type="radio" name="usertype" value="guests" class="usertype" checked="checked">Guests</label>
                            </div>
							<div class="radio">
                                <label class="radio-label"><input type="radio" name="usertype" value="hotel" class="usertype">Hotel</label>
                            </div>
							<div class="radio">
                                <label class="radio-label"><input type="radio" name="usertype" value="advertiser" class="usertype">Advertiser</label>
                            </div>
                        </div>
                    </div>
					<div id="guests">
						<div class="form-group">
							<label class="control-label col-sm-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control dash-input-style" placeholder="Riaan">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control dash-input-style" placeholder="designlocations@gmail.com">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Phone</label>
							<div class="col-sm-10">          
								<input type="password" class="form-control dash-input-style" placeholder="+91-9876543210">
							</div>
						</div>
						<div class="form-group profile-page-submit-radio-align">        
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label"><input type="radio">Subscribe to our notifications and news to our latest hotels, spa's and offers</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label"><input type="radio">I require personalized service bookings in my account profile</label>
								</div>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-12">
								<button type="submit" class="btn btn-default dash-btn-style">Save Profile</button>
							</div>
						</div>
					</div>
					<div id="hotel" style="display:none;">
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Name</label>
								<input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Hotel Status</label>
								<select name="hotelinfo_status" class="bg-white medium-input">
									<option value="">Select Status</option>
									<option value="">Open</option>
									<option value="">Construction phase</option>
									<option value="">Planning phase</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Type</label>
								<select name="hotelinfo_type" class="bg-white medium-input">
									<option value="">Hotel Type</option>
									<option value="">Alternative</option>
									<option value="">Beach Resort</option>
									<option value="">Resort</option>
									<option value="">City</option>
									<option value="">Mountain</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Hotel Building</label>
								<select name="hotelinfo_building" class="bg-white medium-input">
									<option value="">Hotel Building</option>
									<option value="">New Construction</option>
									<option value="">Existing Building</option>
									<option value="">Conversion</option>
								</select>
							</div> 
							<div class="col-md-12 col-sm-12 no-padding">
								<label>*Hotel Opening Date</label>
								<input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Street & Number</label>
								<input type="text" name="hotelinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*City</label>
								<input type="text" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Country</label>
								<input type="text" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Postal Code</label>
								<input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
							</div>
							<div class="col-md-12 sm-clear-both no-padding">
								<label>*Hotel Website</label>
								<input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12 no-padding-left">
								<label>*Days open for business</label>
								<input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12">
								<label>Avg. Daily Rate</label>
								<input type="text" name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12 no-padding-right">
								<label>Avg. Occupancy</label>
								<input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input">
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Number of Rooms</label>
								<input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Number of Suites</label>
								<input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input">
							</div>
							<div class="row padding-row">
								<div class="col-md-6 col-sm-12 no-padding-left">
									<label>F & B Outlets</label>
									<select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input">
										<option value="">-</option>
										<option value="Restaurant">Restaurant</option>
										<option value="Bar">Bar</option>
										<option value="Beach Bar">Beach Bar</option>
										<option value="Club">Club</option>
										<option value="Lobby/Lounge">Lobby/Lounge</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-12 no-padding-right">
									<label>Guest Facilities</label>
									<select name="hotelfac_guest_fac" multiple="" class="bg-white medium-input">
										<option value="">-</option>
										<option value="">Gym</option>
										<option value="">Indoor Pool</option>
										<option value="">Outdoor Pool</option>
										<option value="">Spa</option>
										<option value="">Business Center</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Meeting Area</label>
								<input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Meeting Facilities</label>
								<select name="hotelfac_meeting_fac" class="bg-white medium-input">
									<option>Please select</option>
									<option>YES</option>
									<option>NO</option>
								</select>
							</div>
							<div class="col-md-12 sm-clear-both no-padding">
								<label>Comments/Other Facilities</label>
								<textarea name="hotelfac_comments" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Concept</label>
								<textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Architecture & Design</label>
								<textarea name="hoteldesc_architecture_design" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Architect Name</label>
								<input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Architect Website</label>
								<input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Interior Designer Name</label>
								<input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Interior Designer Website</label>
								<input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Local Integration</label>
								<textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand</label>
								<textarea name="hoteldesc_brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Brand Agency Name</label>
								<input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand Agency Website</label>
								<input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Brand Linkedin Profile</label>
								<input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand Instagram Profile</label>
								<input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" bg-white medium-input">
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
							<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
							
							<div class="col-md-12 col-sm-12 no-padding">
								<label>*Entity Name</label>
								<input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Street & Number</label>
								<input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*City</label>
								<input type="text" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Country</label>
								<input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Postal Code</label>
								<input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
							</div>
							<div class="clear"></div>
							<div class="headingmimiform">
								<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*First Name</label>
								<input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Last Name</label>
								<input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Company Name</label>
								<input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Job Title</label>
								<input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 no-padding">
								<label>*Email Address</label>
								<input type="email" name="hotel_contactprsn_email" placeholder="Email*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 no-padding-right">
								<label>*Username</label>
								<input type="email" name="hotel_contactprsn_username" placeholder="Username*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Password</label>
								<input type="password" name="hotel_contactprsn_password" placeholder="Password*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Confirm Password</label>
								<input type="password" name="hotel_contactprsn_password_confirmation" placeholder="Confirm password*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Phone</label>
								<input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Mobile</label>
								<input type="text" name="hotel_contactprsn_mobile" placeholder="Mobile*" class="bg-white medium-input">
							</div>
						</div>
					</div>
					<div id="advertiser" style="display:none;">
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Name</label>
								<input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Hotel Status</label>
								<select name="hotelinfo_status" class="bg-white medium-input">
									<option value="">Select Status</option>
									<option value="">Open</option>
									<option value="">Construction phase</option>
									<option value="">Planning phase</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Type</label>
								<select name="hotelinfo_type" class="bg-white medium-input">
									<option value="">Hotel Type</option>
									<option value="">Alternative</option>
									<option value="">Beach Resort</option>
									<option value="">Resort</option>
									<option value="">City</option>
									<option value="">Mountain</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Hotel Building</label>
								<select name="hotelinfo_building" class="bg-white medium-input">
									<option value="">Hotel Building</option>
									<option value="">New Construction</option>
									<option value="">Existing Building</option>
									<option value="">Conversion</option>
								</select>
							</div> 
							<div class="col-md-12 col-sm-12 no-padding">
								<label>*Hotel Opening Date</label>
								<input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Street & Number</label>
								<input type="text" name="hotelinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*City</label>
								<input type="text" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Country</label>
								<input type="text" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Postal Code</label>
								<input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
							</div>
							<div class="col-md-12 sm-clear-both no-padding">
								<label>*Hotel Website</label>
								<input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12 no-padding-left">
								<label>*Days open for business</label>
								<input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12">
								<label>Avg. Daily Rate</label>
								<input type="text" name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input">
							</div>
							<div class="col-md-4 col-sm-12 no-padding-right">
								<label>Avg. Occupancy</label>
								<input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input">
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Number of Rooms</label>
								<input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Number of Suites</label>
								<input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input">
							</div>
							<div class="row padding-row">
								<div class="col-md-6 col-sm-12 no-padding-left">
									<label>F & B Outlets</label>
									<select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input">
										<option value="">-</option>
										<option value="Restaurant">Restaurant</option>
										<option value="Bar">Bar</option>
										<option value="Beach Bar">Beach Bar</option>
										<option value="Club">Club</option>
										<option value="Lobby/Lounge">Lobby/Lounge</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-12 no-padding-right">
									<label>Guest Facilities</label>
									<select name="hotelfac_guest_fac" multiple="" class="bg-white medium-input">
										<option value="">-</option>
										<option value="">Gym</option>
										<option value="">Indoor Pool</option>
										<option value="">Outdoor Pool</option>
										<option value="">Spa</option>
										<option value="">Business Center</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Meeting Area</label>
								<input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Meeting Facilities</label>
								<select name="hotelfac_meeting_fac" class="bg-white medium-input">
									<option>Please select</option>
									<option>YES</option>
									<option>NO</option>
								</select>
							</div>
							<div class="col-md-12 sm-clear-both no-padding">
								<label>Comments/Other Facilities</label>
								<textarea name="hotelfac_comments" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Hotel Concept</label>
								<textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Architecture & Design</label>
								<textarea name="hoteldesc_architecture_design" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Architect Name</label>
								<input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Architect Website</label>
								<input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Interior Designer Name</label>
								<input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Interior Designer Website</label>
								<input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Local Integration</label>
								<textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand</label>
								<textarea name="hoteldesc_brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea"></textarea>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Brand Agency Name</label>
								<input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand Agency Website</label>
								<input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>Brand Linkedin Profile</label>
								<input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Brand Instagram Profile</label>
								<input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" bg-white medium-input">
							</div>
						</div>
						<div class="row">
							<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
							<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Street & Number</label>
								<input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*City</label>
								<input type="text" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Country</label>
								<input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Postal Code</label>
								<input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
							</div>
							<div class="clear"></div>
							<div class="headingmimiform">
								<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*First Name</label>
								<input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Last Name</label>
								<input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Company Name</label>
								<input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Job Title</label>
								<input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 no-padding">
								<label>*Email Address</label>
								<input type="email" name="hotel_contactprsn_email" placeholder="Email*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 no-padding-right">
								<label>*Username</label>
								<input type="email" name="hotel_contactprsn_username" placeholder="Username*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Password</label>
								<input type="password" name="hotel_contactprsn_password" placeholder="Password*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Confirm Password</label>
								<input type="password" name="hotel_contactprsn_password_confirmation" placeholder="Confirm password*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>*Phone</label>
								<input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input">
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>*Mobile</label>
								<input type="text" name="hotel_contactprsn_mobile" placeholder="Mobile*" class="bg-white medium-input">
							</div>
						</div>
					</div>
                </form>
            </div>
        </div></div></div>
    <div role="tabpanel" class="tab-pane " id="home">Coming Soon....</div>
   
    <div role="tabpanel" class="tab-pane" id="messages">Coming Soon...</div>
 
    <div role="tabpanel" class="tab-pane" id="comingsoon">Coming Soon...</div>
    <div role="tabpanel" class="tab-pane" id="accountOptions"> 
         <div class="row">
                <div >
                    <ul class="list-group" >
                                <li class="list-group-item"><a class="active" href="#">Account Information</a></li>
                                <li class="list-group-item"><a href="#">Profile</a></li>
                                <li class="list-group-item"><a href="#">Featured Items</a></li>
                                <li class="list-group-item"><a href="#">Email</a></li>
                                <li class="list-group-item"><a href="#">Invitions</a></li>
                                <li class="list-group-item"><a href="#">Blocked User</a></li>
                                <li class="list-group-item"><a href="#">Delete Account</a></li>
                            </ul>
               
                </div>
            </div>

    </div>
  </div>

</div>
   
   
</section>
<script>
	 $(document).on('click', '.usertype', function () {
		 $('#guests').hide();
		 $('#hotel').hide();
		 $('#advertiser').hide();
		 var uservar = $(this).val();
		 alert(uservar);
		 $('#'+uservar).show();
	 });
</script>
@endsection