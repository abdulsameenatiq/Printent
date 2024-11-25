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

<style>
    .deletetrashbtn {
        background: transparent;
    }
</style>

<section class="h-100">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0"><?php echo translate('Shopping Cart', $lang, $translations); ?></h3>
                    {{-- <div>
                        <p class="mb-0"><span class="text-muted">
                                <?php echo translate('Sort by', $lang, $translations); ?>:
                            </span> <a href="#!" class="text-body">
                                <?php echo translate('price', $lang, $translations); ?>
                                <i class="fas fa-angle-down mt-1"></i>
                            </a></p>
                    </div> --}}
                </div>

                <div id="cart-items">
                    <!-- Cart items will be inserted here -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="prodDetailBuyNow"
                            onclick="alert('clicked')"><?php echo translate('Proceed to Pay', $lang, $translations); ?></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    async function fetchCarts() {
        const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage
        console.log(token);

        if (!token) {
            console.error('<?php echo translate("Token not found", $lang, $translations); ?>');
            return;
        }

        try {
            const response = await fetch('https://smartprintsa.com/api/getCart', {
                method: 'GET',
                headers: {
                    'Authorization': `bearer ${token}`, // Replace with your actual token
                    'Content-Type': 'application/json'
                }
            });
            if (!response.ok) {
                throw new Error(`<?php echo translate("Failed to fetch carts", $lang, $translations); ?>: ${response.status} ${response.statusText}`);
            }
            const data = await response.json();
            console.log("all carts", data.carts);
            addProductsToCart(data.carts || []);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    function addProductsToCart(carts) {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = ''; // Clear existing items

        carts.forEach(cartItem => {
            let image = cartItem.product.images ? JSON.parse(cartItem.product.images)[0] : "";
            const itemCard = `
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2" style="width: 150px;height: 65px;">
                                <img src="https://smartprintsa.com${image}" class="img-fluid rounded-3" alt="${cartItem.product.name}" style="height: 100%; width: 100%;object-fit: cover;object-position: center;">
                            </div>
                            <a class="col-md-3 col-lg-3 col-xl-3" href="/product/${cartItem.id}">
                                <p class="lead fw-normal mb-2">${cartItem.product.name}</p>
                                <p><span class="text-muted"><?php echo translate('Size', $lang, $translations); ?>: </span>${cartItem.size} <span class="text-muted"><?php echo translate('Color', $lang, $translations); ?>:</span> ${cartItem.color}</p>
                            </a>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input id="quantity-${cartItem.id}" min="0" name="quantity" value="${cartItem.quantity}" type="number" class="form-control form-control-sm" />
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0">$${cartItem.product.price}</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <button class="text-danger deletetrashbtn" onclick="removeItem(${cartItem.id})"><i class="fas fa-trash fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            cartItemsContainer.innerHTML += itemCard;
        });
    }

    document.addEventListener("DOMContentLoaded", fetchCarts);

    function removeItem(itemId) {
        console.log(`Remove item with ID: ${itemId}`);
        deleteCarts(itemId); // Call deleteCarts function with itemId
    }

    async function deleteCarts(itemId) {
        const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage
        console.log(token);

        if (!token) {
            console.error('<?php echo translate("Token not found", $lang, $translations); ?>');
            return;
        }

        try {
            const response = await fetch('https://smartprintsa.com/api/deleteCart/' + itemId, {
                method: 'DELETE',
                headers: {
                    'Authorization': `bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            if (!response.ok) {
                throw new Error(`<?php echo translate("Failed to delete carts", $lang, $translations); ?>: ${response.status} ${response.statusText}`);
            }
            const data = await response.json();
            console.log("Cart deleted successfully", data);
            fetchCarts(); // Refresh cart items after deletion
        } catch (error) {
            console.error("Error:", error);
        }
    }
</script>