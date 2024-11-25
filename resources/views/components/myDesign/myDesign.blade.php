<?php
// Load translations from the JSON file only once
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

<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="container my-design mb-4">
    <div class="border p-4">
        <h4><?php echo translate('uploaded_designs', $lang, $translations); ?></h4>
        <div class="d-md-flex gap-3 justify-content-between align-items-center">
            <p class="pt-2">
                <?php echo translate('design_description', $lang, $translations); ?>
            </p>
            <button type="button" class="btn custom-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <?php echo translate('upload_new_design', $lang, $translations); ?>
            </button>
        </div>

        <!-- preview content -->

        <div class="row mt-4">
            <div class="col-md-2"><?php echo translate('tag_section', $lang, $translations); ?></div>
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo translate('preview', $lang, $translations); ?></th>
                            <th scope="col"><?php echo translate('design_name', $lang, $translations); ?></th>
                            <th scope="col"><?php echo translate('design_tags', $lang, $translations); ?></th>
                        </tr>
                    </thead>
                    <tbody id="designTr">

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <!-- upload design from my design -->
        <div class="modal addess-modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">
                            <?php echo translate('upload_design', $lang, $translations); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6 col-12">
                                <label for="addressTitle"
                                    class="form-label"><?php echo translate('upload_your_design', $lang, $translations); ?></label>
                                <input type="file" id="actual-btn" hidden accept="image/*" />
                                <button id="custom-button"
                                    class="w-100 border file-upload-custom-button"><?php echo translate('choose_file', $lang, $translations); ?></button>
                                <span id="file-chosen"></span>
                            </div>
                        </div>
                        <hr>

                        <!-- Before upload -->
                        <div id="before-upload" class="upload-image">
                            <img class="img-fluid" src="images/design1.png" alt="">
                            <h6 class="text-center pt-4">
                                <?php echo translate('upload_instructions', $lang, $translations); ?>
                            </h6>
                        </div>


                        <!-- After upload -->
                        <div id="after-upload" class="design-section mt-4" style="display: none;">
                            <h6> <?php echo translate('design_preview', $lang, $translations); ?></h6>
                            <div class="design-preview border p-3 mb-3">
                                <img id="design-image" src="#" alt="Design preview" class="img-fluid">
                            </div>

                            <h6><?php echo translate('design_information', $lang, $translations); ?></h6>
                            <div class="mb-3">
                                <label for="designTitle"
                                    class="form-label"><?php echo translate('design_title', $lang, $translations); ?></label>
                                <input type="text" class="form-control py-2" id="designTitle"
                                    placeholder="<?php echo translate('design_title_placeholder', $lang, $translations); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="designTags"
                                    class="form-label"><?php echo translate('design_tags', $lang, $translations); ?></label>
                                <textarea class="form-control"
                                    placeholder="<?php echo translate('design_tags_placeholder', $lang, $translations); ?>"
                                    id="designTags" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- clear button -->
                        <button type="button" class="btn btn-danger rounded-pill" id="clear-button0"
                            style="padding: 6px 18px">
                            <?php echo translate('design_clear', $lang, $translations); ?>


                        </button>
                        <!-- close button -->
                        <button type="button" id="uploadNewDesign00Close" class="btn custom-button rounded-pill" data-bs-dismiss="modal">
                            <?php echo translate('design_close', $lang, $translations); ?>

                        </button>
                        <button type="submit" class="btn custom-button rounded-pill" id="saveDesign"><?php echo translate('save', $lang, $translations); ?></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        const fetchDesigns = async () => {
            try {
                const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage

                const response = await fetch('/api/getAllDesign', {
                    method: 'GET',
                    headers: {
                        'Authorization': `bearer ${token}`, // Replace with your actual token
                        'Content-Type': 'application/json'
                    }
                });



                if (response.ok) {
                    const data = await response.json();
                    const designs = data.Design;
                    console.log("desings", designs);
                    // console.log(JSON.parse(products[2].images));


                    designsCards = designs.map(product => {
                            let image = "https://smartprintsa.com" + product.image;
                            // let image = "https://smartprintsa.com" + product.image;

                            console.log("22", product.image);

                            return ` <tr class="border">
                            <th scope="row">
                                <div class="design-table-preview">
                                    <img src=${image} alt="Design preview"
                                        class="img-fluid border">
                                </div>
                            </th>
                            <td>${product.title}
                                <span id="showingTitle0"></span>

                            </td>
                            <td>
                            ${product.tags}
                                <span id="showingTitle0"></span>
                              
                            </td>
                        </tr>`
                        })
                        .join('');

                } else {
                    console.error('Failed to fetch products', response.statusText);
                }
                const combinedContent = designsCards;
                let designTr = document.getElementById("designTr")
                designTr.innerHTML = combinedContent;

            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }
        fetchDesigns();

        // const actualBtn = document.getElementById('actual-btn');
        // const customBtn = document.getElementById('custom-button');
        // const fileChosen = document.getElementById('file-chosen');
        // const beforeUpload = document.getElementById('before-upload');
        // const afterUpload = document.getElementById('after-upload');
        // const designImage = document.getElementById('design-image');

        // customBtn.addEventListener('click', function() {
        //     actualBtn.click();
        // });

        // actualBtn.addEventListener('change', function() {
        //     if (this.files && this.files[0]) {
        //         const file = this.files[0];
        //         fileChosen.textContent = file.name;

        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             designImage.src = e.target.result;
        //             beforeUpload.style.display = 'none';
        //             afterUpload.style.display = 'block';
        //         };
        //         reader.readAsDataURL(file);
        //     } else {
        //         fileChosen.textContent = '';
        //         beforeUpload.style.display = 'block';
        //         afterUpload.style.display = 'none';
        //     }
        // });

        // Optional: Add functionality to the Save button


        //  modal design post api calling

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
            console.log("user99", user_id);

            console.log("00000000000000000000000000000000000000000000000000000000000000000000000000000000000");
            e.preventDefault();
            const uploadFormData = new FormData();
            uploadFormData.append('title', designTitle.value);
            uploadFormData.append('tags', designTags.value);
            uploadFormData.append('image', file);
            uploadFormData.append('user_id', user_id.id);

            const addNewDesign = async () => {
                const token = localStorage.getItem('jwt_token');
                console.log(token);

                if (!token) {
                    console.error('Token not found');
                    window.alert("1. You are not logged in")
                    // const modal = new bootstrap.Modal('#failAddToCart00')
                    // modal.show();
                    return;
                }

                try {
                    const response = await fetch("/api/design", {
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
                        document.getElementById("uploadNewDesign00Close").click(); // closing the modal
                        window.alert("2. Design Successfully added")
                        clearButton.click(); // clearing the fields
                        document.getElementById("designTitle").innerHTML = Design.title;
                        document.getElementById("designTags").innerHTML = Design.tags;
                        document.getElementById("design-image").innerHTML =
                            `<img src="https://smartprintsa.com${Design.image}" style="width:100%;height:100%;object-fit: contain;object-position: center;"/>`;
                        fetchDesigns()

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




        // calling Get design api
    </script>

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

</section>