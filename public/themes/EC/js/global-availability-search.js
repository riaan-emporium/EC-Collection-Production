var properties = [];
function replacePropertyData(id){
  var field = '';
  $('[data-place="property"]').each(function() {
      field = $(this).attr('data-replace');
      console.log(properties[id][field]);
      console.log(field);
      $(this).html(properties[id][field]);
  });

  $('[data-place="property-multi-value"]').each(function() {
      field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id][field].split(',');
      var listview = '';
      values.forEach(function(e){
        listview += '<p class="mb-0">' + e + '</p>';
      })
      $(this).html(listview);
  });

  $('[data-place="property-images"]').each(function() {
      // field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id]['images'];
      var imageview = '';
      var spanid = 1;
      var grid = 1;
      values.forEach(function(e){
        imageview += '<a href="#" data-sub-html="alter text" class="grid-item grid-row-' + grid + ' span-' + spanid + '"><img src="uploads/container_user_files/locations/' + properties[id]['container']['name'] + '/property-images/' + e.file_name + '" class="img-fluid" alt=""></a>';
        spanid=2;
        grid++;
      })
      $(this).html(imageview);
  });

  $('[data-place="room-images"]').each(function() {
      // field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id]['room_images'];
      var imageview = '';
      var spanid = 1;
      var grid = 1;
      values.forEach(function(e){
        imageview += '<a href="#" data-sub-html="alter text" class="grid-item grid-row-' + grid + ' span-' + spanid + '"><img src="uploads/container_user_files/locations/' + properties[id]['container']['name'] + '/property-images/' + e.file_name + '" class="img-fluid" alt=""></a>';
        spanid=2;
        grid++;
      })
      $(this).html(imageview);
  });

  $('[data-place="bar-images"]').each(function() {
      // field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id]['bar_images'];
      var imageview = '';
      var spanid = 1;
      var grid = 1;
      values.forEach(function(e){
        imageview += '<a href="#" data-sub-html="alter text" class="grid-item grid-row-' + grid + ' span-' + spanid + '"><img src="uploads/container_user_files/locations/' + properties[id]['container']['name'] + '/property-images/' + e.file_name + '" class="img-fluid" alt=""></a>';
        spanid=2;
        grid++;
      })
      $(this).html(imageview);
  });

  $('[data-place="restrurant-images"]').each(function() {
      // field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id]['restrurant_images'];
      var imageview = '';
      var spanid = 1;
      var grid = 1;
      values.forEach(function(e){
        imageview += '<a href="#" data-sub-html="alter text" class="grid-item grid-row-' + grid + ' span-' + spanid + '"><img src="uploads/container_user_files/locations/' + properties[id]['container']['name'] + '/property-images/' + e.file_name + '" class="img-fluid" alt=""></a>';
        spanid=2;
        grid++;
      })
      $(this).html(imageview);
  });

  $('[data-place="spa-images"]').each(function() {
      // field = $(this).attr('data-replace');
      //console.log(properties[id][field]);
      var values = properties[id]['spa_images'];
      var imageview = '';
      var spanid = 1;
      var grid = 1;
      values.forEach(function(e){
        imageview += '<a href="#" data-sub-html="alter text" class="grid-item grid-row-' + grid + ' span-' + spanid + '"><img src="uploads/container_user_files/locations/' + properties[id]['container']['name'] + '/property-images/' + e.file_name + '" class="img-fluid" alt=""></a>';
        spanid=2;
        grid++;
      })
      $(this).html(imageview);
  });

  setMapLocation(properties[id]['latitude'], properties[id]['longitude']);
}

function replacePropertySuites(id){
  var suiteview = '';
  var firstsuite = 0;
  $('[data-place="property-suites"]').each(function() {
      suiteview += `<li class="nav-item">
          <a class="nav-link" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab"
              aria-controls="suiteslist" aria-selected="true">Suites</a>
      </li>`;
      var values = properties[id]['suites'];
      values.forEach(function(e){
        if(!firstsuite){
          firstsuite = e.id;
        }
        suiteview += `<li class="nav-item" onclick="replaceRooms(` + id + `, ` + e.id + `)">
            <a class="nav-link nav-link-sub" id="suitelist` + e.id + `-tab" data-toggle="pill"
                href="#suitelist1" role="tab" aria-controls="suitelist1" aria-selected="false"> ` + e.category_name + `</a>
        </li>`;
      })
      $(this).html(suiteview);
      replaceRooms(id, firstsuite);
  });
}

