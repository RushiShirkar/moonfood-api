@extends('fashiostreet_client::layout.frame')

@section('title','fashiostreet '.$data['city'].'offers page')
@section('category_shop')
<link rel="stylesheet" href="{{ asset('assets/css/color.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}" />
@endsection
@section('script')
	<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/swiper.min.js') }}"></script>
<script type="text/javascript">

    function responsiveSlider(){
        console.log('responsive run');
        var width = $(document).width();
        var sliderperview = 4;
        if(width <= 720)
        {
            sliderperview = 1;
        }
        else if(width > 720  && width <= 840)
        {
            sliderperview = 2;
        }
        else if(width > 840  && width <= 920)
        {
            sliderperview = 3;
        }
        else{
            sliderperview = 4;
        }
        var swiper = new Swiper('.swiper-container2', {
            mode:'horizontal',
            slidesPerView: sliderperview,
            spaceBetween: 30,
            nextButton: '.slide_right',
            prevButton: '.slide_left',
            slidesPerGroup: sliderperview,
        });

        var swiper = new Swiper('.swiper-container3', {
            mode:'horizontal',
            slidesPerView: sliderperview,
            spaceBetween: 30,
            nextButton: '.slide_right',
            prevButton: '.slide_left',
            slidesPerGroup: sliderperview,
        });
    }

    $(document).ready(function(){
        var mySwiper = new Swiper('.swiper-container1', {
            mode: 'horizontal',
            nextButton: '.slide_right',
            prevButton: '.slide_left',
            loop:true,
            autoplay:5000,
            speed:1000
        });
        $(".swiper-container1").hover(function(){
            mySwiper.stopAutoplay();
        }, function(){
            mySwiper.startAutoplay();
        })
        $(window).resize(function(){
            responsiveSlider();
        });
        responsiveSlider();

        $('.slide3').click(function(){
            mySwiper.slideTo($(this).attr('data-slide-index'));
        });


    });
</script>
@endsection

