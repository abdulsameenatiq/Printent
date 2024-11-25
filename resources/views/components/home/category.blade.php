<!DOCTYPE html>
<html lang="en">

<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_categoryslide($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<head>
    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

    <style>
        html,
        body {
            /* position: relative; */
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: flex;
            justify-content: center;
            background-color: ellow;
        } */

        .slider_div {
            text-align: center;
            /* position: relative; */
            overflow: hidden;
            /* background-color: red; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slider_img_div {
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-color: blue; */
        }

        .img_contain_div {
            /* 
            width: 100%;
            height: 100%; */
            /* background-color: green; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;


        }

        h6 {
            /* margin: 10px 0; */
        }

        .main_section_category {
            padding: 20px;
        }

        .swiper-pagination-bullet {
            background-color: #000 !important;
        }

        /* 
        .category_name {
            overflow: hidden;
            background-color: red;

        } */
    </style>
</head>

<body>

    <section class="main_section_category">
        <div class="main_category">
            <h1 class="main_category_heading1_h1"> <?php echo translate('category_heading1', $lang, $translations); ?></h1>
            <h3 class="main_category_heading1_h3"><?php echo translate('category_heading2', $lang, $translations); ?></h3>

            <!-- 
            <h1 class="main_category_heading1_h1">Want to explore by category?</h1>
            <h3 class="main_category_heading1_h3">Find Exactly What You Need, Category by Category</h3> -->
        </div>

        <!-- Swiper container -->
        <swiper-container class="mySwiper" free-mode="true" space-between="30" autoplay="true" pagination="true">
            <!-- Dynamically generated slides will go here -->
        </swiper-container>
        <!-- 
        <div class="main_category_btn_div">
            <a href="/products">

                <button class="main_category_btn">Browse all categories</button>
            </a>
        </div> -->
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- JavaScript -->
    <script>
        // Function to add categories to the Swiper
        function addCategoriesToSwiper(categories) {
            const swiperEl = document.querySelector('.mySwiper');

            categories.forEach(category => {
                // Default image if not available
                const imageUrl = category.image || 'default.jpg';

                const slideHTML = `
                    <swiper-slide>
                        <div class="slider_div">
                        <div class="img_contain_div">
                             <a href="/category/${category.id}">
                                <div class="slider_img_div">
                                    <img src="${imageUrl}" alt="${category.name || 'Unnamed Category'}">
                                </div>
                                </a>
                                <h6 class="category_name">${category.name || 'Category'}</h6>
                        </div>
                        </div>
                    </swiper-slide>
                `;
                swiperEl.innerHTML += slideHTML;
            });

            // Initialize Swiper (make sure slides are visible and autoplay works)
            Object.assign(swiperEl, {
                spaceBetween: 30,
                slidesPerView: 3, // Adjust this based on how many slides you want to show
                autoplay: {
                    delay: 3000, // Change the delay time (in ms) for autoplay
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                freeMode: true,
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 30,
                    }
                }
            });

            swiperEl.initialize();
        }

        // Renamed function to avoid duplicate declaration issues
        async function loadCategories() {
            try {
                const response = await fetch('https://smartprintsa.com/api/getAllCategories');
                if (!response.ok) {
                    throw new Error('Failed to fetch categories');
                }

                const data = await response.json();
                console.log("API Categories:", data.categories); // Adjust according to the actual API response

                // Pass the categories to the swiper slider
                addCategoriesToSwiper(data.categories || []);

            } catch (error) {
                console.error("Error:", error);
            }
        }

        // Call loadCategories when the page loads
        document.addEventListener("DOMContentLoaded", loadCategories);
    </script>

</body>

</html>