function replaceRooms(property_id, category_id){
  var suite;
  properties[property_id]['suites'].forEach(function(e){
    if(category_id === e.id){
      suite = e;
    }
  });

  var roomview = ``;
  var roomimages = ``;
  suite.rooms.forEach(function(r){
    roomimages = ``;
    r.images.forEach(function(rm){
      roomimages += `<div>
        <img src="uploads/container_user_files/locations/` + properties[property_id]['container']['name'] + `/rooms-images/` + suite.category_name.replaceAll(' ', '-').toLowerCase() + `/` + rm['file']['file_name'] + `" class="w-100" alt="">
      </div>`;
    });
    roomview += `<div>
    <div class="header-suite-list justify-content-between align-items-center mb-2">
      <div class="title-outer-container">
          <div class="title-main offset-930 pr-3 title-subs">
              <h2>Premiere Suite</h2>
          </div>
          <div class="meta-title">
              <span>Sleeps</span>
              <span>` + r.num_beds + ` Queens beds </span>
              <span>Suite size: ` + r.suite_size + ` ft</span>
          </div>
      </div>
      <div class="dropdown ipad-view">
          <button class="btn dropdown-toggle p-0" type="button" id="suiteDetail"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Suite Details
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="suiteDetail">
              <a class="dropdown-item btn-sidebar" href="#"
                  data-sidebar="#suiteinfo">Suite Info</a>
              <a class="dropdown-item btn-sidebar" href="#"
                  data-sidebar="#reviews">Reviews</a>
              <a class="dropdown-item btn-sidebar" href="#"
                  data-sidebar="#availability">Availability</a>
              <a class="dropdown-item btn-sidebar" href="#"
                  data-sidebar="#myCollection">Add to Collection</a>
              <a class="dropdown-item btn-sidebar" href="#"
                  data-sidebar="#share">Share</a>
              <a class="dropdown-item btn-sidebar" href="#" data-sidebar="">Ask
                  Questions</a>
          </div>
      </div>
    </div>
    <div class="inner-wrapper hotel-page-list mb-0910">
      <div class="pr-lst result-grid slider-big">
          `+ roomimages +`
      </div>
      <div class="my-dropdown">
          <div class="btn-group dropleft">
              <a href="#" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="ico ico-diamon diamon-label"></i>
              </a>
              <div class="dropdown-menu">
                  <a href="#" class="dropdown-item">Add to collection</a>
                  <a href="#" class="dropdown-item btn-sidebar create-collection"
                      data-sidebar="#myCollection">Create new collection</a>
              </div>
          </div>
      </div>
      <a href="#">
          <div class="covid-info align-items-center">
              <div class="ico-security">
                  <i class="ico icon-security"></i>
              </div>
              <div class="pl-3 w-100">
                  <p class="covid-title mb-0 text-18">Sichere Urlaubsplanung
                      <span><i>Trotz
                              Covid 19</i></span>
                  </p>
                  <p class="mb-0">
                      ` + r.corona_guidlines + `
                  </p>
              </div>
              <div class="covid-act">
                  <a href="` + r.corona_link + `">JETZT INFORMIEREN</a>
              </div>
          </div>
      </a>
      <div class="hotel-meta full-width hotel-meta-details">
          <a href="#" class="view btn-sidebar i-none" data-sidebar="#reviews">
              Reviews
          </a>
          <a href="#" class="view btn-sidebar i-none" data-sidebar="#availability">
              Availability
          </a>
          <a href="#" class="view btn-sidebar i-none" data-sidebar="#suiteinfo">
              Suite Info
          </a>
          <div class="hotel-title i-none">
              <p class="mb-0 inc">Includes</p>
              <p class="mb-0">2 Bedrooms</p>
          </div>
          <div class="hotel-prices hotel-price-detail d-flex">
              <div class="row align-items-center justify-content-center">
                  <div class="mr-2">
                      <i class="ico ico-info-green pointer btn-sidebar" type="button"
                          data-sidebar="#priceinfo"></i>
                  </div>
                  <h3 class="mb-0">
                      <span class="title-font-2 mr-1">From</span> <span
                          class="color-primary">
                          € 1.299</span>
                  </h3>
                  <div class="ml-2">
                      <span class="pernight"></span>
                  </div>
              </div>
          </div>
          <div class="ipad-view book-suite">
              <a href="#">
                  Book this Suite
              </a>
          </div>
          <div class="action-hotel i-none">
              <nav class="nav nav-pills nav-justified">
                  <a class="nav-link btn-sidebar" href="#"
                      data-sidebar="#suite-deal">Suite
                      Deals</a>
                  <a class="nav-link btn-sidebar" href="#"
                      data-sidebar="#myCollection">Add to
                      Collection</a>
                  <a class="nav-link" href="#">Ask Question</a>
                  <a class="nav-link" href="#">Share</a>
                  <a class="nav-link" href="#">Book this Suite</a>
              </nav>
          </div>
      </div>
    </div>
  </div>`;
  });

  $('[data-place="property-rooms"]').html(roomview);
}

function getDefaultChannel(catt){            
    $.ajax({
        url: channelurl,
        //dataType:'html',
        dataType:'json',
        data: {cat:catt},
        type: 'post',
        beforeSend: function(){
            
        },
        success: function(data){ 
            
            console.log(data.channel_url);   
//            $(".dv-youtube-channel").html('<div class="yt-rvideos"></div>');
            //$(".dv-youtube-channel").html('<div data-yt data-yt-channel="'+data.channel_url+'" data-yt-content-columns="4"  data-yt-content-rows="3"></div>')                    
                $('.yt-rvideos').yottie({  
                    key:'AIzaSyAry0SsGLQVtzh61SGb2-OtBpAWtZh7zGo',
                    channel: data.channel_url,
                    content: {
                        columns: 4,
                        rows: 2
                    },
                });
        }
    });
}    