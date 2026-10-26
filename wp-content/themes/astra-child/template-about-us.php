<?php 
/*
Template Name: About Us
*/
get_header() 

?>

			<div role="main" class="main">

				<section class="section section-default border-0 my-5 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="750">
					<div class="container py-4">

						<div class="row align-items-center">
							<div class="col-md-6 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="1000">
								<div class="owl-carousel owl-theme nav-inside mb-0" data-plugin-options="{'items': 1, 'margin': 10, 'animateOut': 'fadeOut', 'autoplay': true, 'autoplayTimeout': 6000, 'loop': true}">
									<div>
										<img alt="" class="img-fluid" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/adult.jpg">
									</div>
									<div>
										<img alt="" class="img-fluid" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/teen.webp">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="overflow-hidden mb-2">
									<h2 class="text-color-dark font-weight-normal text-7 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="1200">Who <strong class="font-weight-extra-bold">We Are</strong></h2>
								</div>
								<p class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam <a href="#">vehicula</a> sit amet enim ac sagittis. Curabitur eget leo varius, elementum mauris eget, egestas quam. Donec ante risus, dapibus sed lectus non, lacinia vestibulum nisi. Morbi vitae augue quam. Nullam ac laoreet libero.</p>
								<p class="mb-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">Consectetur adipiscing elit. Aliquam iaculis sit amet enim ac sagittis. Curabitur eget leo varius, elementum mauris eget, egestas quam.</p>
							</div>
						</div>

					</div>
				</section>

			
				<?php get_template_part("template-parts/section/promo-banner") ?>
				<?php get_template_part("template-parts/section/instagration-section") ?>
				
<?php get_footer() ?>
