<?php 
get_header() 
?>

	<div role="main" class="main">
        <section class="section border-0 m-0 py-5">
            <div class="container">

                <!-- Page Header -->
                <div class="row">
                    <div class="col-lg-9 mx-auto text-center">

                        <h1 class="font-weight-bold text-8 mb-3">
                           <?php the_title(); ?>
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

                            <?php
                                while ( have_posts() ) :
                                    the_post();

                                    the_content();
                                endwhile;
                            ?>

                        </div>

                    </div>
                </div>

            </div>
        </section>
						
<?php get_footer() ?>
