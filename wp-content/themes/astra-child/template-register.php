<?php 
/*
Template Name: Register
*/
get_header() 

?>

	

			<div role="main" class="main">

				<section class="section border-0 m-0 py-5">
				    <div class="container">

				        <!-- Page Header -->
				        <div class="row">
				            <div class="col-lg-9 mx-auto text-center">

				                <h1 class="font-weight-bold text-8 mb-3">
				                   Register
				                </h1>

				                <div class="divider divider-primary divider-small divider-small-center mb-4">
				                    <hr>
				                </div>

				            </div>
				        </div>


				        <!-- Page Content -->
				        <div class="row">
				            <div class="col-lg-9 mx-auto">

				                <div class="page-content-box">

				                   <form action="/" id="frmSignIn" method="post" class="needs-validation" novalidate="novalidate">
           								<div class="row">
           									<div class="form-group col">
           										<label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
           										<input type="text" value="" class="form-control form-control-lg text-4" required="">
           									</div>
           								</div>
           								<div class="row">
           									<div class="form-group col">
           										<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
           										<input type="password" value="" class="form-control form-control-lg text-4" required="">
           									</div>
           								</div>
           								
           								<div class="row">
           									<div class="form-group col">
           										<button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Register</button>
           										
           										
           									</div>
           								</div>
           							</form>

				                </div>

				            </div>
				        </div>

				    </div>
				</section>
				
<?php get_footer() ?>
