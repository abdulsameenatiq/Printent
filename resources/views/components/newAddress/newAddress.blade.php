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


<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;
 padding: 15px;"
  class="container address">
  <!-- Button trigger modal -->
  <button type="button" class="btn custom-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <?= translate('Add New Address', $lang, $translations) ?>
  </button>

  <!-- Modal -->
  <div class="modal addess-modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">
            <?= translate('New Address', $lang, $translations) ?>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addressForm">
            <div class="row">
              <!-- Address Title -->
              <div class="mb-3 col-md-6 col-12">
                <label for="addressTitle" class="form-label"><?= translate('Address Title', $lang, $translations) ?>:</label>
                <input type="text" placeholder="<?= translate('eg. Work, Home, Client address, etc.', $lang, $translations) ?>" class="form-control py-2" id="addressTitle" />
                <span id="addressTitleError" class="text-danger"></span>
              </div>

              <!-- Address Type -->
              <div class="mb-3 col-md-6 col-12">
                <label for="addressType" class="form-label"><?= translate('Address Type', $lang, $translations) ?>:</label>
                <select class="form-control py-2" id="addressType" aria-label="Default select example">
                  <option selected value=""><?= translate('Open this select menu', $lang, $translations) ?></option>
                  <option value="1">House</option>
                  <option value="2">Apartment</option>
                  <option value="3">Commercial Building</option>
                </select>
                <span id="addressTypeError" class="text-danger"></span>
              </div>

              <!-- Contact Person Name -->
              <div class="mb-3 col-md-4 col-12">
                <label for="personName" class="form-label"><?= translate('Contact Person Name', $lang, $translations) ?>:</label>
                <input type="text" class="form-control py-2" id="personName" />
                <span id="personNameError" class="text-danger"></span>
              </div>

              <!-- Mobile Number -->
              <div class="mb-3 col-md-4 col-12">
                <label for="mobileNumber" class="form-label"><?= translate('Mobile Number', $lang, $translations) ?>:</label>
                <input type="tel" placeholder="<?= translate('eg. 9678 5XX XXX XXX', $lang, $translations) ?>" class="form-control py-2" id="mobileNumber" />
                <span id="mobileNumberError" class="text-danger"></span>
              </div>

              <!-- Email -->
              <div class="mb-3 col-md-4 col-12">
                <label for="email" class="form-label"><?= translate('Email', $lang, $translations) ?>:</label>
                <input type="email" placeholder="<?= translate('eg. mailto:example@example.com', $lang, $translations) ?>" class="form-control py-2" id="email" />
                <span id="emailError" class="text-danger"></span>
              </div>

              <!-- Country -->

              <div class="mb-3 col-md-4 col-12">
                <label for="country" class="form-label"><?= translate('Country', $lang, $translations) ?>:</label>
                <select class="form-control py-2" id="country" aria-label="Default select example">
                  <option selected value=""><?= translate('Select Country', $lang, $translations) ?></option>
                  <!-- <option value="1">Kingdom of Saudi Arabia</option> -->
                  <option value="Kingdom of Saudi Arabia">Kingdom of Saudi Arabia</option>


                </select>
                <span id="countryError" class="text-danger"></span>

              </div>

              <!-- City -->

              <div class="mb-3 col-md-4 col-12">
                <label for="city" class="form-label"><?= translate('City', $lang, $translations) ?>:</label>
                <select class="form-control py-2" id="city" aria-label="Default select example">
                  <option selected value=""><?= translate('Select City', $lang, $translations) ?></option>

                </select>
                <span id="cityError" class="text-danger"></span>

              </div>

              <!-- Location -->

              <div class="mb-3 col-md-4 col-12">
                <label for="location" class="form-label"><?= translate('Location', $lang, $translations) ?>:</label>

                <input type="text" class="form-control py-2" id="location" />

                <span id="locationError" class="text-danger"></span>

              </div>

              <!-- Street -->

              <div class="mb-3 col-12">
                <label for="street" class="form-label"><?= translate('Street', $lang, $translations) ?>:</label>
                <input type="text" class="form-control py-2" id="street" />
                <span id="streetError" class="text-danger"></span>


              </div>

              <!-- Postal code -->

              <div class="mb-3 col-md-4 col-12">
                <label for="postalCode"
                  class="form-label"><?= translate('Postal Code', $lang, $translations) ?>:</label>
                <input type="number" class="form-control py-2" id="postalCode" />
                <span id="postalCodeError" class="text-danger"></span>

              </div>

              <!--  Additional Code-->

              <div class="mb-3 col-md-4 col-12">
                <label for="additionalCode"
                  class="form-label"><?= translate('Additional Code', $lang, $translations) ?>:</label>
                <input type="number" class="form-control py-2" id="additionalCode" />
                <span id="addtionalCodeError" class="text-danger"></span>

              </div>

              <!-- Building Name-->

              <div class="mb-3 col-md-4 col-12">
                <label for="buildingName"
                  class="form-label"><?= translate('Building Name', $lang, $translations) ?>:</label>
                <input type="text" class="form-control py-2" id="buildingName" />
                <span id="buildingNameError" class="text-danger"></span>

              </div>

              <!-- Building Number -->

              <div class="mb-3 col-md-4 col-12">
                <label for="building" class="form-label"><?= translate('Building #', $lang, $translations) ?></label>
                <input type="text" class="form-control py-2" id="building" />
                <span id="buildingError" class="text-danger"></span>

              </div>

              <!-- Floor -->

              <div class="mb-3 col-md-4 col-12">
                <label for="floor" class="form-label"><?= translate('Floor #', $lang, $translations) ?></label>
                <input type="text" class="form-control py-2" id="floor" />
                <span id="floorError" class="text-danger"></span>

              </div>

              <!-- unit -->

              <div class="mb-3 col-md-4 col-12">
                <label for="unit" class="form-label"><?= translate('Unit #', $lang, $translations) ?></label>
                <input type="text" class="form-control py-2" id="unit" />
                <span id="unitError" class="text-danger"></span>

              </div>

              <!-- Notes -->

              <div class="mb-3 col-12">
                <label for="note" class="form-label"><?= translate('Notes (Optional)', $lang, $translations) ?>:</label>
                <textarea class="form-control" placeholder="<?= translate('e.g Sixth floor, second office, ring the bell', $lang, $translations) ?>" id="note" rows="3"></textarea>
                <span id="notesError" class="text-danger"></span>

              </div>

              <div class="col-12 modal-footer mb-0 pb-0 border-0">
                <button id="submitBtn" type="submit" class="btn custom-button save-address">
                  <?= translate('Save Address', $lang, $translations) ?>
                </button>
              </div>
            </div>
          </form>
          <div id="formSuccess" style="display:none; color: green;"><?= translate('Form submitted successfully!', $lang, $translations); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- /gpt script -->

