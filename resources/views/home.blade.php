@extends('layouts.layout')
@section('title')
<h1 id="logo"><a href="index.html">DogHaven</a></h1>
<p>Dogs are the best</p>
@endsection
@section('body')

<section id="features">
<div class="container">
    <form >
    @csrf
    <div class="row gtr-25 ">
        <div class="col-2">
            <input class="form-control " type="text" placeholder="Search" aria-label="Search">
        </div>
    </div>
    </form>

    <header>
        <h2>Latest articles </h2>
    </header>
   
         

 
    <div class="row aln-center">
        <div class="col-4 col-6-medium col-12-small">

            <!-- Feature -->
                <section>
                    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                    <header>
                        <h3>Okay, so what is this?</h3>
                    </header>
                    <p>This is <strong>Strongly Typed</strong>, a free, fully responsive site template
                    by <a href="http://html5up.net">HTML5 UP</a>. Free for personal and commercial use under the
                    <a href="http://html5up.net/license">CCA 3.0 license</a>.</p>
                </section>

        </div>
     
        <div class="col-4 col-6-medium col-12-small">

            <!-- Feature -->
                <section>
                    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                    <header>
                        <h3>Okay, so what is this?</h3>
                    </header>
                    <p>This is <strong>Strongly Typed</strong>, a free, fully responsive site template
                    by <a href="http://html5up.net">HTML5 UP</a>. Free for personal and commercial use under the
                    <a href="http://html5up.net/license">CCA 3.0 license</a>.</p>
                </section>

        </div>
 
        <div class="col-4 col-6-medium col-12-small">

            <!-- Feature -->
                <section>
                    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                    <header>
                        <h3>Okay, so what is this?</h3>
                    </header>
                    <p>This is <strong>Strongly Typed</strong>, a free, fully responsive site template
                    by <a href="http://html5up.net">HTML5 UP</a>. Free for personal and commercial use under the
                    <a href="http://html5up.net/license">CCA 3.0 license</a>.</p>
                </section>

        </div>
    
        <div class="col-4 col-6-medium col-12-small">

            <!-- Feature -->
                <section>
                    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                    <header>
                        <h3>Okay, so what is this?</h3>
                    </header>
                    <p>This is <strong>Strongly Typed</strong>, a free, fully responsive site template
                    by <a href="http://html5up.net">HTML5 UP</a>. Free for personal and commercial use under the
                    <a href="http://html5up.net/license">CCA 3.0 license</a>.</p>
                </section>

        </div>
      </div> 
</section>
@endsection
