@extends('components.layout.layout')

@section('title', 'Smart')
@section('meta_description', 'Smart')
@section('meta_keywords', 'Smart')

@section('content')

<body>
    <div class="page">
        @include('components.home.navbar')
        @include('components.productDetail.detailHeader')
        <!-- page-title -->
        {{-- <button onclick="output()">print</button> --}}
        <div class="site-main">
            @include('components.productDetail.detailCarousel')
            @include('components.artWork.artWork')
            <div style="height: 20px"></div>
        </div>
        @include('components.home.footer')
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>

    <script>
        // %%%%%%%%%%%%%%%%%%%%%%%% specification dropdown fields %%%%%%%%%%%%%%%%%%%%%%%%
        const size = document.getElementById("size").value;
        const side = document.getElementById("side").value;
        const selectedMaterial = document.getElementById("material").value;

        function output() {
            console.log("Size: ", size.value);
            console.log("Side: ", side.value);
            console.log("Selected Material: ", selectedMaterial.value);
        }

        // %%%%%%%%%%%%%%%%%%%%%%%% upload design modal %%%%%%%%%%%%%%%%%%%%%%%%
        let file = null;
        const actualBtn = document.getElementById('actual-btn');
        const customBtn = document.getElementById('custom-button');
        const fileChosen = document.getElementById('file-chosen');
        const beforeUpload = document.getElementById('before-upload');
        const afterUpload = document.getElementById('after-upload');
        const designImage = document.getElementById('design-image');
        const clearButton = document.getElementById("clear-button0")
        const designTitle = document.getElementById("designTitle")
        const designTags = document.getElementById("designTags")
        customBtn.addEventListener('click', function() {
            actualBtn.click();
        });
        actualBtn.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                file = this.files[0];
                fileChosen.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    designImage.src = e.target.result;
                    beforeUpload.style.display = 'none';
                    afterUpload.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileChosen.textContent = '';
                beforeUpload.style.display = 'block';
                afterUpload.style.display = 'none';
            }
        });
        clearButton.addEventListener('click', function() {
            file = null;
            fileChosen.textContent = '';
            beforeUpload.style.display = 'block';
            afterUpload.style.display = 'none';
            designTitle.value = "";
            designTags.value = "";
        })
        document.getElementById('saveDesign').addEventListener('click', function(e) {
            const user_id = JSON.parse(localStorage.getItem("user_details"));
            e.preventDefault();
            const uploadFormData = new FormData();
            uploadFormData.append('title', designTitle.value);
            uploadFormData.append('tags', designTags.value);
            uploadFormData.append('image', file);
            uploadFormData.append('user_id', user_id.id);

            const addNewDesign = async () => {
                const token = localStorage.getItem('jwt_token');
                if (!token) {
                    console.error('Token not found');
                    window.alert("1. You are not logged in")
                    // const modal = new bootstrap.Modal('#failAddToCart00')
                    // modal.show();
                    return;
                }

                try {
                    const response = await fetch("https://smartprintsa.com/api/design", {
                        method: "POST",
                        body: uploadFormData,
                        headers: {
                            'Authorization': `bearer ${token}`,
                        },
                        redirect: "follow"
                    })

                    if (response.ok) {
                        const data = await response.json();
                        const Design = data.Design;
                        localStorage.setItem("design_uploaded", JSON.stringify(Design.id))
                        console.log("Success", Design.id);
                        clearButton.click(); // clearing the fields
                        document.getElementById("uploadNewDesign00Close").click(); // closing the modal
                        window.alert("2. Design Successfully added")
                        document.getElementById("showingTitle0").innerHTML = Design.title;
                        document.getElementById("showingTags0").innerHTML = Design.tags;
                        document.getElementById("showingImage0").innerHTML =
                            `<img src="https://smartprintsa.com${Design.image}" style="width:100%;height:100%;object-fit: contain;object-position: center;"/>`;

                    } else {
                        console.error('Failed to add the Design', response);
                        window.alert('3. Failed to add the Design');
                        // const modal = new bootstrap.Modal('#failAddToCart00')
                        // modal.show();
                    }

                } catch (error) {
                    console.error('Error fetching add the Design:', error);
                }
            }
            addNewDesign();
        });

        // %%%%%%%%%%%%%%%%%%%%%%%% Add To Cart Functionality %%%%%%%%%%%%%%%%%%%%%%%%
        const quantity = document.getElementById("quantity").value;
        const addToCartButton = document.getElementById("AddToCartFinalButton00");
        const pidURL = window.location.href.split("/")
        const productId = parseInt(pidURL[pidURL.length - 1]);

        addToCartButton.addEventListener('click', function() {
            // console.log("Clicked Add To Cart");
            const uploadedDesignId = localStorage.getItem('design_uploaded');
            if (!uploadedDesignId) {
                console.error('No Item Uploaded');
                window.alert("Add a design first")
                // const modal = new bootstrap.Modal('#failAddToCart00')
                // modal.show();
                return;
            }

            const bodyJson = JSON.stringify({
                "product_id": productId,
                "quantity": quantity,
                "design_id": uploadedDesignId
            });

            const addToCartApiCall = async () => {
                const token = localStorage.getItem('jwt_token');
                if (!token) {
                    console.error('Token not found');
                    window.alert("1. You are not logged in")
                    // const modal = new bootstrap.Modal('#failAddToCart00')
                    // modal.show();
                    return;
                }

                try {
                    const response = await fetch("https://smartprintsa.com/api/cart", {
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
                        // const modal = new bootstrap.Modal('#failAddToCart00')
                        // modal.show();
                    }

                } catch (error) {
                    console.error('Failed to add to cart:', error);
                }
            }
            addToCartApiCall();

        })
    </script>


    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery-waypoints.js"></script>
    <script src="js/numinate.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/jquery-isotope.js"></script>
    <script src="js/jquery.twentytwenty.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/main.js"></script>
</body>
@endsection