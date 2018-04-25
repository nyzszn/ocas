<?php 
  include('./inc/header.php');
?>
<!-- Slider -->
<!-- Calousel / Slider / Hero Images -->
<div data-aos="fade-in" style="position:relative; top:0px;" id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<div class="carousel-inner">
			<div class="item active ">
				<div class='slideItem1'></div>
				<div class="carousel-caption cpt">
					<br style="clear:both;">
					<br style="clear:both;">
					<h3 class="caption-heading">
          Title
					</h3>
					<p>some description that you want to appear.</p>
          <br style="clear:both;">
          <br style="clear:both;">
          <br style="clear:both;">
					<br style="clear:both;">
          <div class="cc-controls">
						<a class="btn-lg-custom" href="./about.php">About us</a>
						&nbsp; &nbsp; &nbsp;
						<a class="eventsLink" href="./about.php">Our Mission</a>
					</div>
				</div>
			</div>

			<div class="item">
				<div class='slideItem2'></div>
				<div class="carousel-caption cpt">
				<h3 class="caption-heading">
          Title
					</h3>
					<p>some description that you want to appear.</p>
          <br style="clear:both;">
          <br style="clear:both;">
          <br style="clear:both;">
					<br style="clear:both;">
          <div class="cc-controls">
						<a class="btn-lg-custom" href="./about.php">Get to know more about us</a>
						&nbsp; &nbsp; &nbsp;
						<a class="eventsLink" href="./contact.php">Adopt a child today</a>
					</div>
				</div>
			</div>

			<div class="item">
				<div class='slideItem3'></div>
				<div class="carousel-caption cpt">
				<h3 class="caption-heading">
          Title
					</h3>
					<p>some description that you want to appear.</p>
          <br style="clear:both;">
          <br style="clear:both;">
          <br style="clear:both;">
					<br style="clear:both;">
          <div class="cc-controls">
						<a class="btn-lg-custom" href="./safaris.php">See all our children</a>
						&nbsp; &nbsp; &nbsp;
						<a class="eventsLink" href="contact.php">Register as an Adopter</a>
					</div>
				</div>
			</div>


			<!--
				<span class="carousel-left-btn fa fa-chevron-left" aria-hidden="true" style="background-color:#e53e30; color:#fff; line-height:50px; text-align:center; border-radius:50%; width:50px; height:50px;" ></span>
				-->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="z-index:995;">
				<span class="fa fa-angle-left" aria-hidden="true" style="position:absolute; top:40%; background-color:none; font-size:80px; color:#fff;"></span>
				<span class="sr-only">Previous</span>
			</a>

			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="z-index:995;">
				<span class="fa fa-angle-right" aria-hidden="true" style="position:absolute; top:40%; font-size:80px; background-color:none; color:#fff;"></span>
				<span class="sr-only">Next</span>
			</a>

		</div>
	</div>
	<br/>
	<br/>
	<!-- Why us -->
	<div data-aos="fade-up" class="container why-kyobe">
		<div class="row">
			<div class="col-md-6 left-side">
				<br class="clear"/>
				<div class="img-round pull-left">
					<img src="./img/Badge-5.gif"/>
				</div>
				<div class="pull-left desc">
					<h4>Child Adoption</h4>
					<div class="star-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half"></i>
					</div>
					<p>4.5/5 Star rating based on our clients reviews and surveys.</p>
				</div>
				<br class="clear"/>
	
		</div>
		<div class="col-md-6 right-side">
				<h3>Why us?</h3>
				<ul>
					<li><i class="fa fa-check"></i>We provide a unique way to the new genration adoption.</li>
					<li><i class="fa fa-check"></i>We provide a quick and fast service.</li>
					<li><i class="fa fa-check"></i>Our System is online 24/7 365 Days a year.</li><br/>
				</ul>
		</div>
		</div>
</div>
<br/>
<br/>
<!-- Our safaris -->
<div data-aos="fade-up" class="container safaris-module">
	<div class="row">
	<a href="./adopt.php">
		<div class="col-md-4 item s-1">
			<h4 class="text-center">Hoping to Adopt, we have some availble spots.</h4>
		</div>
	
		<div class="col-md-4 item s-2">
			<h4 class="text-center">How to adopt, find out more.</h4>
		</div>
		<div class="col-md-4 item s-3">
			<h4 class="text-center">View all availbale chidren to adopt.</h4>
		</div>
		</a>
	</div>
</div>
<br/>
<br/>
<div data-aos="fade-up" class="container">
<div class="row">
	<div class="col-md-12">
		<h3 class="page-header">Understandidng the Child adoption process</h3>
		</div>
	<div class="col-md-12">
<iframe width="100%" height="500px" src="https://www.youtube.com/embed/vIieXvpSifU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div></div></div><br/>
<br/>

<?php 
  include('./inc/footer.php');
?>