<!-- Footer -->
        <footer class="astonbike-footer">

            <!-- Main Footer -->
            <div class="astonbike-footer-main py-5">
                <div class="container">

                    <div class="row">

                        <!-- Brand -->
                        <div class="col-lg-4 mb-4 mb-lg-0">

                            <a href="#" class="d-inline-block mb-3">
                                <img
                                    src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-white.png"
                                    alt="AstonBike"
                                    height="100"
                                >
                            </a>

                            <p class="text-2 mb-4">
                                Quality bikes, scooters and cycling essentials
                                for riders of all ages.
                            </p>

                            <!-- Social Icons -->
                            <div class="astonbike-footer-social">

                                <a href="#" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>

                                <a href="#" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a href="#" aria-label="TikTok">
                                    <i class="fab fa-tiktok"></i>
                                </a>

                            </div>

                        </div>


                        <!-- Shop -->
                        <div class="col-6 col-lg-2 mb-4 mb-lg-0">

                            <h3 class="text-4 font-weight-semibold mb-4">
                                Shop
                            </h3>

                            <ul class="list-unstyled mb-0">

                                <li class="mb-2">
                                    <a href="#">Bikes</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Children</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Teens</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Adults</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Scooters</a>
                                </li>

                                <li>
                                    <a href="#">Accessories</a>
                                </li>

                            </ul>

                        </div>


                        <!-- Customer Service -->
                        <div class="col-6 col-lg-3 mb-4 mb-lg-0">

                            <h3 class="text-4 font-weight-semibold mb-4">
                                Customer Service
                            </h3>

                            <ul class="list-unstyled mb-0">

                                <li class="mb-2">
                                    <a href="#">Contact Us</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Delivery Information</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">Returns & Refunds</a>
                                </li>

                                <li class="mb-2">
                                    <a href="#">FAQs</a>
                                </li>

                                <li>
                                    <a href="#">Terms & Conditions</a>
                                </li>

                            </ul>

                        </div>


                        <!-- Contact -->
                        <div class="col-lg-3">

                            <h3 class="text-4 font-weight-semibold mb-4">
                                Get In Touch
                            </h3>

                            <ul class="list-unstyled mb-0">

                                <li class="d-flex mb-3">

                                    <i class="fas fa-map-marker-alt mr-3 mt-1"></i>

                                    <span>
                                        Your AstonBike Store Address
                                    </span>

                                </li>

                                <li class="d-flex mb-3">

                                    <i class="fas fa-phone mr-3 mt-1"></i>

                                    <a href="tel:+00000000000">
                                        +00 000 000 0000
                                    </a>

                                </li>

                                <li class="d-flex">

                                    <i class="fas fa-envelope mr-3 mt-1"></i>

                                    <a href="mailto:info@astonbike.com">
                                        info@astonbike.com
                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>
            </div>


            <!-- Copyright -->
            <div class="astonbike-footer-bottom py-3">

                <div class="container">

                    <div class="row align-items-center">

                        <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">

                            <p class="mb-0 text-2">
                                &copy; 2026 AstonBike. All Rights Reserved.
                            </p>

                        </div>

                        <div class="col-md-6 text-center text-md-right">

                            <a href="#" class="text-2 mr-3">
                                Privacy Policy
                            </a>

                            <a href="#" class="text-2">
                                Terms & Conditions
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </footer>
		</div>
		</div>
        <!-- Modal Trigger -->

<!-- Modal -->

