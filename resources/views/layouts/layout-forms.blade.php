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
	<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

	@trixassets
</head>
<body class="homepage is-preload">
	<div id="page-wrapper">
		<section id="header" >
			<div class="container-auth">
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
							<ul>
								
								<li><a href="/articles/create">New Article</a></li>
							</ul>

						</li>
						
						<li><a href="/categories/random" class="icon solid fa-paw"><span>Random</span></a>
						<li><a href="/categories/training" class="icon solid fa-dog"><span>Training</span></a>
						</li>
						<li><a href="/categories/nutrition" class="icon solid fa-bone"><span>Nutrition</span></a>
						</li>
						<li><a href="/categories/grooming" class="icon solid fa-cut"><span>Grooming</span></a>
						</li>
						
						<li>

							<a href="#" class="icon solid fa-user-alt"><span>{{ Auth::user()->name }}</span></a>
							<ul>
								<li><a href="/profile/{{auth()->id()}}">My Profile</a></li>
								<li><a href="/profile/{{auth()->id()}}/articles">My Articles</a></li>
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
						                 document.getElementById('logout-form').submit();"> 
						             {{ __('Logout') }}</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								    @csrf
								</form>
								</li>
							</ul>
						</li>
					@endguest
				</ul>
			</nav>
			
			<div style="background-color: #eb9e98; font-weight: bold;" >
			  	@if($errors->any())
	                @foreach($errors->all() as $error)
	                {{$error}}
	                @endforeach
	            @endif	
			</div>			
		</section>
		@yield('body')
		</div>
		<!-- Footer -->
		<section id="footer">
			<div class="container">
				@yield('footer')
				@yield('form')
			</div>
		</section>
	</div>
	<!-- Scripts -->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery.dropotron.min.js"></script>
	<script src="/assets/js/browser.min.js"></script>
	<script src="/assets/js/breakpoints.min.js"></script>
	<script src="/assets/js/util.js"></script>
	<script src="/assets/js/main.js"></script>
	</body>
	

</html>	