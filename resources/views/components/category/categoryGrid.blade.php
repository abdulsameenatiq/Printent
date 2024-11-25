<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (file_exists('./translations.json')) {
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);
} else {
    $translations = [];
}

if (!function_exists('translate')) {
    function translate($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : ($translations['en'][$key] ?? $key);
    }
}
?>

<section
    style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="prt-row product-section clearfix">
    <div class="container">
        <div class="row" id="productsWrapper0"></div>
    </div>

    <!-- Modal -->
    @include('components.modals.FailedAddToCart')
</section>

<script>
    const pathname = window.location.pathname;
    const segments = pathname.split('/');
    const Id = segments[segments.length - 1];


    const fetchProducts = async () => {
        try {
            const response = await fetch(`/api/getCategoryProducts/${Id}`, {
                method: 'GET',
            });

            const upperBlock =
                `<div class="col-md-12">
                <div class="section-title title-style-center_text"><div class="title-header">
                <h2 class="title">
                <?php echo translate('our', $lang, $translations); ?>
                <span class="prt-border"> 
                                <?php echo translate('products_heading', $lang, $translations); ?>

                </span></h2></div></div></div>`;
            const productswrapper0 = document.getElementById('productsWrapper0');
            let productCards =
                `<div style="color: red;font-size: 20px;margin-top: 10px">
                                                <?php echo translate('no_product_found', $lang, $translations); ?>

                </div>`;

            if (response.ok) {
                const data = await response.json();
                const products = data.products;
                // console.log(JSON.parse(products[2].images));

                if (products.length > 0) {
                    productCards = products.map(product => {
                        let image = "https://smartprintsa.com" + (product.images ? JSON.parse(product.images)[0] : "");
                        // console.log(image);

                        return `<div class="col-lg-3 col-md-6 col-xs-12">
                                <div class="product"><!--product-->
                                    <div class="product-thumbnail" style="width: 100%;height: 300px;"><!--product-thumbnail-->
                                        <img style="height: 100%; width: 100%;object-fit: cover;object-position: center;" src="${image}" alt="${product.name + " " + product.id}" onerror="this.src='images/default-photo.png'">
                                        <div class="prt-shop-icon"><!--prt-shop-icon-->
                                            <div class="product-btn add-to-cart-btn" style="color:white;cursor:pointer;" onclick="routeToProdDetail(${product.id})">Show Details</div>
                                        </div>
                                    </div><!--product-thumbnail end-->
                                    <div class="product-content"><!--product-content-->
                                        <div class="product-title"><!--product-title-->
                                            <h2><a href="/product/${product.id}">${product.name}</a></h2>
                                        </div>
                                        <span class="product-price"><!--product-Price-->
                                            <span class="product-Price-currencySymbol">$</span>${product.price}
                                        </span>
                                    </div>
                                </div>
                            </div>`
                    })
                        .join('');
                }
            } else {
                console.error('Failed to fetch products', response.statusText);
            }
            const combinedContent = upperBlock + productCards;
            productswrapper0.innerHTML = combinedContent;


        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }
    fetchProducts();


    const routeToProdDetail = (prodId) => window.location.href = `/product/${prodId}`;

    const addToCart = async (productID) => {
        const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage
        // console.log(productID);

        if (!token) {
            console.error('Token not found');
            const modal = new bootstrap.Modal('#failAddToCart00')
            modal.show();
            return;
        }


        const raw = JSON.stringify({
            "product_id": productID,
            "quantity": 2,
            "design_id": 1
        });

        try {
            const response = await fetch('/api/cart', {
                method: 'POST',
                body: raw,
                headers: {
                    'Authorization': `bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                redirect: "follow"
            })



            if (response.ok) {
                console.log(productID, " " + "Successfully added to cart");
                window.alert("Successfully added to cart")

            } else {
                console.error('Failed to add to cart', response.statusText);
                const modal = new bootstrap.Modal('#failAddToCart00')
                modal.show();
            }
        } catch (error) {
            console.error('Error fetching add to cart:', error);
        }
    };
</script>