<!-- Product Quick View Modal -->
<div
    class="modal fade product-quick-view"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="quick-view-heading">
                    <span class="quick-view-eyebrow">ASTON BIKE</span>
                    <h5 class="modal-title" id="exampleModalLabel">
                        Quick View
                    </h5>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="quick-view-content" id="quickViewContent">
                     <div class="quick-view-loading text-center py-5">
                        <span
                            class="spinner-border"
                            role="status"
                            aria-hidden="true"
                        ></span>
                        <p class="mt-3 mb-0">Loading product...</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Cart View Modal Start -->
 <div class="offcanvas offcanvas-end popup-shopping-cart" id="shoppingCart" aria-modal="true" role="dialog">
        <div class="canvas-wrapper overflow-hidden">
            <div class="popup-header">
                <div class="d-flex justify-content-between align-items-start mb-24">
                    <h6 class="font-instrument_serif">
                        Your Cart (<span class="prd__count">9</span>)
                    </h6>
                    <i class="fa-solid fa-xmark btn-close-popup fs-24" data-bs-dismiss="offcanvas"></i>
                </div>
                
                <div class="br-line bg-line-5"></div>
            </div>
            <div class="wrap">
                <div class="tf-mini-cart-wrap list-file-delete wrap-empty_text">
                    <div class="tf-mini-cart-main">
                        <div class="tf-mini-cart-sroll">
                            <div class="tf-mini-cart-items list-empty">
                                <div class="box-text_empty type-shop_cart" style="display: none;">
                                    <div class="shop-empty_top">
                                        <span class="icon">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </span>
                                        <p class="text-emp text-body-l fw-normal">Your cart is empty</p>
                                        <p class="text-body-s cl-text-5">
                                            Looks like you haven’t added anything yet. <br>
                                            Start browsing and find something you’ll love.
                                        </p>
                                    </div>
                                    <div class="shop-empty_bot">
                                        <a href="shop-default.html" class="tf-btn style-2 type-2">Continue Shopping </a>
                                    </div>
                                </div>

                                <div data-cart-item-template="" class="tf-mini-cart-item file-delete" style="display: none;">
                                    <a href="#" class="tf-mini-cart-image">
                                        <img loading="lazy" width="74" height="88" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="">
                                    </a>
                                    <div class="tf-mini-cart-info">
                                        <a href="#" class="name fw-normal link-underline text-line-clamp-1">
                                            
                                        </a>
                                        <div class="tf-prd-select select-color text-body-s cl-text-5">
                                            <span class="type-text">
                                                Size:&nbsp;
                                            </span>
                                            <div class="type-select">
                                                <select class="bg-white">
                                                    <option selected="selected"></option>
                                                    <option></option>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tf-mini-cart-price">
                                        <div class="price-wrap gap-6">
                                            <span class="price-new fw-normal text-primary tf-mini-card-price"></span>
                                            <span class="price-old fw-normal cl-text-6"></span>
                                        </div>
                                        <div class="group-action">
                                            <div class="wg-quantity style-2">
                                                <button type="button" class="btn-quantity minus-btn">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input class="quantity-product" type="text" name="number" value="1">
                                                <button type="button" class="btn-quantity plus-btn">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-quantity btn-custom-border style-2 remove">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                            <div class="tf-mini-cart-item file-delete" style="" data-cart-item="" data-cart-item-key="66f041e16a60928b05a7e228a89c3799">
                                    <a href="http://localhost/oltouchupworld/product/cream-for-anti-aging/" class="tf-mini-cart-image">
                                        <img loading="lazy" width="74" height="88" src="http://localhost/oltouchupworld/wp-content/uploads/2026/08/collect-12-300x300.jpg" alt="Cream for Anti-Aging">
                                    </a>
                                    <div class="tf-mini-cart-info">
                                        <a href="http://localhost/oltouchupworld/product/cream-for-anti-aging/" class="name fw-normal link-underline text-line-clamp-1">Cream for Anti-Aging</a>
                                        
                                    </div>
                                    <div class="tf-mini-cart-price">
                                        <div class="price-wrap gap-6">
                                            <span class="price-new fw-normal text-primary tf-mini-card-price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>80.00</bdi></span></span>
                                            <span class="price-old fw-normal cl-text-6"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>100.00</bdi></span></span>
                                        </div>
                                        <div class="group-action">
                                            <div class="wg-quantity style-2">
                                                <button type="button" class="btn-quantity minus-btn" data-cart-item-key="66f041e16a60928b05a7e228a89c3799">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input class="quantity-product" type="text" name="number" value="1">
                                                <button type="button" class="btn-quantity plus-btn" data-cart-item-key="66f041e16a60928b05a7e228a89c3799">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-quantity btn-custom-border style-2 remove" data-cart-item-key="66f041e16a60928b05a7e228a89c3799">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div><div class="tf-mini-cart-item file-delete" style="" data-cart-item="" data-cart-item-key="8edff1478f794ca3181daed2995be671">
                                    <a href="http://localhost/oltouchupworld/product/clear-skin-tonic/?attribute_pa_volume=50ml" class="tf-mini-cart-image">
                                        <img loading="lazy" width="74" height="88" src="http://localhost/oltouchupworld/wp-content/uploads/2026/08/product-1-300x300.jpg" alt="Clear Skin Tonic - 50ml">
                                    </a>
                                    <div class="tf-mini-cart-info">
                                        <a href="http://localhost/oltouchupworld/product/clear-skin-tonic/?attribute_pa_volume=50ml" class="name fw-normal link-underline text-line-clamp-1">Clear Skin Tonic - 50ml</a>
                                        <div class="tf-prd-select select-color text-body-s cl-text-5">
                                            <span class="type-text">Volume: </span>
                                            <div class="type-select">
                                                <select class="bg-white"><option value="50ml">50ml</option></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tf-mini-cart-price">
                                        <div class="price-wrap gap-6">
                                            <span class="price-new fw-normal text-primary tf-mini-card-price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>90.00</bdi></span></span>
                                            <span class="price-old fw-normal cl-text-6"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>45.00</bdi></span></span>
                                        </div>
                                        <div class="group-action">
                                            <div class="wg-quantity style-2">
                                                <button type="button" class="btn-quantity minus-btn" data-cart-item-key="8edff1478f794ca3181daed2995be671">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input class="quantity-product" type="text" name="number" value="1">
                                                <button type="button" class="btn-quantity plus-btn" data-cart-item-key="8edff1478f794ca3181daed2995be671">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-quantity btn-custom-border style-2 remove" data-cart-item-key="8edff1478f794ca3181daed2995be671">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div><div class="tf-mini-cart-item file-delete" style="" data-cart-item="" data-cart-item-key="093f65e080a295f8076b1c5722a46aa2">
                                    <a href="http://localhost/oltouchupworld/product/natural-moisturizing-factors/" class="tf-mini-cart-image">
                                        <img loading="lazy" width="74" height="88" src="http://localhost/oltouchupworld/wp-content/uploads/2026/08/collect-10-300x300.jpg" alt="Natural Moisturizing Factors">
                                    </a>
                                    <div class="tf-mini-cart-info">
                                        <a href="http://localhost/oltouchupworld/product/natural-moisturizing-factors/" class="name fw-normal link-underline text-line-clamp-1">Natural Moisturizing Factors</a>
                                        
                                    </div>
                                    <div class="tf-mini-cart-price">
                                        <div class="price-wrap gap-6">
                                            <span class="price-new fw-normal text-primary tf-mini-card-price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>210.00</bdi></span></span>
                                            <span class="price-old fw-normal cl-text-6" style="display: none;"></span>
                                        </div>
                                        <div class="group-action">
                                            <div class="wg-quantity style-2">
                                                <button type="button" class="btn-quantity minus-btn" data-cart-item-key="093f65e080a295f8076b1c5722a46aa2">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input class="quantity-product" type="text" name="number" value="1">
                                                <button type="button" class="btn-quantity plus-btn" data-cart-item-key="093f65e080a295f8076b1c5722a46aa2">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-quantity btn-custom-border style-2 remove" data-cart-item-key="093f65e080a295f8076b1c5722a46aa2">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div><div class="tf-mini-cart-item file-delete" style="" data-cart-item="" data-cart-item-key="47d1e990583c9c67424d369f3414728e">
                                    <a href="http://localhost/oltouchupworld/product/sample-products/" class="tf-mini-cart-image">
                                        <img loading="lazy" width="74" height="88" src="http://localhost/oltouchupworld/wp-content/uploads/2026/08/product-5-300x300.jpg" alt="Sample Products">
                                    </a>
                                    <div class="tf-mini-cart-info">
                                        <a href="http://localhost/oltouchupworld/product/sample-products/" class="name fw-normal link-underline text-line-clamp-1">Sample Products</a>
                                        
                                    </div>
                                    <div class="tf-mini-cart-price">
                                        <div class="price-wrap gap-6">
                                            <span class="price-new fw-normal text-primary tf-mini-card-price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>40.00</bdi></span></span>
                                            <span class="price-old fw-normal cl-text-6" style="display: none;"></span>
                                        </div>
                                        <div class="group-action">
                                            <div class="wg-quantity style-2">
                                                <button type="button" class="btn-quantity minus-btn" data-cart-item-key="47d1e990583c9c67424d369f3414728e">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input class="quantity-product" type="text" name="number" value="1">
                                                <button type="button" class="btn-quantity plus-btn" data-cart-item-key="47d1e990583c9c67424d369f3414728e">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-quantity btn-custom-border style-2 remove" data-cart-item-key="47d1e990583c9c67424d369f3414728e">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div></div>
                          
                        </div>
                    </div>
                    <div class="tf-mini-cart-bottom box-empty_clear">
                        
                        <div class="tf-mini-cart-total text-body-l fw-normal">
                            <span>Estomated total</span>
                            <div class="price-wrap gap-6">
                                <span class="price-new tf-totals-total-value fw-normal"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol" translate="no">£</span>420.00</bdi></span></span>
                                <span class="price-old fw-normal cl-text-6"></span>
                            </div>
                        </div>
                        
                        <div class="tf-mini-cart-view-checkout">
                            <a href="http://localhost/oltouchupworld/cart/" class="tf-btn style-2 type-2 btn-light">
                                View cart
                            </a>
                            <a href="http://localhost/oltouchupworld/checkout/" class="tf-btn style-2 type-2">
                                Check out
                            </a>
                        </div>
                        <p class="text-body-s text-center cl-text-5">
                            Tax and shipping calculated at checkout
                        </p>
                    </div>
                    <div class="tf-mini-cart-tool-overlay tf-mini-cart-tool-close"></div>
                    <div class="tf-mini-cart-tool-openable add-note">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text h6 font-instrument_serif">
                                Order note
                                <i class="fa-solid fa-xmark tf-mini-cart-tool-close link-rotate"></i>
                            </div>
                            <div class="tf-field">
                                <label for="cart-note" class="text-body-xs">Special instructions</label>
                                <textarea name="note" id="cart-note" placeholder="Add delivery notes, gift instructions, or any special requests for your order." required=""></textarea>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn type-2 style-2" type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable estimate-shipping">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form id="shipping-form" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text h6 font-instrument_serif">
                                Estimate shipping
                                <i class="fa-solid fa-xmark tf-mini-cart-tool-close link-rotate"></i>
                            </div>
                            <div class="form-content">
                                <div id="zipcode-message" class="zipcode-message error text-body-s" style="display: none">
                                    <p class="msg-text_1 fw-normal mb-6">
                                        <i class="fa-solid fa-xmark fs-16"></i>
                                        Unable to calculate shipping
                                    </p>
                                    <p class="msg-text_2">
                                        Shipping couldn’t be calculated for this address. Check your details and try
                                        again.
                                    </p>
                                </div>
                                <div id="zipcode-success" class="zipcode-success success text-body-s" style="display: none">
                                    <p class="msg-text_1 fw-normal mb-6">
                                        <i class="icon icon-Check fs-16"></i>
                                        Shipping option available
                                    </p>
                                    <p class="msg-text_2">
                                        Standard delivery — <span class="fw-normal"> $18.61 USD</span>
                                    </p>
                                </div>
                                <div class="tf-field">
                                    <label for="shipping-country-form" class="text-body-xs">Country</label>
                                    <div class="tf-select w-100">
                                        <select id="shipping-country-form" name="address[country]" data-default="">

                                            <option value="Australia" data-provinces="[[&quot;Australian Capital Territory&quot;,&quot;Australian Capital Territory&quot;],[&quot;New South Wales&quot;,&quot;New South Wales&quot;],[&quot;Northern Territory&quot;,&quot;Northern Territory&quot;],[&quot;Queensland&quot;,&quot;Queensland&quot;],[&quot;South Australia&quot;,&quot;South Australia&quot;],[&quot;Tasmania&quot;,&quot;Tasmania&quot;],[&quot;Victoria&quot;,&quot;Victoria&quot;],[&quot;Western Australia&quot;,&quot;Western Australia&quot;]]">
                                                Australia
                                            </option>
                                            <option value="Austria" data-provinces="[]">Austria</option>
                                            <option value="Belgium" data-provinces="[]">Belgium</option>
                                            <option value="Canada" data-provinces="[[&quot;Ontario&quot;,&quot;Ontario&quot;],[&quot;Quebec&quot;,&quot;Quebec&quot;]]">
                                                Canada</option>
                                            <option value="Czech Republic" data-provinces="[]">Czechia</option>
                                            <option value="Denmark" data-provinces="[]">Denmark</option>
                                            <option value="Finland" data-provinces="[]">Finland</option>
                                            <option value="France" data-provinces="[]">France</option>
                                            <option value="Germany" data-provinces="[]">Germany</option>
                                            <option value="United States" data-provinces="[[&quot;Alabama&quot;,&quot;Alabama&quot;],[&quot;California&quot;,&quot;California&quot;],[&quot;Florida&quot;,&quot;Florida&quot;]]">
                                                United States
                                            </option>
                                            <option value="United Kingdom" data-provinces="[[&quot;England&quot;,&quot;England&quot;],[&quot;Scotland&quot;,&quot;Scotland&quot;],[&quot;Wales&quot;,&quot;Wales&quot;],[&quot;Northern Ireland&quot;,&quot;Northern Ireland&quot;]]">
                                                United Kingdom
                                            </option>
                                            <option value="India" data-provinces="[]">India</option>
                                            <option value="Japan" data-provinces="[]">Japan</option>
                                            <option value="Mexico" data-provinces="[]">Mexico</option>
                                            <option value="South Korea" data-provinces="[]">South Korea</option>
                                            <option value="Spain" data-provinces="[]">Spain</option>
                                            <option value="Italy" data-provinces="[]">Italy</option>
                                            <option value="Vietnam" data-provinces="[[&quot;Ha Noi&quot;,&quot;Ha Noi&quot;],[&quot;Da Nang&quot;,&quot;Da Nang&quot;],[&quot;Ho Chi Minh&quot;,&quot;Ho Chi Minh&quot;]]">
                                                Vietnam
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="tf-field">
                                    <label for="shipping-province-form" class="text-body-xs">Province</label>
                                    <div class="tf-select w-100">
                                        <select id="shipping-province-form" name="address[province]" data-default=""><option value="Australian Capital Territory">Australian Capital Territory</option><option value="New South Wales">New South Wales</option><option value="Northern Territory">Northern Territory</option><option value="Queensland">Queensland</option><option value="South Australia">South Australia</option><option value="Tasmania">Tasmania</option><option value="Victoria">Victoria</option><option value="Western Australia">Western Australia</option></select>
                                    </div>
                                </div>
                                <div class="tf-field">
                                    <label for="zipcode" class="text-body-xs">Zip/Postal code</label>
                                    <input type="text" placeholder="Postal code" data-opend-focus="" id="zipcode" name="address[zip]" value="">
                                </div>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn style-2 type-2" type="submit">
                                    Calculate
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable add-gift">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form id="formApplyDis" class="tf-mini-cart-tool-content form-add_gift">
                            <div class="tf-mini-cart-tool-text h6 font-instrument_serif">
                                Discount
                                <i class="fa-solid fa-xmark tf-mini-cart-tool-close link-rotate"></i>
                            </div>
                            <div class="tf-field">
                                <label for="discount-code" class="text-body-xs">Discount code</label>
                                <input type="text" id="discount-code" class="" placeholder="Enter discount code here" value="SAVE30" required="">
                                <label for="discount-code" class="msg-text_dis error text-body-xs">
                                    This code is invalid or no longer available. Please check and try again.
                                </label>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="apply-button tf-btn type-2 style-2" type="submit">
                                    Apply
                                </button>
                            </div>
                            <div class="form-accept_notice">
                                <span class="icon mb-16">
                                    <i class="icon-CircleCheck"></i>
                                </span>
                                <p class="text-body-l fw-normal mb-8">Discount Applied</p>
                                <p class="text-body-s cl-text-5 mb-8">Your discount has been applied to this order.</p>
                                <p class="text-body-s fw-normal">You’ve saved $30 USD!</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Cart View Modal End -->

		<?php wp_footer() ?>
	</body>
</html>
