<div [template-suite-class]>
    <div class="header-suite-list justify-content-between align-items-center mb-2">
        <div class="title-outer-container">
            <div class="title-main offset-930 pr-3 title-subs">
                <h2><!--SUITE-TITLE--></h2>
            </div>
            <div class="meta-title">
                <span>Sleeps</span>
                <span class="no-beds"><!--SUITE-NO-BEDS--> beds</span>
                <span class="suite-size">Suite size: <!--SUITE-SIZE--> ft</span>
            </div>
        </div>
        {{--<div class="dropdown ipad-view">
            <button class="btn dropdown-toggle p-0" type="button" id="suiteDetail"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Suite Details
            </button>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="suiteDetail">
                <a class="dropdown-item btn-sidebar" href="#"
                    data-sidebar="#suiteinfo">Suite Info</a>
<!--                <a class="dropdown-item btn-sidebar" href="#"
                    data-sidebar="#reviews">Reviews</a>
                <a class="dropdown-item btn-sidebar" href="#"
                    data-sidebar="#availability">Availability</a>
-->
                <a class="dropdown-item btn-sidebar" href="#"
                    data-sidebar="#myCollection">Add to Collection</a>
                <a class="dropdown-item btn-sidebar" href="#"
                    data-sidebar="#share">Share</a>
                <a class="dropdown-item btn-sidebar" href="#" data-sidebar="">Ask
                    Questions</a>
            </div> 
        </div>--}}
    </div>
    <div class="inner-wrapper hotel-page-list mb-0910">
        <div class="pr-lst result-grid slider-big">
            <!--TEMPLATE-SUITE-GALLERY-->
        </div>
        <a href="<!--COVID-LINK-->" target="_blank">
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
                        <!--COVID-INFO-->
                    </p>
                </div>
                <div class="covid-act">
                    JETZT INFORMIEREN
                </div>
            </div>
        </a>
        <div class="hotel-meta full-width hotel-meta-details">
            <a href="#" class="view btn-sidebar i-none" data-sidebar="#reviews" onclick="replaceReviewData()">
                Reviews
            </a>
            <a href="#" class="view btn-sidebar i-none suite_info" data-sidebar="#suiteinfo" onclick="replaceSuiteBoard();">
                Suite Info
            </a>
            <a href="/reservation/when/<!--PROPERTY-ID-->" class="view i-none">
                Book this Suite
            </a>
            <!--<div class="hotel-title i-none">
                <p class="mb-0 inc">Includes</p>
                <p class="mb-0">2 Bedrooms</p>
            </div>
            -->
            <a href="#" class="btn-sidebar" data-sidebar="#priceinfo" style="align-self: center;">
                <div class="hotel-prices hotel-price-detail d-flex">
                    <div class="row align-items-center justify-content-center" >
                        <div class="mr-2">
                            <i class="ico ico-info-green pointer btn-sidebar" type="button"
                                data-sidebar="#priceinfo" onclick="replacePrices(<!--SUITEID-->)"></i>
                        </div>
                        <h3 class="mb-0">
                            <span class="title-font-2 mr-1">From</span> <span
                                class="color-primary">
                                € <!--SUITE-PRICE--></span>
                        </h3>
                        <div class="ml-2">
                            <span class="pernight"></span>
                        </div>
                    </div>
                </div>
            </a>
            <div class="ipad-view book-suite">
                <a href="/reservation/when/<!--IPAD-PROPERTY-ID-->">
                    Book this Suite
                </a>
            </div>
            {{-- <div class="action-hotel i-none">
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
            </div> --}}
        </div>
    </div>
    <div class="hotel-meta-mobile">
        <a href="#" class="btn btn-sidebar rounded-0 suite_info" data-sidebar="#suiteinfo" onclick="replaceSuiteBoard();">
            Suite Info
        </a>
        <a href="/reservation/when/<!--M-PROPERTY-ID-->" class="btn btn-primary rounded-0">
          Book this Suite
        </a>
    </div>
</div>

