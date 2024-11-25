<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translatefailedcart($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<div style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="modal fade" id="failAddToCart00" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?php echo translate('cart_authentication', $lang, $translations); ?>

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo translate('cart_failed', $lang, $translations); ?>

                <?php echo translate('cart_please', $lang, $translations); ?>


                <span style="color: red">
                    <?php echo translate('login_btn', $lang, $translations); ?>

                </span>
                <?php echo translate('cart_continue', $lang, $translations); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <?php echo translate('save', $lang, $translations); ?>

                </button>
                <a href="/login"><button type="button" class="btn"
                        style="background: linear-gradient(to right, #fc953b, #ff6469);color:white"
                        data-bs-dismiss="modal">
                        <?php echo translate('login_btn', $lang, $translations); ?>

                    </button></a>
            </div>
        </div>
    </div>
</div>