<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_detailuploadDesign($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>


<div
    style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="modal addess-modal fade" id="uploadNewDesign00" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    <?php echo translate('upload_design', $lang, $translations); ?>

                </h5>
                <button type="button" id="uploadNewDesign00Close" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <label for="addressTitle" class="form-label">
                            <?php echo translate('upload_your_design', $lang, $translations); ?>

                        </label>
                        <input type="file" id="actual-btn" hidden accept="image/*" />
                        <button id="custom-button" class="w-100 border file-upload-custom-button" type="button">
                            <?php echo translate('choose_file', $lang, $translations); ?>

                        </button>
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
                    <h6>
                        <?php echo translate('design_preview', $lang, $translations); ?>

                    </h6>
                    <div class="design-preview border p-3 mb-3">
                        <img id="design-image" src="#" alt="Design preview" class="img-fluid">
                    </div>

                    <h6>
                        <?php echo translate('design_information', $lang, $translations); ?>

                    </h6>
                    <div class="mb-3">
                        <label for="designTitle" class="form-label">
                            <?php echo translate('design_title', $lang, $translations); ?>

                        </label>
                        <input type="text" class="form-control py-2" id="designTitle"
                            placeholder="<?php echo translate('design_title_placeholder', $lang, $translations); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="designTags" class="form-label">
                            <?php echo translate('design_tags', $lang, $translations); ?>

                        </label>
                        <textarea class="form-control" required
                            placeholder=" <?php echo translate('design_tags_placeholder', $lang, $translations); ?>"
                            id="designTags"
                            rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded-pill" id="clear-button0"
                    style="padding: 6px 18px">
                    <?php echo translate('clear', $lang, $translations); ?>

                </button>
                <button type="submit" class="btn custom-button rounded-pill" id="saveDesign">
                    <?php echo translate('save', $lang, $translations); ?>

                </button>
            </div>
        </form>
    </div>
</div>

<script>

</script>