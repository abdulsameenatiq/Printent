<!-- header start -->

<style>
    .login_link {
        /* display: flex;
              gap: 2px; */
        color: #fd814e;

        /* color: black; */
    }

    /* Ensure the span remains inline */
    .dropdown_login {
        position: relative;
        display: inline-block;
        background-color: rd;
    }

    /* Initially hide the dropdown menu */
    .dropdown_content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 120px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        padding: 8px;
        border-radius: 4px;
        top: 20px;
        right: 0px;
    }

    /* Style the dropdown links */
    .dropdown_content a {
        color: black;
        padding: 8px 16px;
        text-decoration: none;
        display: block;
    }

    /* Hover effect for the dropdown links */
    .dropdown_content a:hover {
        background-color: #f1f1f1;
    }

    /* Show the dropdown on hover (optional) */
    .dropdown:hover .dropdown_content {
        display: block;
        width: 390px;
        height: 400px;
        padding-left: 5px;
        padding-right: 5px;
        overflow-y: auto;
    }

    .sub-dropdown {
        display: flex;
        flex-direction: column;
    }

    .category_link:hover {
        color: #fd814e;
        cursor: pointer;
    }

    .mega-menu-link {
        pointer-events: auto !important;
        /* Force to enable pointer events */
    }


    /* online services CSS */


    /* Main service dropdown */
    .dropdown-service {
        position: relative;
        /* Customize background or color for main dropdown */
        /* background-color: #f0f0f0; */
        /* background-color: yellow; */
        padding: 8px;
    }

    .dropdown-service-link {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    .dropdown-service-link:hover {
        color: #ff6600;

        /* Change text color on hover */
    }

    /* Sub-services wrapper */
    .sub-services-wrapper {
        display: none;
        /* Hide subcategories initially */
        position: absolute;
        right: 107%;
        /* Position it relative to the main category */
        top: 30%;
        width: 600px;
        background-color: #fff;
        z-index: 1000;
        padding: 10px;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        /* background-color: pink; */
    }

    /* Show subcategories on hover */
    .dropdown-service:hover .sub-services-wrapper {
        display: flex;
    }

    /* Subcategory heading */
    .sub-category-heading {
        font-size: 14px;
        margin-bottom: 10px;
        color: #0056b3;
        /* Customize subcategory heading color */
        font-weight: bold;

    }

    /* Sub-items list */
    .sub-items-list {
        list-style: none;
        padding: 0;
        margin: 0;
        /* background-color: red; */

    }

    /* Sub-items */
    .sub-item {
        margin-bottom: 10px;
        /* background-color: green; */

    }

    .sub-item-link {
        text-decoration: none;
        color: #555;
        /* Customize link color */
        padding: 5px;
        display: block;
        /* background-color: #e9e9e9; */
        /* background-color: yellow; */
        /* Customize background color for each sub-item */
        border-radius: 4px;
    }

    .sub-item-link:hover {
        /* background-color: #dcdcdc; */
        /* Background color on hover */
        color: #ff6600;
        /* Text color on hover */
    }





    /* For click functionality, use JavaScript below */
</style>
<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>


<header id="masthead"
    style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="header prt-header-style-01">
    <!-- topbar -->
    <div class="top_bar prt-topbar-wrapper text-base-white clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-row align-items-start justify-content-start">
                        <div class="top_bar_contact_item">
                            <img width="16" height="18" class="img-fluid" src="images/top-bar-img.png" alt="image">
                            <!-- Free shipping on all orders $50+ -->
                            <?php echo translate('header_text', $lang, $translations); ?>
                        </div>
                        <div class="top_bar_contact_item_button">
                            <a class="prt-btn" href="#">
                                <!-- Shop Now! -->
                                <?php echo translate('shop_now', $lang, $translations); ?>
                            </a>
                        </div>
                        <div class="top_bar_contact_item ms-auto">
                            <ul>
                                <!-- <li>Any Questions</li> -->
                                <li data-translate="any_questions">
                                    <?php echo translate('any_questions', $lang, $translations); ?>
                                </li>
                                <li class="prt-img">
                                    <img width="22" height="22" class="img-fluid" src="images/whatsup-icon.png"
                                        alt="image">
                                </li>
                                <li class="prt-number">
                                    <a href="https://api.whatsapp.com/send?phone=966550746600&amp;text=Hi Smart Printing, I want to know about..." target="_blank">+966 55 074 6600
</a>
                                </li>
                                <!-- language toggle button -->
                                <li class="prt-language">
                                    <div id="language-switcher"
                                        style="background-color: ed; cursor: pointer; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 18px;">
                                        <?php echo $lang == 'en' ? 'عربى' : 'English'; ?>
                                        <span id="switch-language-text">
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- topbar end -->
    <!-- site-header-menu -->
    <div id="site-header-menu" class="site-header-menu">
        <div class="site-header-menu-inner ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--site-navigation -->
                        <div class="site-navigation d-flex align-items-center justify-content-between">
                            <!-- site-branding -->
                            <div class="site-branding me-auto">
                                <h1>
                                    <a class="home-link" href="/" title="Printing" rel="home">
                                        <img id="logo-img" height="45" width="183" class="img-fluid auto_size"
                                            src="images/newLogo.svg" alt="logo-img">
                                    </a>
                                </h1>
                            </div><!-- site-branding end -->
                            <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                <span class="menubar-box">
                                    <span class="menubar-inner"></span>
                                </span>
                            </div>
                            <!-- menu -->
                            <nav class="main-menu menu-mobile" id="menu">
                                <ul style="background-color:ed;" class="menu slide-menu ">
                                    <li class="mega-menu-item megamenu-fw active">
                                        <a class=""
                                            href="/"><?php echo translate('home', $lang, $translations); ?></a>
                                        <!-- <ul class="mega-submenu megamenu-home mega-submenu-home-pages"
                                                  role="menu">
                                                  <li>
                                                      <div class="row">
                                                          <div class="col-menu col-xl-4 col-lg-12">
                                                              <div class="content">
                                                                  <ul class="menu-col menu-col-img">
                                                                      <li>
                                                                          <a href="index-2.html">
                                                                              <img width="207" height="235"
                                                                                  class="img-fluid"
                                                                                  src="images/bg-megamenu-home-1.jpg"
                                                                                  alt="bimg">
                                                                              <h3 class="title">Home-01</h3>
                                                                          </a>
                                                                      </li>
                                                                  </ul>
                                                              </div>
                                                          </div>
                                                          <div class="col-menu col-xl-4 col-lg-12">
                                                              <div class="content">
                                                                  <ul class="menu-col-img">
                                                                      <li>
                                                                          <a href="homepage-2.html">
                                                                              <img class="img-fluid"
                                                                                  src="images/bg-megamenu-home-2.jpg"
                                                                                  alt="bimg">
                                                                              <h3 class="title">Home-02</h3>
                                                                          </a>
                                                                      </li>
                                                                  </ul>
                                                              </div>
                                                          </div>
                                                          <div class="col-menu col-xl-4 col-lg-12">
                                                              <div class="content">
                                                                  <ul class="menu-col-img">
                                                                      <li>
                                                                          <a href="homepage-3.html">
                                                                              <img class="img-fluid"
                                                                                  src="images/bg-megamenu-home-3.jpg"
                                                                                  alt="bimg">
                                                                              <h3 class="title">Home-03</h3>
                                                                          </a>

                                                                      </li>
                                                                  </ul>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </li>
                                              </ul> -->
                                    </li>
                                    <li class="mega-menu-item megamenu-fw">
                                        <a href="/products" class=""><?php echo translate('products', $lang, $translations); ?></a>

                                    </li>
                                    <li class="mega-menu-item">
                                        <a
                                            class="mega-menu-link"><?php echo translate('categories', $lang, $translations); ?></a>
                                        <ul class="mega-submenu megamenu-content megamenu-content-services" role="menu">
                                            <li style="width: 210.5px">
                                                <div class="row">
                                                    <div class="col-menu col-xl-12 col-lg-12">
                                                        <div class="content">
                                                            <ul class="menu-col" id="categoriesWrapper0">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <script>
                                        const fetchCategories = async () => {
                                            try {
                                                const response = await fetch('https://smartprintsa.com/api/getAllCategories', {
                                                    method: 'GET',
                                                });

                                                if (response.ok) {
                                                    const data = await response.json();
                                                    const categories = data.categories;

                                                    const navbar = document.getElementById('categoriesWrapper0');
                                                    const categoryLinks = categories.map(category => {
                                                        let subcategoryLinks = '';
                                                        let subcategoryImageLinks = '';
                                                        if (category.subcategories.length > 0) {
                                                            subcategoryLinks = category.subcategories.map(subcategory => {
                                                                subcategoryImageLinks = "https://smartprintsa.com" + subcategory.image
                                                                return `<li style="padding:1px;" class="sub-dropdown">
                                                                 <img src="${subcategoryImageLinks}" height="60px"><a href="/category/${subcategory.id}" style="color: #555">${subcategory.name}</a></li>`
                                                            }).join('');
                                                        }

                                                        return `
                                                         <li class="dropdown" style="display: flex; align-items: center; justify-content: space-between; ">
                                                              <a href="/category/${category.id}" class="category_link">
                                                              <img src="https://smartprintsa.com${category.image}" height="20px">
                                                              ${category.name}</a>

                                                              ${subcategoryLinks ? '<span><i class="fa fa-angle-right category_link" style="color: #555; padding-right: 5px"></i></span>' : ''}
                                                             ${subcategoryLinks ? `<ul class="dropdown_content">
                                                            
                                                             ${subcategoryLinks}
                                                             
                                                             </ul>` : ''}
                                                                 </li>
                                                                 `;
                                                    }).join('');

                                                    navbar.innerHTML = `<ul>${categoryLinks}</ul>`;

                                                } else {
                                                    console.error('Failed to fetch categories', response.statusText);
                                                }
                                            } catch (error) {
                                                console.error('Error fetching categories:', error);
                                            }
                                        }
                                        fetchCategories();

                                        window.onload = function() {
                                            const languageSwitcher = document.getElementById("switch-language-text");

                                            // Get the current language from localStorage, default to 'en' if not set
                                            const savedLang = localStorage.getItem('lang') || 'en';

                                            // Get the current URL
                                            const currentURL = window.location.href;

                                            // Check if the URL already has the 'lang' parameter
                                            const urlParams = new URLSearchParams(window.location.search);
                                            const urlLang = urlParams.get('lang');

                                            // If the URL doesn't have a lang parameter, or it's different from saved language, update the URL
                                            if (!urlLang || urlLang !== savedLang) {
                                                urlParams.set('lang', savedLang);
                                                window.location.search = urlParams.toString();
                                            } else {
                                                // Update the switcher text based on the current language
                                                languageSwitcher.innerHTML = savedLang === 'en' ? 'عربى' : 'English';


                                                console.log("test");
                                            }
                                        };

                                        // Function to handle language switching
                                        function switchLanguage() {
                                            const currentLang = localStorage.getItem('lang') || 'en';
                                            const newLang = currentLang === 'en' ? 'ar' : 'en';

                                            // Store the selected language in localStorage
                                            localStorage.setItem('lang', newLang);

                                            // Update the URL with the selected language
                                            const urlParams = new URLSearchParams(window.location.search);
                                            urlParams.set('lang', newLang);
                                            window.location.search = urlParams.toString();
                                        }

                                        // Attach the switchLanguage function to the language switcher div
                                        document.getElementById("language-switcher").onclick = switchLanguage;
                                    </script>


                                    <li class="mega-menu-item megamenu-fw">
                                        <!-- <a href="#" class="mega-menu-link">Portfolio</a> -->
                                        <a class=""
                                            href="/track-order"><?php echo translate('track_order', $lang, $translations); ?></a>

                                    </li>
                                    <li class="mega-menu-item">
                                        <!-- <a href="#" class="mega-menu-link">Blog</a> -->
                                        <a class="" href="/get-qoute">
                                            <?php echo translate('get_quote', $lang, $translations); ?>
                                        </a>

                                    </li>
                                    <li class="mega-menu-item ">
                                        <!-- <a href="#" class="mega-menu-link">Contact Us</a> -->
                                        <a href="/enquiry">
                                            <?php echo translate('direct_order', $lang, $translations); ?>
                                        </a>

                                    </li>

                                    <!-- online services elements -->

                                    <li class="mega-menu-item">


                                        <a href="" class="mega-menu-link">
                                            <?php echo translate('online_services', $lang, $translations); ?>

                                        </a>
                                        <ul style="width: 250px;  background-color: ed;" class="mega-submenu megamenu-content megamenu-content-services" role="menu">
                                            <li style="background-color: ellow;">
                                                <div class="row">
                                                    <div class="col-menu col-xl-12 col-lg-12">
                                                        <div class="content">
                                                            <ul class="mega-menu" id="servicesWrapper">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>


                                    <!-- <button>
                                              Login
                                          </button> -->
                                    {{-- <a href="/login" class="login_link" id="loginButton">
                                        <span><i class="fa-regular fa-user"></i></span>
                                        Login
                                    </a> --}}
                                    <li class="mega-menu-item" id="loginButton">
                                        <a href="/login" class="mega-menu-link"><span><i
                                                    class="fa-regular fa-user fa-xs"
                                                    style="margin-right: 5px"></i></span>
                                            <?php echo translate('login_heading', $lang, $translations); ?>

                                        </a>

                                    </li>


                                    {{-- <li class="mega-menu-item" id="profileButto" style="color: white">
                                        <a href="/login" class="mega-menu-link"><span><i
                                                    class="fa-regular fa-user fa-xs"
                                                    style="margin-right: 5px"></i></span>Profile</a>
                                        <ul class="mega-submenu megamenu-content megamenu-content-services" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-xl-12 col-lg-12">
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                <li><a href="/personal-profile">Profile</a></li>
                                                                <li id="logoutButton"><a href="">Logout</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> --}}


                                    <span class="dropdown_login">
                                        <div class="login_link" id="profileButton">
                                            <span><i class="fa-regular fa-user"></i></span>
                                            Profile
                                        </div>
                                        <div class="dropdown_content_login">
                                            <a href="/personal-profile">
                                                <?php echo translate('profile', $lang, $translations); ?>
                                            </a>
                                            <a href="/" id="logoutButton">
                                                <?php echo translate('logout', $lang, $translations); ?>
                                            </a>
                                        </div>
                                    </span>
                                </ul>
                            </nav><!-- menu end -->
                            <!-- header_extra -->
                            <div class="header_extra">
                                <!-- <div class="header_search">
                                          <a href="#" class="btn-default search_btn"><i
                                                  class="ti ti-search"></i></a>
                                          <div class="header_search_content">
                                              <form id="searchbox" method="get" action="#">
                                                  <input class="search_query" type="text" id="search_query_top"
                                                      name="s" placeholder="Search" value="">
                                                  <button type="submit" class="btn close-search"><i
                                                          class="ti ti-search"></i></button>
                                              </form>
                                          </div>
                                      </div> -->

                                <div class="header_cart" id="cartIcon">
                                    <a href="/cart" class="button-cart">
                                        <div class="cart_icon"><i class="ti ti-shopping-cart"></i></div>
                                        <div class="cart_count" id="cart_count00">0</div>
                                    </a>
                                </div>

                                <script>
                                    const fetchCartNoOfItems = async () => {
                                        const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage
                                        //   console.log("test token", token);

                                        //   conditionally showing the login button


                                        const loginButton = document.getElementById("loginButton");
                                        if (token) {
                                            loginButton.style.display = "none";
                                            profileButton.style.display = "inline-block";

                                        } else {
                                            loginButton.style.display = "inline-block";
                                            profileButton.style.display = "none";

                                        }

                                        const cartIcon = document.getElementById("cartIcon");
                                        if (token) {
                                            cartIcon.style.display = "inline-block";
                                        } else {
                                            cartIcon.style.display = "none";
                                        }

                                        document.getElementById("logoutButton").addEventListener("click", function(event) {
                                            event.preventDefault(); //prevent the default link behavior
                                            localStorage.removeItem("jwt_token"); //remove toktn from local storage
                                            localStorage.removeItem("user_details"); //remove userdetails from local storage
                                            localStorage.removeItem('product'); // Remove the product
                                            window.location.href = '/'; // Or your logout URL

                                        })
                                        const username = JSON.parse(localStorage.getItem("user_details"));
                                        //   console.log("testing user details", username.name);
                                        if (token && username && username.name) {
                                            const profileButton = document.getElementById("profileButton");
                                            profileButton.innerHTML = `<span><i class="fa-regular fa-user"></i></span> ${username.name}`;
                                        } else {
                                            // console.log("No user details found");
                                        }



                                        if (!token) {
                                            console.error('Token not found');
                                            return;
                                        }

                                        try {
                                            const response = await fetch('/api/getCart', {
                                                method: 'GET',
                                                headers: {
                                                    'Authorization': `bearer ${token}`,
                                                    'Content-Type': 'application/json'
                                                }
                                            });

                                            if (response.ok) {
                                                const data = await response.json();
                                                const CartItems = data.carts;
                                                //   console.log(CartItems);


                                                const ItemsLength = document.getElementById('cart_count00');
                                                ItemsLength.innerHTML = CartItems.length;
                                            } else {
                                                console.error('Failed to fetch cart no of items', response.statusText);
                                            }
                                        } catch (error) {
                                            console.error('Error fetching cart no of items:', error);
                                        }
                                    };

                                    fetchCartNoOfItems();
                                </script>

                                <!-- set language function -->

                                <script>
                                    function setLanguage(lang) {
                                        const test = localStorage.setItem('lang', lang);
                                        console.log("test", test);
                                        //   location.reload();
                                    }

                                    function toggleLanguage() {
                                        const currentLang = localStorage.getItem('lang') || 'en';
                                        const newLang = currentLang === 'en' ? 'ar' : 'en';
                                        setLanguage(newLang);
                                    }

                                    window.onload = function() {
                                        const lang = localStorage.getItem('lang') || 'en';
                                        if (!window.location.search.includes(`lang=${lang}`)) {
                                            window.location.search = `?lang=${lang}`;
                                        }
                                    }

                                    //   window.onload = function() {
                                    //       // Get the language from localStorage or default to 'en'
                                    //       const savedLang = localStorage.getItem('lang') || 'en';

                                    //       // Check if the URL already has a 'lang' parameter
                                    //       const urlParams = new URLSearchParams(window.location.search);
                                    //       const urlLang = urlParams.get('lang');

                                    //       // If the URL doesn't have a lang parameter, or it's different from the saved language, update the URL
                                    //       if (!urlLang || urlLang !== savedLang) {
                                    //           urlParams.set('lang', savedLang);
                                    //           window.location.search = urlParams.toString();
                                    //       }
                                    //   };

                                    //   // Function to handle language switching
                                    //   function switchLanguage(selectedLang) {
                                    //       // Store the selected language in localStorage
                                    //       localStorage.setItem('lang', selectedLang);

                                    //       // Update the URL to include the selected language
                                    //       const urlParams = new URLSearchParams(window.location.search);
                                    //       urlParams.set('lang', selectedLang);
                                    //       window.location.search = urlParams.toString();
                                    //   }
                                </script>

                            </div><!-- header_extra end -->
                        </div><!-- site-navigation end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- site-header-menu end-->
</header><!-- header end -->

<script>
    const servicesWrapper = document.getElementById('servicesWrapper');

    const jsonData = {
        "Digital Advertising": {
            "SEARCH ENGINE OPTIMIZATION (SEO)": [
                "Local SEO",
                "E-Commerce SEO"
            ],
            "SOCIAL MEDIA ADVERTISING": [
                "Facebook advertising",
                "Instagram advertising",
                "Google advertising",
                "Youtube advertising",
                "Twitter advertising",
                "Linkedin advertising"
            ],
            "GOOGLE ADS: SEARCH ENGINE ADVERTISING": [
                "Google Performance Max Ads",
                "Google Search Ads",
                "Google Display Ads",
                "Google Shopping Ads",
                "Google Local Search Ads"
            ]
        },
        "Websites Development": {
            "WEBSITE DEVELOPMENT": [
                "Standard Website",
                "Dynamic Website",
                "E-Commerce Website",
                "Mobile App"
            ]
        },
        "NFC Products": {
            "NFC Products": [
                "Digital business card"
            ]
        },

        "Graphic Design": {
            "": []
        },
    };

    // Loop through the JSON data and build the HTML structure
    const servicesHTML = Object.keys(jsonData).map(service => {
        // Create the main service heading (e.g., "Digital Advertising")
        let subServices = '';

        // Only create sub-dropdown if there are subcategories
        if (Object.keys(jsonData[service]).length > 0) {
            Object.keys(jsonData[service]).forEach(subCategory => {

                // Build list items for each subcategory
                const subItems = jsonData[service][subCategory].map(item => {
                    // Pass the item text dynamically when clicked
                    return `
                <li class="sub-item">
                    <a href="/get-qoute/${item}" class="sub-item-link">${item}</a>
                </li>`;
                }).join('');

                // Add subcategory with its items (e.g., "SEARCH ENGINE OPTIMIZATION (SEO)" and "Local SEO")
                subServices += `
            <div class="col-lg-4 col-sm-12 sub-service-category">
                <h4 class="sub-category-heading">${subCategory}</h4>
                <ul class="sub-items-list">${subItems}</ul>
            </div>`;
            });
        }

        // Return the main dropdown (visible on hover)
        return `
        <li class="dropdown-service">
            <a href="#" class="dropdown-service-link">${service}</a>
            ${subServices ? `<div class="row sub-services-wrapper">${subServices}</div>` : ''}
        </li>`;
    }).join('');

    servicesWrapper.innerHTML = servicesHTML;
</script>