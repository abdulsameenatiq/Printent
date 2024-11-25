 <!--Language translator functionality  -->
 <?php

    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

    // Load translations from the JSON file
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);

    function translate_home_slider($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
    }
    ?>

 <!-- START decfoxSlider 1 REVOLUTION SLIDER 6.5.9 -->
 <div class="prt-rev_slider-wide">
     <!-- START homemainclassicslider REVOLUTION SLIDER 6.1.8 -->
     <rs-module-wrap id="rev_slider_1_1_wrapper" data-alias="classic-mainslider" data-source="gallery">

         <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.8">

             <rs-slides>

                 <rs-slide data-key="rs-1" data-title="Slide" data-thumb="images/slides/slider-main-01.jpg"
                     data-anim="ei:d;eo:d;s:d;r:0;t:grayscalecross;sl:d;">

                     <img src="images/slides/slider-main-01.jpg" alt="image" title="slider-bg001" width="1920"
                         height="600" class="rev-slidebg" data-no-retina>

                     <!-- 1st slide -->
                     <rs-layer id="slider-1-slide-1-layer-0" data-type="text" data-rsp_ch="on"
                         data-xy="x:r,r,c,c;xo:23px,23px,0,0;y:m,m,m,t;yo:-80px,-80px,-120px,80px;"
                         data-text="w:normal;s:66,66,50,35;l:95,95,75,50;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:150;sp:800;sR:150;" data-frame_999="o:0;st:w;sR:8050;"
                         style="z-index:9;font-family:'Lora';">
                         <?php echo translate('slide_1_heading_part_1', $lang, $translations); ?>

                     </rs-layer>

                     <rs-layer id="slider-2-slide-2-layer-1" data-type="text" data-rsp_ch="on"
                         data-xy="x:r,r,c,c;xo:23px,23px,0,0;yo:336px,336px,129px,126px;"
                         data-text="w:normal;s:108,108,80,55;l:150,150,110,70;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:320;sp:800;sR:320;" data-frame_999="o:0;st:w;sR:7880;"
                         style="z-index:10;font-family:'Lora';">
                         <?php echo translate('slide_1_heading_part_2', $lang, $translations); ?>
                         <span class="text-base-skin">
                             <?php echo translate('slide_1_heading_part_3', $lang, $translations); ?>
                         </span>
                     </rs-layer>

                     <rs-layer id="slider-1-slide-1-layer-2" data-type="text" data-rsp_ch="on"
                         data-xy="x:c;xo:53px,53px,-120px,-122px;y:m,m,t,t;yo:25px,25px,172px,-9px;"
                         data-text="w:normal;s:71,71,50,50;l:81,81,60,50;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:500;sp:800;sR:500;" data-frame_999="o:0;st:w;sR:7700;"
                         style="z-index:13;font-family:'Lora';">
                     </rs-layer>

                     <rs-layer id="slider-1-slide-1-layer-3" data-type="text" data-rsp_ch="on"
                         data-xy="x:r;xo:24px,24px,-187px,8px;y:m;yo:164px,164px,32px,70px;"
                         data-text="w:normal;s:39,39,22,13;l:46,46,25,15;" data-vbility="t,t,f,f"
                         data-frame_0="y:50,50,28,17;" data-frame_1="st:540;sp:800;sR:540;"
                         data-frame_999="o:0;st:w;sR:7660;" style="z-index:11;font-family:'Lora';">2845+
                     </rs-layer>

                     <rs-layer id="slider-1-slide-1-layer-4" data-type="text" data-color="rgba(255, 255, 255, 0.7)"
                         data-rsp_ch="on" data-xy="x:r;xo:24px,24px,-193px,8px;y:m;yo:202px,202px,88px,84px;"
                         data-text="w:normal;s:16,16,9,5;l:26,26,14,8;" data-vbility="t,t,f,f"
                         data-frame_0="y:50,50,28,17;" data-frame_1="st:540;sp:800;sR:540;"
                         data-frame_999="o:0;st:w;sR:7660;" style="z-index:12;font-family:'Poppins';">
                         <?php echo translate('slide_1_satisfied_clients', $lang, $translations); ?>

                     </rs-layer>

                     <rs-layer id="slider-1-slide-1-layer-5" data-type="shape" data-rsp_ch="on"
                         data-xy="x:r;xo:187px,187px,107px,66px;y:m;yo:187px,187px,107px,86px;"
                         data-text="w:normal;s:20,20,11,6;l:0,0,13,8;" data-dim="w:1px;h:128px,128px,73px,45px;"
                         data-vbility="t,t,f,f" data-frame_0="y:50,50,28,17;" data-frame_1="st:800;sp:800;sR:800;"
                         data-frame_999="o:0;st:w;sR:7400;" style="z-index:14;background-color:rgba(255,255,255,0.32);">
                     </rs-layer>

                     <rs-layer id="slider-1-slide-1-layer-6" data-type="text" data-rsp_ch="on"
                         data-xy="x:r;xo:233px,233px,-238px,81px;y:m;yo:152px,152px,-13px,72px;"
                         data-text="w:normal;s:15,15,8,4;l:26,26,14,8;a:right;" data-vbility="t,t,f,f"
                         data-frame_0="y:50,50,28,17;" data-frame_1="st:600;sp:800;sR:600;"
                         data-frame_999="o:0;st:w;sR:7600;" style="z-index:15;font-family:'Poppins';">
                         <?php echo translate('slide_1_description-1', $lang, $translations); ?>
                         <br>
                         <?php echo translate('slide_1_description-2', $lang, $translations); ?>

                     </rs-layer>

                    

                     <rs-layer id="slider-1-slide-1-layer-8" data-type="shape" data-rsp_ch="on"
                         data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:t,t,m,m;yo:50px,50px,0,0;"
                         data-text="w:normal;s:20,20,11,6;l:0,0,13,8;"
                         data-dim="w:300px,300px,1000px,616px;h:180px,180px,800px,493px;" data-vbility="f,f,t,t"
                         data-frame_999="o:0;st:w;sR:8700;" style="z-index:7;background-color:rgba(0,0,0,0.5);">
                     </rs-layer>
                 </rs-slide>

                 <!-- 2nd slide -->


                 <rs-slide data-key="rs-2" data-title="Slide" data-thumb="images/slides/slider-main-02.jpg"
                     data-anim="ei:d;eo:d;s:d;r:0;t:grayscalecross;sl:d;">

                     <img src="images/slides/slider-main-02.jpg" alt="image" title="slider-bg002" width="1920"
                         height="785" class="rev-slidebg" data-no-retina>

                     <rs-layer id="slider-1-slide-2-layer-0" data-type="text" data-rsp_ch="on"
                         data-xy="x:l,l,c,c;xo:21px,21px,0,0;y:m,m,m,t;yo:-60px,-60px,-89px,66px;"
                         data-text="w:normal;s:66,66,50,35;l:95,95,75,50;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:150;sp:800;sR:150;" data-frame_999="o:0;st:w;sR:8050;"
                         style="z-index:9;font-family:'Lora';">

                         <?php echo translate('slide_2_heading_part_1', $lang, $translations); ?>

                     </rs-layer>

                     <rs-layer id="slider-1-slide-2-layer-1" data-type="text" data-rsp_ch="on"
                         data-xy="x:l,l,c,c;xo:20px,20px,0,0;yo:356px,356px,150px,112px;"
                         data-text="w:normal;s:108,108,80,55;l:150,150,110,70;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:320;sp:800;sR:320;" data-frame_999="o:0;st:w;sR:7880;"
                         style="z-index:10;font-family:'Lora';"><span class="text-base-skin">
                             <?php echo translate('slide_2_heading_part_2', $lang, $translations); ?>

                         </span>
                     </rs-layer>

                     <rs-layer id="slider-1-slide-2-layer-2" data-type="text" data-rsp_ch="on"
                         data-xy="x:c;xo:53px,53px,-120px,-122px;y:m,m,t,t;yo:25px,25px,172px,-23px;"
                         data-text="w:normal;s:71,71,50,50;l:81,81,60,50;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:500;sp:800;sR:500;" data-frame_999="o:0;st:w;sR:7700;"
                         style="z-index:13;font-family:'Lora';">
                     </rs-layer>

                     <rs-layer id="slider-1-slide-2-layer-3" data-type="shape" data-rsp_ch="on"
                         data-xy="xo:444px,444px,255px,66px;y:m;yo:185px,185px,106px,72px;"
                         data-text="w:normal;s:20,20,11,6;l:0,0,13,8;" data-dim="w:1px;h:100px,100px,56px,34px;"
                         data-vbility="t,t,f,f" data-frame_0="y:50,50,28,17;" data-frame_1="st:800;sp:800;sR:800;"
                         data-frame_999="o:0;st:w;sR:7400;"
                         style="z-index:14;background-color:rgba(255,255,255,0.32);">
                     </rs-layer>

                     <rs-layer id="slider-1-slide-2-layer-4" data-type="text" data-rsp_ch="on"
                         data-xy="xo:24px,24px,-238px,81px;y:m;yo:180px,180px,-13px,58px;"
                         data-text="w:normal;s:15,15,8,4;l:26,26,14,8;" data-vbility="t,t,f,f"
                         data-frame_0="y:50,50,28,17;" data-frame_1="st:600;sp:800;sR:600;"
                         data-frame_999="o:0;st:w;sR:7600;" style="z-index:15;font-family:'Poppins';">
                         <?php echo translate('slide_2_description-1', $lang, $translations); ?>
                         <br>
                         <?php echo translate('slide_2_description-2', $lang, $translations); ?>
                         <br>
                         <?php echo translate('slide_2_description-3', $lang, $translations); ?>

                     </rs-layer>

                     <a id="slider-1-slide-2-layer-5" class="rs-layer" href="business-card-design.html"
                         target="_self" data-type="text" data-rsp_ch="on"
                         data-xy="x:l,l,c,c;xo:484px,484px,0,0;y:m;yo:185px,185px,83px,54px;"
                         data-text="w:normal;s:15;l:23,23,25,20;fw:600;"
                         data-padding="t:12,12,10,10;r:30,30,30,25;b:12,12,10,10;l:30,30,30,25;"
                         data-border="bor:50px,50px,50px,50px;" data-frame_0="y:50,50,28,17;"
                         data-frame_1="st:850;sp:800;sR:850;" data-frame_999="o:0;st:w;sR:7350;"
                         data-frame_hover="bgc:linear-gradient(90deg, rgba(255,101,104,1) 0%, rgba(252,148,60,1) 100%);bor:50px,50px,50px,50px;"
                         style="z-index:16;background:linear-gradient(90deg, rgba(252,148,60,1) 0%, rgba(255,101,104,1) 100%);font-family:'Lora';">
                         <?php echo translate('slide_2_button', $lang, $translations); ?>

                     </a>

                     <rs-layer id="slider-1-slide-2-layer-6" data-type="shape" data-rsp_ch="on"
                         data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:t,t,m,m;yo:50px,50px,0,-14px;"
                         data-text="w:normal;s:20,20,11,6;l:0,0,13,8;"
                         data-dim="w:300px,300px,1000px,616px;h:180px,180px,800px,493px;" data-vbility="f,f,t,t"
                         data-frame_999="o:0;st:w;sR:8700;" style="z-index:7;background-color:rgba(0,0,0,0.5);">
                     </rs-layer>
                 </rs-slide>
             </rs-slides>
             <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
         </rs-module>

     </rs-module-wrap>
     <!-- END REVOLUTION SLIDER -->
 </div>
 <!-- END REVOLUTION SLIDER -->