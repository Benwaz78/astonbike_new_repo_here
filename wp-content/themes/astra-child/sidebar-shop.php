<!-- Desktop Sidebar -->
<div class="col-lg-3 order-2 order-lg-1 d-none d-lg-block">

	<aside class="sidebar">

		<form
			method="get"
			action="<?php echo esc_url(
				shop_filter_get_form_action()
			); ?>"
			class="shop-filter-form"
		>

			<!-- Price Filter -->
			<div class="shop-filter-section mb-5">

				<h5 class="font-weight-semi-bold text-4 mb-3">
					Price
				</h5>

				<div class="price-filter">

					<div class="d-flex gap-2 mb-3">

						<div class="flex-grow-1">

							<label
								class="text-1 text-uppercase font-weight-semibold mb-1"
								for="shop-filter-min-price"
							>
								Min
							</label>

							<input
								type="number"
								id="shop-filter-min-price"
								name="min_price"
								class="form-control"
								placeholder="₦0"
								min="0"
								value="<?php echo esc_attr(
									shop_filter_get_min_price()
								); ?>"
							>

						</div>


						<div class="flex-grow-1">

							<label
								class="text-1 text-uppercase font-weight-semibold mb-1"
								for="shop-filter-max-price"
							>
								Max
							</label>

							<input
								type="number"
								id="shop-filter-max-price"
								name="max_price"
								class="form-control"
								placeholder="₦1,000,000"
								min="0"
								value="<?php echo esc_attr(
									shop_filter_get_max_price()
								); ?>"
							>

						</div>

					</div>


					<button
						type="submit"
						class="btn btn-dark btn-sm text-uppercase font-weight-semibold"
					>
						Apply Filters
					</button>

				</div>

			</div>


			<!-- Shop By Category -->
			<div class="shop-filter-section mb-5">

				<h5 class="font-weight-semi-bold text-4 mb-3">
					Shop By Category
				</h5>

				<ul class="list list-unstyled mb-0">

					<?php foreach (
						shop_filter_get_categories()
						as $category
					) : ?>

						<li class="mb-2">

							<label
								class="d-flex align-items-center"
							>

								<input
									type="checkbox"
									name="product_cat[]"
									value="<?php echo esc_attr(
										$category->slug
									); ?>"
									class="me-2"
									<?php checked(
										shop_filter_is_category_selected(
											$category->slug
										)
									); ?>
								>

								<span>
									<?php echo esc_html(
										$category->name
									); ?>
								</span>

							</label>

						</li>

					<?php endforeach; ?>

				</ul>

			</div>


			<!-- Shop By Attributes -->
			<div class="shop-filter-section">

				<h5 class="font-weight-semi-bold text-4 mb-3">
					Shop By Attributes
				</h5>


				<?php
				$attributes = shop_filter_get_attributes();
				?>

				<?php foreach (
					$attributes as $attribute
				) : ?>

					<?php
					$terms = shop_filter_get_attribute_terms(
						$attribute->attribute_name
					);

					if ( empty( $terms ) ) {
						continue;
					}
					?>

					<div class="mb-4">

						<h6 class="font-weight-semibold text-3 mb-2">

							<?php echo esc_html(
								$attribute->attribute_label
							); ?>

						</h6>


						<?php foreach (
							$terms as $term
						) : ?>

							<?php
							$input_id = 'filter-' .
								$attribute->attribute_name .
								'-' .
								$term->term_id;
							?>

							<div class="form-check mb-2">

								<input
									class="form-check-input"
									type="checkbox"
									id="<?php echo esc_attr(
										$input_id
									); ?>"
									name="filter_<?php echo esc_attr(
										$attribute->attribute_name
									); ?>[]"
									value="<?php echo esc_attr(
										$term->slug
									); ?>"
									<?php checked(
										shop_filter_is_attribute_selected(
											$attribute->attribute_name,
											$term->slug
										)
									); ?>
								>

								<label
									class="form-check-label"
									for="<?php echo esc_attr(
										$input_id
									); ?>"
								>
									<?php echo esc_html(
										$term->name
									); ?>
								</label>

							</div>

						<?php endforeach; ?>

					</div>

				<?php endforeach; ?>


			<button
				type="submit"
				class="btn btn-dark text-uppercase font-weight-semibold"
			>
				Apply Filters
			</button>

		</form>

	</aside>

</div>