<!-- <script src="../../../../cities.json" type="application/json"></script> -->
<script>
  // dropdown functionality
  // Your JSON data for cities
  const cityData = {
    "Kingdom of Saudi Arabia": [
      "Medina", "Jeddah", "Abha", "Riyadh", "Dammam", "Taif", "Dhahran", "Al khobar",
      "Yanbu", "Hail", "Jubail", "Al Hofuf", "Tabuk", "Khamis Mushait", "Buraydah",
      "Hafar Al-Batin", "Al Baha", "Sakaka", "Najran", "Khafji", "Bisha", "Al Qurayyat",
      "Al Kharj", "Arar", "Al Jouf", "Gizan", "Wadi Al Dawasir", "Dawadmi", "Majmah",
      "Makkah", "Aflaj", "Unayzah", "Al Hassa", "Al Qunfudhah", "Online City"
    ],
  };

  document.addEventListener('DOMContentLoaded', function() {
    const countryDropdown = document.getElementById('country');
    const cityDropdown = document.getElementById('city');

    // Function to update city dropdown based on selected country
    function updateCityDropdown() {
      const selectedCountry = countryDropdown.value;

      // Clear existing city options
      cityDropdown.innerHTML = '<option selected value="">Select City</option>';

      // Populate city dropdown based on the selected country
      if (cityData[selectedCountry]) {
        cityData[selectedCountry].forEach(city => {
          const option = document.createElement('option');
          option.value = city;
          option.textContent = city;
          cityDropdown.appendChild(option);
        });
      }
    }

    // Add event listener to country dropdown
    countryDropdown.addEventListener('change', updateCityDropdown);
  });



  // form logic

  document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById('addressForm');
    const formSuccess = document.getElementById('formSuccess');

    // Access form elements
    const addressTitle = document.getElementById('addressTitle');
    const addressType = document.getElementById('addressType');
    const personName = document.getElementById('personName');
    const mobileNumber = document.getElementById('mobileNumber');
    const email = document.getElementById('email');
    const country = document.getElementById('country');

    const city = document.getElementById('city');
    const location = document.getElementById('location');
    const street = document.getElementById('street');
    const postalCode = document.getElementById('postalCode');

    const additionalCode = document.getElementById('additionalCode');
    const buildingName = document.getElementById('buildingName');
    const building = document.getElementById('building');
    const floor = document.getElementById('floor');
    const unit = document.getElementById('unit');
    const note = document.getElementById('note');



    const submitBtn = document.getElementById('submitBtn');




    form.addEventListener('submit', async (event) => {

      event.preventDefault();

      try {
        console.log("validator", validateForm());

        clearErrors(); // Clear previous error messages

        if (!validateForm()) return; // Stop submission if form is invalid

        // if(country === "Kingdom of Saudi Arabia") {

        // }
        // else{

        // }




        const formData = new FormData();
        formData.append("address_title", addressTitle.value);
        formData.append("address_type", addressType.value);
        formData.append("contact_person_name", personName.value);
        formData.append("mobile_number", mobileNumber.value);
        formData.append("email", email.value);
        formData.append("country", country.value);

        formData.append("city", city.value);
        formData.append("location", location.value);
        formData.append("street", street.value);
        formData.append("postal_code", postalCode.value);

        formData.append("additional_code", additionalCode.value);
        formData.append("building_name", buildingName.value);
        formData.append("building_no", building.value);
        formData.append("floor_no", floor.value);
        formData.append("unit_no", unit.value);
        formData.append("notes", note.value);
        console.log("token here");
        const token = await localStorage.getItem('jwt_token');

        const response = await fetch('https://smartprintsa.com/api/addAddress', {
          method: "POST",
          body: formData,
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });

        const data = await response.json();

        if (response.ok) {
          formSuccess.innerText = '<?= translate('Form submitted successfully!', $lang, $translations); ?>';
          formSuccess.style.display = 'block';
          clearForm();
        } else {
          formSuccess.innerText = '<?= translate('Failed to submit the form. Please try again.', $lang, $translations); ?>';
          formSuccess.style.display = 'block';
        }
      } catch (error) {
        console.error("Error:", error);
        formSuccess.innerText = '<?= translate('An error occurred. Please try again later.', $lang, $translations); ?>';
        formSuccess.style.display = 'block';
      }
    });

    function validateForm() {
      let valid = true;

      if (addressTitle.value.trim() === "") {
        showError('addressTitleError', 'Address Title is required');
        valid = false;
      }

      if (addressType.value === "") {
        showError('addressTypeError', 'Address Type is required');
        valid = false;
      }

      if (personName.value.trim() === "") {
        showError('personNameError', 'Contact Person Name is required');
        valid = false;
      }

      if (!validateEmail()) valid = false;
      if (!validateMobile()) valid = false;

      if (country.value === "") {
        showError('countryError', 'Country Name is required');
        valid = false;
      }

      if (city.value === "") {
        showError('cityError', 'City Name is required');
        valid = false;
      }

      if (location.value === "") {
        showError('locationError', 'Location Name is required');
        valid = false;
      }

      if (street.value.trim() === "") {
        showError('streetError', 'Street Name is required');
        valid = false;
      }

      if (postalCode.value.trim() === "") {
        showError('postalCodeError', 'Postal Code is required');
        valid = false;
      }

      if (additionalCode.value.trim() === "") {
        showError('addtionalCodeError', 'Additional Code is required');
        valid = false;
      }

      if (buildingName.value.trim() === "") {
        showError('buildingNameError', 'Building Name is required');
        valid = false;
      }

      if (building.value.trim() === "") {
        showError('buildingError', 'Building # is required');
        valid = false;
      }

      if (floor.value.trim() === "") {
        showError('floorError', 'Floor # is required');
        valid = false;
      }

      if (unit.value.trim() === "") {
        showError('unitError', 'Unit # is required');
        valid = false;
      }

      if (note.value.trim() === "") {
        showError('notesError', 'Notes are required');
        valid = false;
      }



      return valid;
    }

    function validateEmail() {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email.value.trim() === "" || !emailPattern.test(email.value)) {
        showError('emailError', 'Please enter valid email');
        return false;
      }
      return true
    }

    function validateMobile() {
      const mobilePattern = /^(\+?\d{1,3}?)?\d{7,}$/;
      if (mobileNumber.value.trim() === "" || !mobilePattern.test(mobileNumber.value)) {
        showError('mobileNumberError', 'Please Enter valid Mobile Number');
        return false;
      }
      return true;
    }

    function clearErrors() {
      const errorElements = document.querySelectorAll('.text-danger');
      errorElements.forEach(el => el.innerText = '');
    }

    function showError(elementId, message) {
      document.getElementById(elementId).innerText = message;
    }

    function clearForm() {
      addressTitle.value = "";
      addressType.value = "";
      personName.value = "";
      mobileNumber.value = "";
      email.value = "";
      country.value = "";
      city.value = "";
      location.value = "";
      street.value = "";
      postalCode.value = "";
      additionalCode.value = "";
      buildingName.value = "";
      building.value = "";
      floor.value = "";
      unit.value = "";
      note.value = "";
    }

  });
</script>