@section('body')
<div class="container responsive-marginTop" style="padding: 0px !important">
	<div class="container swiper-container swiper-container1 ads_height">
			<div class="swiper-wrapper">
				<div class="swiper-slide" data-swiper-autoplay="2000"><a href="/shop/islampur/available-category?shop=lifestyle"><img src="{{ asset('assets/img/banner1.jpg') }}" class="img-width" /></a></div>
				<div class="swiper-slide" data-swiper-autoplay="2000"><a href="/shop/islampur/available-category?shop=HARI OM COLLECTION	"><img src="{{ asset('assets/img/banner2.jpg') }}" class="img-width" /></a></div>
				<div class="swiper-slide" data-swiper-autoplay="2000"><a href="/shop/islampur/available-category?shop=Lavanya NX"><img src="{{ asset('assets/img/banner3.jpg') }}" class="img-width" /></a></div>
				<div class="swiper-slide" data-swiper-autoplay="2000"><a href="/shop/islampur/available-category?shop=Silverleaf Islampur"><img src="{{ asset('assets/img/banner4.jpg') }}" class="img-width" /></a></div>
				<div class="swiper-slide" data-swiper-autoplay="2000"><a href="/shop/islampur/available-category?shop=Dress code"><img src="{{ asset('assets/img/banner5.jpg') }}" class="img-width" /></a></div>
			</div>
			<div class="swiper-pagination"></div>
			<div class="slider slide_left z-depth-3 ">
			   <a href="javascript:void(0)"><span class="icon-prev"></span></a>
			</div>
			<div class="slider slide_right z-depth-3">
			   <a href="javascript:void(0)"><span class="icon-next"></span></a>
			</div>
	</div>
	<center>
		<div class="row paginations">
			<div class="col-xs-3">
				<a href="javascript:void(0)" class="slide3" data-slide-index="1">
					Lifestyle Offer
				</a>
			</div>
			<div class="col-xs-3">
				<a href="javascript:void(0)" class="slide3" data-slide-index="2">
					Virgon Offer
				</a>
			</div>
			<div class="col-xs-3">
				<a href="javascript:void(0)" class="slide3" data-slide-index="3">
					DC Offer
				</a>
			</div>
			<div class="col-xs-3">
				<a href="javascript:void(0)" class="slide3" data-slide-index="4">
					Silverleaf Offer
				</a>
			</div>
		</div>
	</center>

	<br/>
	<div style="margin: 0px 20px">
	<div class="swiper-container swiper-container2" style="background-color:white;padding:10px 0px;border-radius: 4px;">
			<div class="row">
				<div class="col-xs-9">
						<h4>Top Selling Product at {{ $data['city'] }}</h4>
				</div>
			</div>
			<div class="desktop_view">
					<div class="slider slide_left z-depth-3">
						<a href="javascript:void(0)"><span class="icon-prev"></span></a>
					</div>
					<div class="slider slide_right z-depth-3">
						<a href="javascript:void(0)"><span class="icon-next"></span></a>
					</div>
			</div>
			<div class="swiper-wrapper row">
				@for($i=0;$i < count($products);$i++)
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pzero swiper-slide">
						<a target="_blank" href="/product/{{ $data['city'] }}/{{ $products[$i]->name }}/{{ $products[$i]->id }}/buy?shop=All Shop" class="decoration_none">
							<div class="row img_l_container hover">
								<div class="col-xs-4 col-sm-12 col-md-12">
									<div class="small_inner_container min-height ">

										<img src="{{ $products[$i]->image[0] }}" alt="{{ $products[$i]->name }}" class="list-img vertical_center img-fluid">

									</div>
								</div>
								<div class="col-xs-8 col-sm-12 col-md-12">
									<div class="inner_container p_title text18 text-black lineclampin">
										{{ $products[$i]->name }}
									</div>
									@php
										$discount = ($products[$i]->selling_price * 100)/$products[$i]->mrp_price;
                                        $discount = (int)$discount;
                                        $discount = 100 - $discount;
									@endphp
									<div class="inner_container text18 font-bold text-black">
										<b>Rs. {{ $products[$i]->selling_price }}/-</b> &nbsp <small style="color:green"><del style="color:gray !important;">{{ $products[$i]->mrp_price }}</del> &nbsp {{ $discount }}% off</small>
									</div>
									<div class="inner_container font-bold text18 mr_3 lineclampin">
										Store : {{ $products[$i]->shop_name }}
									</div>

								</div>
							</div>
						</a>
					</div>
				@endfor
			</div>		
			<div class="mobile_view">
				<center><img src="{{ asset('assets/img/swipe_right.jpg') }}"> swipe rigth to view more</center>
			</div>	
	</div>
	<br/>
	<div class="row">
		<div class="col-sm-3 p-title col-gray">
			<h2>Mens</h2>
			<ul>
				<li><a href="/product/{{ $data['city'] }}/Formal shirts?shop=All Shop&gender=men&category=top wear">Formal Shirts</a></li>
				<li><a href="/product/{{ $data['city'] }}/Jeans?shop=All Shop&gender=men&category=bottom wear">Jeans</a></li>
				<li><a href="/product/{{ $data['city'] }}/Kurtas?shop=All Shop&gender=men&category=top wear">Kurtas</a></li>
				<li><a href="/product/{{ $data['city'] }}/Trousers?shop=All Shop&gender=men&category=bottom wear">Trousers</a></li>
				<li><a href="/product/{{ $data['city'] }}/Briefs and trunks?shop=All Shop&gender=men&category=innerwear and sleepwear">Brief & trunks</a></li>
				<li><a href="/product/{{ $data['city'] }}/Track pants?shop=All Shop&gender=men&category=sports wear">Track Pants</a></li>
				<li><a href="/product/{{ $data['city'] }}/Sweatshirts?shop=All Shop&gender=men&category=top wear">Sweatshirts</a></li>
				<li><a href="/product/{{ $data['city'] }}/Jackets?shop=All Shop&gender=men&category=top wear">Jackets</a></li>
				<li><a href="/product/{{ $data['city'] }}/Blazers?shop=All Shop&gender=men&category=top wear">Blazers</a></li>
				<li><a href="/product/{{ $data['city'] }}/Socks?shop=All Shop&gender=men&category=accessories">Socks</a></li>
				<li><a href="/product/{{ $data['city'] }}/Raincoats?shop=All Shop&gender=men&category=others">Raincoats</a></li>
			</ul>
		</div>
		<div class="col-sm-9 pzero">
			<div class="row p-category" style="margin-left:10px;">
				<div class="col-sm-6 pzero">
					<a href="/product/{{ $data['city'] }}/T-shirts?shop=All Shop&gender=men&category=top wear"><img alt="men t-shirts" src="{{ asset('assets/img/menbanner1.jpg') }}" height="600px" width="100%"></a>
				</div>
				<div class="col-sm-6 pzero">
					<div class="row">
						<div class="col-xs-12 pzero">
						  <a href="/product/{{ $data['city'] }}/Casual shirts?shop=All Shop&gender=men&category=top wear"><img alt="men shirts" src="{{ asset('assets/img/menbanner2.jpg') }}" height="300px" width="100%"></a>
						</div>
						<div class="col-xs-12 pzero">
						  <a href="/product/{{ $data['city'] }}/Shorts and 3 by 4ths?shop=All Shop&gender=men&category=bottom wear"><img alt="shorts" src="{{ asset('assets/img/menbanner3.jpg') }}" height="300px" width="100%"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br/><br/>
	<div class="row">
		<div class="col-sm-3 p-title col-pink" style="border-radius: 4px;">
			<h2>Womens</h2>
			<ul>
				<li><a href="/product/{{ $data['city'] }}/Dresses?shop=All Shop&gender=women&category=western wear">Dresses</a></li>
				<li><a href="/product/{{ $data['city'] }}/Single one piece?shop=All Shop&gender=women&category=western wear">Single One Piece</a></li>
				<li><a href="/product/{{ $data['city'] }}/Anarkali?shop=All Shop&gender=women&category=ethnic wear">Anarkali</a></li>
				<li><a href="/product/{{ $data['city'] }}/T-Shirts?shop=All Shop&gender=women&category=western wear">T-Shirts</a></li>
				<li><a href="/product/{{ $data['city'] }}/Dress Material?shop=All Shop&gender=women&category=ethnic wear">Dress Materials</a></li>
				<li><a href="/product/{{ $data['city'] }}/Leggings?shop=All Shop&gender=women&category=ethnic wear">Leggings</a></li>
				<li><a href="/product/{{ $data['city'] }}/Sarees?shop=All Shop&gender=women&category=ethnic wear">Sarees</a></li>
				<li><a href="/product/{{ $data['city'] }}/Lehenga Choli?shop=All Shop&gender=women&category=ethnic wear">Lehenga Choli</a></li>
				<li><a href="/product/{{ $data['city'] }}/Shorts and Skirts?shop=All Shop&gender=women&category=western wear">Shorts & Skirts</a></li>
				<li><a href="/product/{{ $data['city'] }}/Bras?shop=All Shop&gender=women&category=Lingerie and sleep wear">Bras</a></li>
				<li><a href="/product/{{ $data['city'] }}/Chudidars?shop=All Shop&gender=women&category=ethnic wear">Chudidars</a></li>
			</ul>
		</div>
		<div class="col-sm-9 pzero">
			<div class="row p-category" style="margin-left:10px;">
				<div class="col-sm-6 pzero">
					<a href="/product/{{ $data['city'] }}/Kurtis?shop=All Shop&gender=women&category=ethnic wear"><img alt="women kurtas" src="{{ asset('assets/img/wombanner1.jpg') }}" height="600px" width="100%"></a>
				</div>
				<div class="col-sm-6 pzero">
					<div class="row">
						<div class="col-xs-12 pzero">
						  <a href="/product/{{ $data['city'] }}/Jeans?shop=All Shop&gender=women&category=western wear"><img alt="women jeans" src="{{ asset('assets/img/wombanner2.jpg') }}" height="300px" width="100%"></a>
						</div>
						<div class="col-xs-12 pzero">
						  <a href="/product/{{ $data['city'] }}/Tops?shop=All Shop&gender=women&category=western wear"><img alt="women tops" src="{{ asset('assets/img/wombanner3.jpg') }}" height="300px" width="100%"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<br/><br/>
	<div class="swiper-container swiper-container2" style="background-color:white;padding:10px 0px;border-radius: 4px;">
			<div class="row">
				<div class="col-xs-9">
						<h4>Shops at {{ $data['city'] }}</h4>
				</div>
				<div class="col-xs-3">
						<a href="/shop/{{ $data['city'] }}?shop=All%20Shop" class="btn btn-primary" style="float:right;">view all</a>
				</div>
			</div>
			<div class="desktop_view">
					<div class="slider slide_left z-depth-3">
						<a href="javascript:void(0)"><span class="icon-prev"></span></a>
					</div>
					<div class="slider slide_right z-depth-3">
						<a href="javascript:void(0)"><span class="icon-next"></span></a>
					</div>
			</div>
			<div class="swiper-wrapper row">
				@for($i=0;$i < count($shops);$i++)
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pzero swiper-slide white">
						<a href="/shop/{{ $data['city'] }}/available-category?shop={{ $shops[$i]->name }}" class="decoration_none">
							<div class="row img_l_container hover ">
								<div class="col-xs-4 col-sm-12 col-md-12" >
									<div class="small_inner_container min-height">

										<img src="{{ $shops[$i]->image }}" alt="{{ $shops[$i]->name }}" class="list-img vertical_center img-fluid"/>

									</div>
								</div>
								<div class="col-xs-8 col-sm-12 col-md-12">
									<div class="inner_container p_title text18 text-black">
										<span class="lineclampin" style="width:80% !important;font-weight: bold">{{ $shops[$i]->name }}</span> <button type="button" class="btn btn-info btn-xs" style="position:absolute;margin-top:-22px;right:5px;">4.3 &nbsp;<span class="glyphicon glyphicon-star"></span></button>
									</div>
									<div class="inner_container text18 font-bold text-black lineclampin">
										Addr : {{ $shops[$i]->address }}
									</div>
									<div class="inner_container font-bold text18 lineclampin" style="text-align: center;">
										Shop Now >>
									</div>

								</div>
							</div>
						</a>
					</div>
				@endfor

				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pzero swiper-slide">
					<a target="_blank" href="/product/Islampur/t shirt/261/buy?shop=HARI OM COLLECTION" class="decoration_none">
						<div style="margin-top:50px;">
							<center><h4>Want to View More Shops at {{ $data['city'] }}</h4>
								<br/><p><a href="/shop/{{ $data['city'] }}?shop=All%20Shop" class="btn btn-primary">Click Here</a></p></center>
						</div>
					</a>
				</div>

			</div>			

			<div class="mobile_view">
					<center><img src="{{ asset('assets/img/swipe_right.jpg') }}"> swipe rigth to view more</center>
				</div>
	</div>

	<br/>

