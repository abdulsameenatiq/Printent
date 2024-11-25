 <!--Language translator functionality  -->
 <?php

    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

    // Load translations from the JSON file
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);

    function translate_marqee($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
    }
    ?>

 <section style="background-color: red;" class="prt-row marque-section bg-base-skin clearfix">
     <div class="row">
         <div class="container-fluid">
             <!-- slick_slider -->
             <div class="slick_slider_ltr marque-box"
                 data-slick='{"slidesToShow": 7, "slidesToScroll": 1, "arrows":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1200,"settings":{"slidesToShow": 5}}, {"breakpoint":1024,"settings":{"slidesToShow": 4}}, {"breakpoint":777,"settings":{"slidesToShow": 3}},{"breakpoint":575,"settings":{"slidesToShow": 2}},{"breakpoint":380,"settings":{"slidesToShow": 1}}]}'>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_long_running', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_final_results', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_quick_printing', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_quick_printing', $lang, $translations); ?>

                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_quick_printing', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_final_results', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_quick_printing', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
                 <div class="prt-marquee-box-wrapper">
                     <div class="prt-marquee-box-content">
                         <div class="prt-box-title">
                             <h3>
                                 <?php echo translate('marqee_offset_printing', $lang, $translations); ?>
                             </h3>
                         </div>
                     </div>
                 </div>
             </div><!-- prt-client end -->
         </div>
     </div>
 </section>