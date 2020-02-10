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
		<section id="header">
			<div class="container">
				@yield('title')
				<nav id="nav" >
					<ul>  
						@guest
						<li><a href="{{ route('login') }}"><span>{{ __('Login') }}</span></a></li>
						@if (Route::has('register'))
						<li><a  href="{{ route('register') }}"><span>{{ __('Register') }}</span></a>
						</li>
						@endif
						@else
						<li><a href="/home" class="icon solid fa-home"><span>Home</span></a>
						</li>
						<li>
							<a href="#" class="fas fa-paw"><span>Articles</span></a>
							<ul>
								<li><a href="#">All Articles</a></li>
								
								<li><a href="#">New Article</a></li>
								<li>
									<a href="#">Phasellus consequat</a>
									<ul>
										<li><a href="#">Magna phasellus</a></li>
										<li><a href="#">Etiam dolore nisl</a></li>
										<li><a href="#">Phasellus consequat</a></li>
									</ul>
								</li>
								<li><a href="#">Veroeros feugiat</a></li>
							</ul>
						</li>
						<li><a href="/home" class="icon solid fa-home"><span>Training</span></a>
						</li>
						<li><a href="/home" class="icon solid fa-home"><span>Nutrition</span></a>
						</li>
						<li><a href="/home" class="icon solid fa-home"><span>Grooming</span></a>
						</li>
						<li>
							<a href="#" class="fas fa-paw"><span>{{ Auth::user()->name }}</span></a>
							<ul>
								<li><a href="#">My Profile</a></li>
								
								<li><a href="#">Articles</a></li>
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
						                 document.getElementById('logout-form').submit();"> 
						             {{ __('Logout') }}</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								    @csrf
								</form>
								</li>
								<li>
									<a href="#">Phasellus consequat</a>
									<ul>
										<li><a href="#">Magna phasellus</a></li>
										<li><a href="#">Etiam dolore nisl</a></li>
										<li><a href="#">Phasellus consequat</a></li>
									</ul>
								</li>
								<li><a href="#">Veroeros feugiat</a></li>
							</ul>
						</li>
						
					
						
						
					@endguest
				</ul>
			</nav>
			</div>

		</section>

		@yield('body')
		
	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
</body>
<section id="footer">
    <div class="container" style="text-align: center;">
       © 2020 DogHaven. All rights reserved.
    </div>
</section>
</html>	