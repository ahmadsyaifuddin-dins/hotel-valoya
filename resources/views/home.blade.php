@extends('layouts.main')

@section('container')

{{-- flash message berhasil login. Bikin yang ada waktu trus dipojok. Kalau pakai ini jika halaman redirect nya ttp di
home maka tiap akses home bakal muncul trs flash message nya --}}
{{-- @if (auth()->user()->nama)
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
	Login berhasil
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

<div class="hero">
	<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image:url(images/bg_1.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-end">
					<div class="col-md-6 ftco-animate">
						<div class="text">
							<h2>More than a hotel... an experience</h2>
							<h1 class="mb-3">Hotel for the whole family, all year round.</h1>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="slider-item" style="background-image:url(images/bg_2.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-end">
					<div class="col-md-6 ftco-animate">
						<div class="text">
							<h2>Hotel VALOYA</h2>
							<h1 class="mb-3">It feels like staying in your own home.</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

{{-- <section class="ftco-booking ftco-section ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-12">
				<form action="#" class="booking-form aside-stretch">
					<div class="row">
						<div class="col-md d-flex py-md-4">
							<div class="form-group align-self-stretch d-flex align-items-end">
								<div class="wrap align-self-stretch py-3 px-4">
									<label for="#">Check-in Date</label>
									<input type="text" class="form-control checkin_date" placeholder="Check-in date">
								</div>
							</div>
						</div>
						<div class="col-md d-flex py-md-4">
							<div class="form-group align-self-stretch d-flex align-items-end">
								<div class="wrap align-self-stretch py-3 px-4">
									<label for="#">Check-out Date</label>
									<input type="text" class="form-control checkout_date" placeholder="Check-out date">
								</div>
							</div>
						</div>
						<div class="col-md d-flex py-md-4">
							<div class="form-group align-self-stretch d-flex align-items-end">
								<div class="wrap align-self-stretch py-3 px-4">
									<label for="#">Room</label>
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="" id="" class="form-control">
												<option value="">Suite</option>
												<option value="">Family Room</option>
												<option value="">Deluxe Room</option>
												<option value="">Classic Room</option>
												<option value="">Superior Room</option>
												<option value="">Luxury Room</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md d-flex py-md-4">
							<div class="form-group align-self-stretch d-flex align-items-end">
								<div class="wrap align-self-stretch py-3 px-4">
									<label for="#">Guests</label>
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="" id="" class="form-control">
												<option value="">1 Adult</option>
												<option value="">2 Adult</option>
												<option value="">3 Adult</option>
												<option value="">4 Adult</option>
												<option value="">5 Adult</option>
												<option value="">6 Adult</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md d-flex">
							<div class="form-group d-flex align-self-stretch">
								<a href="#"
									class="btn btn-primary py-5 py-md-3 px-4 align-self-stretch d-block"><span>Check
										Availability <small>Best Price Guaranteed!</small></span></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section> --}}


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Welcome to VALOYA Hotel</span>
				<h2 class="mb-4">You'll Never Want To Leave</h2>
			</div>
		</div>
		<div class="row d-flex">
			<div class="col-md pr-md-1 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-reception-bell"></span>
						</div>
					</div>
					<div class="media-body">
						<h3 class="heading mb-3">Friendly Service</h3>
					</div>
				</div>
			</div>
			<div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services active py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-serving-dish"></span>
						</div>
					</div>
					<div class="media-body">
						<h3 class="heading mb-3">Get Breakfast</h3>
					</div>
				</div>
			</div>
			<div class="col-md px-md-1 d-flex align-sel Searchf-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-car"></span>
						</div>
					</div>
					<div class="media-body">
						<h3 class="heading mb-3">Transfer Services</h3>
					</div>
				</div>
			</div>
			<div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-spa"></span>
						</div>
					</div>
					<div class="media-body">
						<h3 class="heading mb-3">Suits &amp; SPA</h3>
					</div>
				</div>
			</div>
			<div class="col-md pl-md-1 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="ion-ios-bed"></span>
						</div>
					</div>
					<div class="media-body">
						<h3 class="heading mb-3">Cozy Rooms</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-wrap-about ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-7 order-md-last d-flex">
				<div class="img img-1 mr-md-2 ftco-animate" style="background-image: url(images/about-1.jpg);"></div>
				<div class="img img-2 ml-md-2 ftco-animate" style="background-image: url(images/about-2.jpg);"></div>
			</div>
			<div class="col-md-5 wrap-about pb-md-3 ftco-animate pr-md-5 pb-md-5 pt-md-4">
				<div class="heading-section mb-4 my-5 my-md-0">
					<span class="subheading">About VALOYA Hotel</span>
					<h2 class="mb-4">VALOYA Hotel the Most Recommended Hotel All Over the World</h2>
				</div>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
					the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
					language ocean.</p>
				<p><a href="/tipeKamar" class="btn btn-secondary rounded">Reserve Your Room Now</a></p>
			</div>
		</div>
	</div>
</section>

<section class="testimony-section">
	<div class="container">
		<div class="row no-gutters ftco-animate justify-content-center">
			<div class="col-md-5 d-flex">
				<div class="testimony-img aside-stretch-2" style="background-image: url(images/testimony-img.jpg);">
				</div>
			</div>
			<div class="col-md-7 py-5 pl-md-5">
				<div class="py-md-5">
					<div class="heading-section ftco-animate mb-4">
						<span class="subheading">Testimony</span>
						<h2 class="mb-0">Happy Customer</h2>
					</div>
					<div class="carousel-testimony owl-carousel ftco-animate">
						<div class="item">
							<div class="testimony-wrap pb-4">
								<div class="text">
									<p class="mb-4">A small river named Duden flows by their place and supplies it with
										the necessary regelialia. It is a paradisematic country, in which roasted parts
										of sentences fly into your mouth.</p>
								</div>
								<div class="d-flex">
									<div class="user-img" style="background-image: url(images/person_1.jpg)">
									</div>
									<div class="pos ml-3">
										<p class="name">Gerald Hodson</p>
										<span class="position">Businessman</span>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap pb-4">
								<div class="text">
									<p class="mb-4">A small river named Duden flows by their place and supplies it with
										the necessary regelialia. It is a paradisematic country, in which roasted parts
										of sentences fly into your mouth.</p>
								</div>
								<div class="d-flex">
									<div class="user-img" style="background-image: url(images/person_2.jpg)">
									</div>
									<div class="pos ml-3">
										<p class="name">Gerald Hodson</p>
										<span class="position">Businessman</span>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap pb-4">
								<div class="text">
									<p class="mb-4">A small river named Duden flows by their place and supplies it with
										the necessary regelialia. It is a paradisematic country, in which roasted parts
										of sentences fly into your mouth.</p>
								</div>
								<div class="d-flex">
									<div class="user-img" style="background-image: url(images/person_3.jpg)">
									</div>
									<div class="pos ml-3">
										<p class="name">Gerald Hodson</p>
										<span class="position">Businessman</span>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap pb-4">
								<div class="text">
									<p class="mb-4">A small river named Duden flows by their place and supplies it with
										the necessary regelialia. It is a paradisematic country, in which roasted parts
										of sentences fly into your mouth.</p>
								</div>
								<div class="d-flex">
									<div class="user-img" style="background-image: url(images/person_4.jpg)">
									</div>
									<div class="pos ml-3">
										<p class="name">Gerald Hodson</p>
										<span class="position">Businessman</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pb ftco-room">
	<div class="container-fluid px-0">
		<div class="row no-gutters justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">VALOYA Hotel Rooms</span>
				<h2 class="mb-4">Hotel Master's Rooms</h2>
			</div>
		</div>
		<div class="row no-gutters">
			@foreach ($tipe_kamars as $tipe_kamar)
			<div class="col-lg-6">
				<div class="room-wrap d-md-flex ftco-animate">
					@if ($tipe_kamar->img)
					<a href="#" class="img"
						style="background-image: url({{ asset('storage/' . $tipe_kamar->img) }});"></a>
					@else
					<a href="#" class="img" style="background-image: url(images/room-6.jpg);"></a>
					@endif
					<div class="half left-arrow d-flex align-items-center">
						<div class="text p-4 text-center">
							<p class="star mb-0"><span class="ion-ios-star"></span><span
									class="ion-ios-star"></span><span class="ion-ios-star"></span><span
									class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
							<p class="mb-0"><span class="price mr-1">@rupiah($tipe_kamar->harga)</span> <span
									class="per">per night</span>
							</p>
							<h3 class="mb-3"><a href="/tipeKamar/{{ $tipe_kamar->id }}">{{ $tipe_kamar->nama }}</a>
							</h3>
							<p class="pt-1"><a href="/tipeKamar/{{ $tipe_kamar->id }}"
									class="btn-custom px-3 py-2 rounded">View Details
									<span class="icon-long-arrow-right"></span></a></p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>






{{-- <section class="ftco-section ftco-menu bg-light">
	<div class="container-fluid px-md-4">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Restaurant</span>
				<h2>Restaurant</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-1.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-2.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-3.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-4.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-5.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex">
				<div class="pricing-entry rounded d-flex ftco-animate">
					<div class="img" style="background-image: url(images/menu-6.jpg);"></div>
					<div class="desc p-4">
						<div class="d-md-flex text align-items-start">
							<h3><span>Grilled Crab with Onion</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 text-center ftco-animate">
				<p><a href="#" class="btn btn-primary rounded">View All Menu</a></p>
			</div>
		</div>
	</div>
</section> --}}


{{-- <section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Read Blog</span>
				<h2>Recent Blog</h2>
			</div>
		</div>
		<div class="row d-flex">
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded"
						style="background-image: url('images/image_1.jpg');">
					</a>
					<div class="text mt-3 text-center">
						<div class="meta mb-2">
							<div><a href="#">Oct. 30, 2019</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
						</div>
						<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind
								texts</a></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded"
						style="background-image: url('images/image_2.jpg');">
					</a>
					<div class="text mt-3 text-center">
						<div class="meta mb-2">
							<div><a href="#">Oct. 30, 2019</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
						</div>
						<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind
								texts</a></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded"
						style="background-image: url('images/image_3.jpg');">
					</a>
					<div class="text mt-3 text-center">
						<div class="meta mb-2">
							<div><a href="#">Oct. 30, 2019</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
						</div>
						<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind
								texts</a></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> --}}

<section class="instagram">
	<div class="container-fluid">
		<div class="row no-gutters justify-content-center pb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<span class="subheading">Photos</span>
				<h2><span>Instagram</span></h2>
			</div>
		</div>
		<div class="row no-gutters">
			<div class="col-sm-12 col-md ftco-animate">
				<a href="images/insta-1.jpg" class="insta-img image-popup"
					style="background-image: url(images/insta-1.jpg);">
					<div class="icon d-flex justify-content-center">
						<span class="icon-instagram align-self-center"></span>
					</div>
				</a>
			</div>
			<div class="col-sm-12 col-md ftco-animate">
				<a href="images/insta-2.jpg" class="insta-img image-popup"
					style="background-image: url(images/insta-2.jpg);">
					<div class="icon d-flex justify-content-center">
						<span class="icon-instagram align-self-center"></span>
					</div>
				</a>
			</div>
			<div class="col-sm-12 col-md ftco-animate">
				<a href="images/insta-3.jpg" class="insta-img image-popup"
					style="background-image: url(images/insta-3.jpg);">
					<div class="icon d-flex justify-content-center">
						<span class="icon-instagram align-self-center"></span>
					</div>
				</a>
			</div>
			<div class="col-sm-12 col-md ftco-animate">
				<a href="images/insta-4.jpg" class="insta-img image-popup"
					style="background-image: url(images/insta-4.jpg);">
					<div class="icon d-flex justify-content-center">
						<span class="icon-instagram align-self-center"></span>
					</div>
				</a>
			</div>
			<div class="col-sm-12 col-md ftco-animate">
				<a href="images/insta-5.jpg" class="insta-img image-popup"
					style="background-image: url(images/insta-5.jpg);">
					<div class="icon d-flex justify-content-center">
						<span class="icon-instagram align-self-center"></span>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
			stroke="#F96D00" />
	</svg></div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>


@endsection