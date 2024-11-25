<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_detailcarousel($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

@section('meta_description', 'Smart')
@section('meta_keywords', 'Smart')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Dynamic Meta Title -->
    <title id="dynamicTitle"></title>

    <!-- Dynamic Meta Description -->
    <!-- <meta name="description" content="Product details page" id="dynamicMetaDescription"> -->
</head>

<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="prt-row about-section_1 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="prt_single_image-wrapper">
                    <swiper-container
                        id="detail-image"
                        style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff;--swiper-navigation-size: 30px"
                        class="mySwiper ProductImagesMain00" thumbs-swiper=".mySwiper2" loop="true" space-between="10"
                        navigation="true">
                        <!-- <swiper-slide>
                            <img src="images/default-photo.png" />
                        </swiper-slide> -->
                    </swiper-container>
                    <swiper-container class="mySwiper2 ProductImagesSlides00" loop="true" space-between="10"
                        slides-per-view="4" free-mode="true" watch-slides-progress="true" id="detail-image-min">


                    </swiper-container>
                </div>
            </div>
            <div class="col-xl-6">
                <div
                    class="featured-icon-box icon-align-before-content style9 mb-20 res-991-mt-0 res-991-mb-0 res-767-pb-10 res-991-pl-0 icon-ver_align-top productdetailcomp001">
                    <div class="featured-icon">
                        <div
                            class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-lg prt-icon_element-color-skin">
                            <i class="flaticon-printed"></i>
                        </div>
                    </div>
                    <div class="featured-content">
                        <div class="featured-title">
                            <h3 id="ProductName00">
                                <?php echo translate('product_name', $lang, $translations); ?>

                            </h3>
                        </div>
                        <div class="featured-desc">
                            <p id="ProductPrice00">

                                <?php echo translate('product_price', $lang, $translations); ?>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="featured-icon-box icon-align-before-content style9 mb-20 res-991-mt-0 res-991-mb-0 res-767-pb-10 res-991-pl-0 p-det icon-ver_align-top"
                    style="padding-top: 0px !important">
                    <div class="featured-icon">
                        <div
                            class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-lg prt-icon_element-color-skin">
                            <i class="flaticon-roll"></i>
                        </div>
                    </div>
                    <div class="featured-content" style="width: 100%">
                        <div class="featured-title">
                            <h3>

                                <?php echo translate('product_specifications', $lang, $translations); ?>

                            </h3>
                        </div>
                        <div class="prodDetail-2cont">

                            <div class="pd2c-drop-cont" style="flex: 1">
                                <label for="size">

                                    <?php echo translate('product_size', $lang, $translations); ?>

                                </label>
                                <select id="size" class="ProductSize00" name="size">
                                </select>
                            </div>

                            <div class="pd2c-drop-cont pd2c-drop-cont2" style="flex: 1">
                                <label for="side">

                                    <?php echo translate('product_side', $lang, $translations); ?>

                                </label>
                                <select id="side" name="side" class="minimal ProductSide00">
                                </select>
                            </div>
                        </div>

                        <div class="pd2c-drop-cont" style="flex: 1;margin-top: 20px">
                            <label for="material">
                                <?php echo translate('product_selected_material', $lang, $translations); ?>

                            </label>
                            <select id="material" name="material" class="ProductMaterial00">
                            </select>
                        </div>

                        {{-- <div style="margin-top: 20px">
                            <p class="prodDetailChkbox">
                                <input type="checkbox" name="genres" value="adventure" id="adventure_id">
                                <label for="adventure_id"
                                    style="font-family: 'Poppins'; font-size:18px;margin-left: 5px">Creasing & Folding
                                    UAE </label>
                            </p>
                            <p class="prodDetailChkbox">
                                <input type="checkbox" name="genres" value="adventure" id="adventure_id2">
                                <label for="adventure_id2"
                                    style="font-family: 'Poppins'; font-size:18px;margin-left: 5px">Round Corners UAE
                                </label>
                            </p>
                        </div> --}}


                        {{-- <div class="prodDetailPurchaseBut">
                            <button class="prodDetailAddToCart" type="submit">Add To
                                Cart</button>
                            <button class="prodDetailBuyNow" type="submit">Buy Now</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById("size").onclick = function() {
        localStorage.setItem("size", this.value)
    }
    document.getElementById("side").onclick = function() {
        localStorage.setItem("side", this.value)
    }
    const fetchProducts = async () => {
        const temp = window.location.href.split("/")
        const productId = temp[temp.length - 1];
        // console.log(productId);

        try {
            const response = await fetch(`https://smartprintsa.com/api/getSingleProduct/${productId}`, {
                method: 'GET',
            });

            if (response.ok) {
                const data = await response.json();
                const product = data.Products;
                localStorage.setItem('product', JSON.stringify(product))

                // Set the dynamic title and meta description
                if (product.name) {
                    document.title = product.name;
                    // const metaTitle = document.getElementById('dynamicTitle');
                    // metaTitle.innerHTML = product.name;
                }

                if (product.images) {
                    let pImages = JSON.parse(product.images)
                    const images = document.getElementById('detail-image');
                    const imagesMin = document.getElementById('detail-image-min');
                    console.log("pImages", pImages);

                    pImages.forEach(image => {
                        let imageDetail = "https://smartprintsa.com" + image
                        console.log(imageDetail);

                        images.innerHTML += `
                         <swiper-slide>
                                <img src=${imageDetail} />
                            </swiper-slide>
                        `

                        imagesMin.innerHTML += `
                         <swiper-slide>
                                <img src=${imageDetail} />
                            </swiper-slide>
                        `

                    })
                    // nameField.innerHTML = product.name;
                }
                if (product.name) {
                    const nameField = document.getElementById('ProductName00');
                    nameField.innerHTML = product.name;
                }
                if (product.price) {
                    const priceField = document.getElementById('ProductPrice00');
                    priceField.innerHTML = "Price: $" + product.price;
                }
                if (product.side) {
                    const sideField = document.getElementsByClassName('ProductSide00')[0];
                    const sideOptions = [...Array(parseInt(product.side)).keys()].map(side => {
                        return `<option value="${side + 1}">${side + 1}</option>`;
                    }).join('')

                    sideField.innerHTML = sideOptions;
                }
                if (product.size) {
                    const productSizeArray = JSON.parse(product.size);
                    const sizeField = document.getElementsByClassName('ProductSize00')[0];
                    const sizeOptions = productSizeArray.map(size => {
                        return `<option value="${size}">${size}</option>`;
                    }).join('')

                    sizeField.innerHTML = sizeOptions;
                    // console.log(productSizeArray);
                }
                if (product.material) {
                    const productMaterialArray = JSON.parse(product.material);
                    const materialField = document.getElementsByClassName('ProductMaterial00')[0];
                    const materialOptions = productMaterialArray.map(material => {
                        return `<option value="${material}">${material}</option>`;
                    }).join('')

                    materialField.innerHTML = materialOptions;
                }
                if (product.images) {
                    const productImagesArray = JSON.parse(product.images);
                    const imageMainField = document.getElementsByClassName('ProductImagesMain00')[0];
                    const imageSlideField = document.getElementsByClassName('ProductImagesSlides00')[0];
                    const imagesMainEle = productImagesArray.map(image => {
                        return `<swiper-slide><img src="https://smartprintsa.com${image}" onerror="this.src='images/default-photo.png'" /></swiper-slide>`;
                    }).join('')

                    imageMainField.innerHTML = imagesMainEle;
                    imageSlideField.innerHTML = imagesMainEle;
                }
            } else {
                console.error('Failed to fetch products', response.statusText);
            }
            // const combinedContent = upperBlock + productCards;
            // productswrapper0.innerHTML = combinedContent;

        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }
    fetchProducts();
</script>