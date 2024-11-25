<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translateartwork($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>


<div style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="detail-cart mt-5">
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm" style="height:100%">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">
                                    <?php echo translate('addcart_quantity', $lang, $translations); ?>

                                </label>
                                <select class="form-select py-2" name="DataTables_Table">
                                    <option selected>10</option>
                                    <option>30</option>
                                    <option>40</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                                {{-- <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="custom">
                                    <label class="form-check-label" for="custom">
                                        Custom
                                    </label>
                                </div> --}}
                            </div>
                            <div class="col-md-6">
                                <label style="font-weight: 500">
                                    <?php echo translate('addcart_selcted_design', $lang, $translations); ?>

                                </label>
                                <div>
                                    <span>
                                        <?php echo translate('addcart_title', $lang, $translations); ?>

                                    </span><span id="showingTitle0"></span>
                                </div>
                                <div>
                                    <span>
                                        <?php echo translate('addcart_tags', $lang, $translations); ?>

                                    </span><span id="showingTags0"></span>
                                </div>
                                <div style="display: flex; gap: 10px">
                                    <span>
                                        <?php echo translate('addcart_image', $lang, $translations); ?>

                                    </span>
                                    <div id="showingImage0" style="height: 125px;width: 150px"></div>
                                </div>
                            </div>

                        </div>
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Urgency</th>
                                    <th>Price</th>
                                    <th>Production day(s)</th>
                                    <th>Delivery day(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="urgency" checked>
                                        </div>
                                    </td>
                                    <td>Regular</td>
                                    <td>516.90</td>
                                    <td>2 working day(s)</td>
                                    <td>01</td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p><strong>
                                <!-- <?php echo translate('addcart_before_discount', $lang, $translations); ?> -->


                                <!-- </strong> <span class="float-end">449.48</span></p> -->
                                <p><strong>
                                        <?php echo translate('addcart_total_discount', $lang, $translations); ?>


                                    </strong> <span class="float-end" id="Price01">0</span></p>
                                <p><strong>
                                        <?php echo translate('addcart_total_tax', $lang, $translations); ?>


                                    </strong> <span class="float-end" id="Price02">0</span></p>
                                <p><strong>
                                        <?php echo translate('addcart_price', $lang, $translations); ?>


                                    </strong> <span class="float-end" id="Price03">0</span></p>
                                <button class="btn w-100 mt-3 add-to-cart" id="AddToCartFinalButton00">
                                    <?php echo translate('addcart_btn', $lang, $translations); ?>


                                </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    let productString = localStorage.getItem("product")
    let product = JSON.parse(productString);


    let getValue = 10;
    let getPrize = product.price
    const getPrice = product.price * 10
    var nameField = document.getElementById('Price01');
    nameField.innerHTML = getPrice.toFixed(2);

    const salesTaxRate = 0.15 * getPrice
    var taxField = document.getElementById('Price02');
    taxField.innerHTML = salesTaxRate

    const totalPrice = getPrice + salesTaxRate;
    var nameField = document.getElementById('Price03');
    nameField.innerHTML = totalPrice.toFixed(2);


    document.querySelector("[name='DataTables_Table']").addEventListener('change', function () {

        if (this.value == 10) {
            var nameField = document.getElementById('Price01');
            var price = product.price * 10
            nameField.innerHTML = price

            var taxField = document.getElementById('Price02');
            taxField.innerHTML = (product.price * 10) * 0.15

            var nameField = document.getElementById('Price03');
            var totalPrice = (product.price * 10) * 0.15 + product.price * 10
            nameField.innerHTML = totalPrice
        }
        if (this.value == 30) {
            var nameField = document.getElementById('Price01');
            var price = product.price * 30
            nameField.innerHTML = price

            var taxField = document.getElementById('Price02');
            taxField.innerHTML = (product.price * 30) * 0.15

            var nameField = document.getElementById('Price03');
            var totalPrice = (product.price *30) * 0.15 + product.price * 30
            nameField.innerHTML = totalPrice
        }
        if (this.value == 40) {
            var nameField = document.getElementById('Price01');
            var price = product.price * 40
            nameField.innerHTML = price

            var taxField = document.getElementById('Price02');
            taxField.innerHTML = (product.price * 40) * 0.15

            var nameField = document.getElementById('Price03');
            var totalPrice = (product.price * 40) * 0.15 + product.price * 40
            nameField.innerHTML = totalPrice

        }
        if (this.value == 50) {
            var nameField = document.getElementById('Price01');
            var price = product.price * 50
            nameField.innerHTML = price

            var taxField = document.getElementById('Price02');
            taxField.innerHTML = (product.price * 50) * 0.15

            var nameField = document.getElementById('Price03');
            var totalPrice = (product.price * 50) * 0.15 + product.price * 50
            nameField.innerHTML = totalPrice

        }
        if (this.value == 100) {
            var nameField = document.getElementById('Price01');
            var price = product.price * 100
            nameField.innerHTML = price

            var taxField = document.getElementById('Price02');
            taxField.innerHTML = (product.price * 100) * 0.15

            var nameField = document.getElementById('Price03');
            var totalPrice = (product.price * 100) * 0.15 + product.price * 100
            nameField.innerHTML = totalPrice

        }
        getValue = this.value
        getPrize = totalPrice.toFixed(2)
    });

    // Add to cart API call
    document.getElementById("AddToCartFinalButton00").onclick = function () {

        // get data from localStorage
        let design = localStorage.getItem("design_uploaded")
        let productString = localStorage.getItem("product")
        let product = JSON.parse(productString);

        const bodyJson = JSON.stringify({
            "product_id": product.id,
            "quantity": getValue,
            "design_id": design,
            "side": product.side,
            "size": product.size,
            "total_price": getPrize,
            "unit_price": product.price,
            "note": "Added",
            "days": 23
        });

        const addToCartApiCall = async () => {
            const token = localStorage.getItem('jwt_token');
            if (!token) {
                console.error('Token not found');
                window.alert("1. You are not logged in")
                return;
            }
            try {
                const response = await fetch("/api/cart", {
                    method: "POST",
                    body: bodyJson,
                    headers: {
                        'Authorization': `bearer ${token}`,
                        'Content-Type': 'application/json'
                    },
                    redirect: "follow"
                })

                if (response.ok) {
                    const data = await response.json();

                    console.log(data.cart.product_id, " " + "Successfully added to cart");
                    window.alert("Successfully added to cart")

                } else {
                    console.error('Failed to add to cart', response.statusText);
                    window.alert('Failed to add to cart');
                }

            } catch (error) {
                console.error('Failed to add to cart:', error);
            }
        }
        addToCartApiCall();

    }
</script>