</div>
</div>
<!-- **************************************______Footer______*********************************-->

<br>
<footer>
<div class="container" style="padding-top: 20px">
	<div class="row">
		  <div class="col-md-7" style="padding-top:20px">
			  <div class="form-group" style="display: inline-block;">
					<center>
						<div class="footerLink_section">
							<a class="footerlinks">About Us</a>
						</div>
						<div class="footerLink_section">
							<a class="footerlinks">Sell On Fashiostreet</a>
						</div>
						<div class="footerLink_section">
							<a class="footerlinks">Contact Us</a>
							
						</div>
						<div class="footerLink_section">
							<a class="footerlinks">Listing Policy</a>
						</div>
					</center>
			  </div> 
			  <br><br>              
			  <div class="form-group" style="display: inline-block;">
				<center>
				  <div class="footerLink_section">
						  <a class="footerlinks">Help</a>
				  </div>
				  <div class="footerLink_section">
						  <a class="footerlinks">Privacy Policy</a>
				  </div>
				  <div class="footerLink_section">
						  <a class="footerlinks">Trust & Safety</a>
				  </div>
				  <div class="footerLink_section">
						 <a class="footerlinks">Terms of use</a>
				  </div>
				</center>
			  </div>
		  </div>
		  <div class="col-md-5" style="text-align: center">
			  <h4>Follow Us On</h4>
				<a href="https://www.facebook.com/fashiostreet/" class="facebook" target="_blank">
					  <i class="fa fa-facebook-square" aria-hidden="true"></i>
				</a>&nbsp;
				<a href="https://twitter.com/Fashiostreet10/" class="twitter" target="_blank">
					  <i class="fa fa-twitter" aria-hidden="true"></i>
				</a>&nbsp;
				<a href="https://www.instagram.com/fashiostreet10/" class="Insta" target="_blank">
					  <i class="fa fa-instagram" aria-hidden="true"></i>
				</a>&nbsp;
				<a href="https://www.linkedin.com/company/fashiostreet/" class="linkedIn" target="_blank">
					  <i class="fa fa-linkedin-square" aria-hidden="true"></i>
				</a>&nbsp;
				<a href="https://plus.google.com/u/0/105052627957777439787" class="google" target="_blank">
					  <i class="fa fa-google" aria-hidden="true"></i>
				 </a>
				 <a href="https://msg91.com/startups/?utm_source=startup-banner" target="_blank"  style="margin-top:-10px"><img src="https://msg91.com/images/startups/msg91Badge.png" id="msg91" width="70" height="50" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91"></a>
		  </div>
	</div>
	<br>
	<div class="row">
		  <div class="col-md-12">
			  <p class="text-center font_class" ><i class="fa fa-copyright" aria-hidden="true"></i>&nbsp;Copyright 2017  @  FashioStreet.&nbsp;&nbsp;All rights reserved.</p>
		  </div>
	</div>
</div>
</footer>

<!-- **************************************______Footer______*********************************-->
@endsection