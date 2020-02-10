<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>Strongly Typed by HTML5 UP</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="/assets/css/main.css" />
</head>
<body class="homepage is-preload">
	<div id="page-wrapper">
			<section id="header" >
				<div class="container-auth">
					<nav id="nav" >
						<ul>  
						@guest
						<li>
							<a href="{{ route('login') }}"><span>{{ __('Login') }}</span></a>
						</li>
							@if (Route::has('register'))
							<li>
							    <a  href="{{ route('register') }}"><span>{{ __('Register') }}</span></a>
							</li>
							@endif
						@else
						<li >
						<a href="#"><span>{{ Auth::user()->name }} </span>
						</a>
						<a href="{{ route('logout') }}"
						   onclick="event.preventDefault();
						                 document.getElementById('logout-form').submit();">
						    {{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						    @csrf
						</form>
						</div>
						</li>
						@endguest
					</ul>
				</nav>
				</div>
			</section>
			<!-- Footer -->
			<section id="footer">
				<div class="container">
					@yield('content')
				</div>
			</section>
		</div>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	</body>
</html>	