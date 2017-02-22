<?php # index.php
session_start();
//check session first
if (!isset($_SESSION['email'])){
include ('../includes/header.php');
}else
{
include ('../includes/header.php');
}
?>


	<!-- Section: intro -->
    <section id="intro" class="intro">
	
		<div class="slogan">
			<h2>WELCOME TO <span class="text_color">Brew City Rentals</span> </h2>
			<h4></h4>
		</div>
		<div class="page-scroll">
			<a href="#about" class="btn btn-circle">
				<i class="fa fa-angle-double-down animated"></i>
			</a>
		</div>
    </section>
	<!-- /Section: intro -->


	
	<!-- Section: about -->
    <section id="about" class="home-section text-center">
		<div class="heading-about">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Rentals</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">

		<div class="row">
			<div class="col-lg-2 col-lg-offset-5">
				<hr class="marginbot-50">
			</div>
		</div>
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-4">
				<div class="wow bounceInUp" data-wow-delay="0.2s">
                <div class="team boxed-white">
                    <div class="inner">
						<h4>New Releases</h4>

                        <div class="avatar"><img src="img/about/1.jpg" alt="" class="img-responsive img-circle" /></div>
                    </div>
                </div>
				</div>
            </div>
			<div class="col-xs-6 col-sm-4 col-md-4">
				<div class="wow bounceInUp" data-wow-delay="0.5s">
                <div class="team boxed-white">
                    <div class="inner">
						<h4>Staff Picks</h4>

                        <div class="avatar"><img src="img/about/2.png" alt="" class="img-responsive img-circle" /></div>

                    </div>
                </div>
				</div>
            </div>		
			<div class="col-xs-6 col-sm-4 col-md-4">
				<div class="wow bounceInUp" data-wow-delay="0.8s">
                <div class="team boxed-white">
                    <div class="inner">
						<h4>Browse</h4>

                        <div class="avatar"><img src="img/about/4.jpg" alt="" class="img-responsive img-circle" /></div>

                    </div>
                </div>
				</div>
            </div>
        </div>		
		</div>
	</section>
	<!-- /Section: about -->
	
	



<?php
include ('../includes/footer.php');
?>
