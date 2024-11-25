<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_detailheader($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<div class="prt-titlebar-wrapper prt-bg about-img-01">
    <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
    <div class="prt-titlebar-wrapper-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="prt-page-title-row-heading">
                        <div class="page-title-heading">
                            <h2 class="title" id="ProductName001">
                                <?php echo translate('all_products', $lang, $translations); ?>


                            </h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <i class="flaticon-home"></i>
                            <span>
                                <a title="Homepage" href="index-2.html">
                                    <?php echo translate('home', $lang, $translations); ?>

                                </a>
                            </span>
                            <div class="prt-sep"> - </div>
                            <span>
                                <?php echo translate('shop', $lang, $translations); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title end -->

<script>
    const fetchProducts1 = async () => {
        const temp = window.location.href.split("/");
        const productId = temp[temp.length - 1];
        // console.log("Product ID: ", productId);

        try {
            const response = await fetch(`https://smartprintsa.com/api/getSingleProduct/${productId}`, {
                method: 'GET',
            });

            if (response.ok) {
                const data = await response.json();
                // console.log("Fetched data: ", data);

                const product = Array.isArray(data.Products) ? data.Products[0] : data.Products;
                // console.log("Product: ", product);

                if (product && product.name) {
                    const nameField = document.getElementById('ProductName001');
                    nameField.innerHTML = product.name;
                }
            } else {
                console.error('Failed to fetch product:', response.statusText);
            }
        } catch (error) {
            console.error('Error fetching product:', error);
        }
    };

    fetchProducts1();
</script>