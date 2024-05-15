<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="{{ asset('asset/css/tiny-slider.css') }}" rel="stylesheet">
	<link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
	<title>Shop</title>
	<style>
		.dropdown-menu {
			background-color: #39594A;
			/* Warna latar belakang dropdown menu */
		}

		.dropdown-menu a.dropdown-item {
			color: #f4f4f4;
			/* Warna teks */
		}

		.dropdown-menu a.dropdown-item:hover {
			background-color: #f4f4f4;
			/* Warna latar belakang saat dihover */
		}
		/* Custom CSS untuk tampilan formulir filter yang lebih menarik */
form {
    display: flex;
    align-items: center;
    justify-content: center;
}

select {
    padding: 8px 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 8px;
}

button {
    padding: 8px 16px;
    font-size: 16px;
    background-color: #6B8E23;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #39594A;
}

	</style>
</head>

<body>

	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="index.html">Pausoan<span>Material</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li>
						<a class="nav-link" href="/home">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="/shop">Shop</a>
					</li>
					<li><a class="nav-link" href="about.html">About us</a></li>
					<li><a class="nav-link" href="services.html">Services</a></li>
					<li><a class="nav-link" href="blog.html">Blog</a></li>
					<li><a class="nav-link" href="contact.html">Contact us</a></li>

					@guest
					@if (Route::has('login'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@endif

					@if (Route::has('register'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
					@endif
					@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }}
						</a>

						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
							<li>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</li>
						</ul>
					</li>
					<li><a class="nav-link" href="cart.html"><img src="{{ asset('asset/images/cart.svg') }}" alt="Cart"></a></li>
					@endguest
				</ul>

			</div>
		</div>

	</nav>

	<!-- End Header/Navigation -->

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Shop</h1>
					</div>
				</div>
				<div class="col-lg-7">


				</div>
				<form action="{{ route('shop') }}" method="GET">
					<select name="category_id">
						<option value="">Semua Kategori</option>
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->category_name }}</option>
						@endforeach
					</select>
					<button type="submit">Filter</button>
				</form>

			</div>
		</div>
	</div>

	{{-- <p>Total Produk: {{ $products->total() }}</p> --}}

	<!-- End Hero Section -->

	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="row">
				@foreach($products as $index => $item)
				<div class="col-12 col-md-4 col-lg-3 mb-5">
					<div class="product-item">
						<img src="{{ asset('images/' . $item->image) }}" class="img-fluid product-thumbnail">
						<h3 class="product-title">{{ $item->product_name }}</h3>
						<strong class="product-price">{{ $item->price }}</strong>
						<a href="url_ke_halaman_tujuan" class="icon-cross">
							<img src="{{asset('asset/images/cross.svg') }}" class="img-fluid">
						</a>

						<a href="{{ route('product.show', $item->id) }}" class="icon-crosss">
							<i class="fa-solid fa-magnifying-glass"></i>
						</a>
						<div id="productModal" class="modal fade" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Detail Produk</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="productModalBody">
										<!-- Detail produk akan dimuat di sini -->
									</div>
								</div>
							</div>
						</div>


						<!-- Tambahkan tombol View dengan link ke halaman detail produk -->
					</div>
				</div>
				@endforeach





			</div>
		</div>
	</div>






	<!-- Start Footer Section -->
	<footer class="footer-section">
		<div class="container relative">

			<!-- <div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div> -->

			

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
					<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

					<ul class="list-unstyled custom-social">
						<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
					</ul>
				</div>

				<div class="col-lg-8">
					<div class="row links-wrap">
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">About us</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Contact us</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Support</a></li>
								<li><a href="#">Knowledge base</a></li>
								<li><a href="#">Live chat</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Jobs</a></li>
								<li><a href="#">Our team</a></li>
								<li><a href="#">Leadership</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Nordic Chair</a></li>
								<li><a href="#">Kruzo Aero</a></li>
								<li><a href="#">Ergonomic Chair</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
						</p>
					</div>

					<div class="col-lg-6 text-center text-lg-end">
						<ul class="list-unstyled d-inline-flex ms-auto">
							<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</footer>
	<!-- End Footer Section -->

	<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('asset/js/tiny-slider.js') }}"></script>
	<script src="{{ asset('asset/js/custom.js') }}"></script>


</body>

</html>