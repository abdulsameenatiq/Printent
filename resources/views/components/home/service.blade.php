<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_service($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<!-- Include jQuery (Must be before slick.min.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<section style=" direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="prt-row service-section bg-base-grey clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title">
                    <div class="title-header">
                        <h2 class="title">
                            <?php echo translate('service_heading1', $lang, $translations); ?>
                            <span class="prt-border">
                                <?php echo translate('service_heading2', $lang, $translations); ?>

                            </span>
                            <?php echo translate('service_heading3', $lang, $translations); ?>

                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ml_40 res-991-ml-0">
                    <p>
                        <?php echo translate('service_description', $lang, $translations); ?>
                    </p>
                    <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                        href="bag-printing-design.html">
                        <?php echo translate('awesome_services', $lang, $translations); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section><!--service-section-->

<section style="background-color: ed;" class="prt-row padding_top_zero-section  clearfix">
    <div style="background-color: reen;" class="ontainer">
        <div class="row">
            <div class="col-lg-12">
                <div class="prt-bg prt-col-bgcolor-yes prt-bgcolor-grey prt-right-span spacing-1">
                    <div class="prt-col-wrapper-bg-layer prt-bg-layer">
                        <div class="prt-col-wrapper-bg-layer-inner"></div>
                    </div>
                    <div class="layer-content">
                        <div class="prt-expandcontent_column">
                            <div class="prt-expandcontent_wrapper prt-bgcolor-grey">
                                <div class="slick_slider" id="products-slider"
                                    data-slick='{
                                         "slidesToShow": 4, 
                                         "slidesToScroll": 1, 
                                         "autoplay":true, 
                                         "arrows": false, 
                                         "dots": false, 
                                         "infinite": true, 
                                         "centerMode": false,
                                         "variableWidth": false, 
                                         "responsive": [
                                             {"breakpoint": 1200, "settings": {"slidesToShow": 3}},
                                             {"breakpoint": 992, "settings": {"slidesToShow": 2}},
                                             {"breakpoint": 650, "settings": {"slidesToShow": 1}}
                                         ]
                                     }'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Updated JS & CSS -->
<script>
    function addProductsToSlider(products) {
        const slider = document.getElementById('products-slider');
        slider.innerHTML = ''; // Clear existing content before adding new products

        products.forEach(product => {
            console.log(product, "'''''''''''''''''''''''''");



            let image = 'default.jpg'; // Default fallback image
            try {
                const parsedImages = JSON.parse(product.images);
                if (parsedImages && parsedImages.length > 0) {
                    image = "https://smartprintsa.com" + parsedImages[0] // Handle escaping issues
                    console.log("image29", image);
                }
            } catch (err) {
                console.error('Image parsing failed:', err);
            }

            const productHTML =
                `
                <div>
                <a href="/product/${product.id}">
                <div class="featured-imagebox featured-imagebox-services style1">
                    <div class="featured-thumbnail text-center">
                     <img style="height: 100%; width: 100%; object-fit: cover;object-position: center;" src="${image}" alt="${product.name + " " + product.id}" onerror="this.src='images/default-photo.png'">
                      
                    </div>
                    <a href="/product/${product.id}">
                    <div class="featured-content">
                        <div class="item-content">
                            <div" class="featured-title">
                                <h3>${product.name }</h3>
                            </div>
                            <div class="featured-desc">
                                <p>Price:${product.price}</p>
                            </div>
                        </div>
                        <div class="prt-icon-box">
                            <a href="#"><i class="flaticon-right-down"></i></a>
                        </div>
                    </div>
                    </a>

                </div>
                </a>
            </div>

         `;


            slider.innerHTML += productHTML;
        });

        // if ($('.slick_slider').hasClass('slick-initialized')) {
        //     $('.slick_slider').slick('refresh');
        // } else {
        //     $('.slick_slider').slick();
        // }
        console.log(slider.innerHTML);

        setTimeout(() => {
            if ($('.slick_slider').hasClass('slick-initialized')) {
                $('.slick_slider').slick('unslick');
            }
            $('.slick_slider').slick();
        }, 500);
    }

    async function fetchProducts() {
        try {

            const response = await fetch('https://smartprintsa.com/api/getAllProducts');
            if (!response.ok) {
                throw new Error('Failed to fetch products');
            }
            const data = await response.json();
            console.log("all products", data.Products);
            addProductsToSlider(data.Products || []);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    document.addEventListener("DOMContentLoaded", fetchProducts);
</script>



<!-- Add CSS for better image handling -->
<style>
    .slick_slider {
        display: flex;
        margin: 0;
        padding: 0;
        gap: 30px;
    }

    .slick-slide {
        display: inline-block;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .featured-thumbnail {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 445px;
    }

    .featured-thumbnail img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .slick-slide>div {
        margin: 0 10px;
        /* Adjust this to control spacing between items */
    }

    .slick-slider {
        margin-left: 0 !important;
        /* Ensures the slider aligns to the left */
    }
</style>