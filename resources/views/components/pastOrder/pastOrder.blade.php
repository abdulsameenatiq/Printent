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
  class="container mb-4">
  <div class="border p-4">
    <h3><?php echo translate("Your current orders", $lang, $translations); ?></h3>

    <table class="table border">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo translate("Product Name", $lang, $translations); ?></th>
          <th scope="col"><?php echo translate("Product Image", $lang, $translations); ?></th>
          <th scope="col"><?php echo translate("Price", $lang, $translations); ?></th>
          <th scope="col"><?php echo translate("Status", $lang, $translations); ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>T-Shirt</td>
          <td><img src="https://picsum.photos/200/300" style="width:40px; height:30px" alt="Design preview"
              class="img-fluid border">
          </td>
          <td>$500</td>
          <td><span class="badge bg-success">
              <?php echo translate("Delivered", $lang, $translations); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>T-Shirt</td>
          <td><img src="https://picsum.photos/200/300" style="width:40px; height:30px" alt="Design preview"
              class="img-fluid border">
          </td>
          <td>$500</td>
          <td><span class="badge bg-warning text-dark">
              <?php echo translate("Pending", $lang, $translations); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>T-Shirt</td>
          <td><img src="https://picsum.photos/200/300" style="width:40px; height:30px" alt="Design preview"
              class="img-fluid border">
          </td>
          <td>$500</td>
          <td><span class="badge bg-danger">
              <?php echo translate("Cancelled", $lang, $translations); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>T-Shirt</td>
          <td><img src="https://picsum.photos/200/300" style="width:40px; height:30px" alt="Design preview"
              class="img-fluid border">
          </td>
          <td>$500</td>
          <td><span class="badge bg-danger">
              <?php echo translate("Cancelled", $lang, $translations); ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>