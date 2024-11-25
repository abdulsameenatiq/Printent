<!DOCTYPE html>
<html lang="en">

<?php


session_start();
$user = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_personal_form($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./build/css/demo.css" rel="stylesheet">
    <!-- <link href="./build/css/intlTelInput.css" rel="stylesheet"> -->
    <title>Personal Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    .main_profile {
        padding-top: 80px;
        padding-bottom: 20px;
        padding-right: 50px;
        padding-left: 50px;
        position: relative;
    }

    @media (max-width: 768px) {
        .main_profile {
            padding-right: 20px;
            padding-left: 20px;
        }
    }

    .language-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        /* background-color: red; */
    }

    .language-toggle button {
        padding: 10px 20px;
        /* background-color: rgb(92, 113, 144); */
        color: rgb(255, 255, 255);
        background-color: #3276b1;
        border: none;
        border-radius: 15px;
        padding-bottom: 10px;
        margin: px;
        cursor: pointer;
    }

    /* .language-toggle button:hover {
    background-color: #e0761f; 
} */
    /* Add RTL direction when Arabic is active */
    .arabic {
        direction: rtl;
        text-align: right;
    }

    .profile_container {
        width: 100%;
        margin-top: 80px;
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        /* background-color: red; */

        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }




    h2 {
        font-size: 24px;
        color: #d35400;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        width: 48%;
        margin-right: 15px;
        margin-bottom: 20px;
    }

    label {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    input,
    select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        width: 100%;
    }

    input[disabled] {
        background-color: #f0f2f5;
    }


    .arabic th,
    .arabic td {
        /* direction: rtl; */
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 14px;
    }


    .arabic th {
        background-color: #e9ecef;
    }



    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    @media (max-width: 768px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
            width: 100%;
        }

        thead {
            display: none;
        }

        tr {
            margin-bottom: 15px;
        }

        td {
            text-align: right;
            position: relative;
            padding-left: 50%;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            width: 45%;
            padding-right: 10px;
            text-align: left;
            font-weight: bold;
        }

        .arabic td::before {
            text-align: right;
        }

    }


    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .form-group {
            width: 100%;
        }
    }

    input[type="file"] {
        font-size: 14px;
        padding: 10px;
    }

    .save-btn {
        background: linear-gradient(90deg, #d35400, #e67e22);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        align-self: flex-end;
        margin-top: 1px;
    }

    .save-btn:hover {
        background: linear-gradient(90deg, #e67e22, #d35400);
        transform: scale(1.05);
    }


    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #b3b3b3;
        padding: 10px;
        text-align: center;
        font-size: 14px;
        background-color: #ffffff;
    }

    th {
        background-color: #e9ecef;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    tr.middle-row {
        border-bottom: 2px solid #333;
    }

    hr {
        border: none;
        height: 1px;
        background-color: #ddd;
        margin: 50px 0;
    }

    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-wrapper input {
        padding-right: 30px;
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        user-select: none;
    }

    .icon {
        margin-left: 5px;
        color: #003369;
    }

    td:last-child {
        text-align: center;
    }

    .change-password-btn {
        background: linear-gradient(90deg, #d35400, #e67e22);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        align-self: flex-end;
        margin-top: 1px;
        display: block;
        margin-left: auto;
    }

    .change-password-btn:hover {
        background: linear-gradient(90deg, #e67e22, #d35400);
        transform: scale(1.05);
    }
</style>

<body>
    <div style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
        class="main_profile">


        <!-- <div class="language-toggle ">
            <button id="toggle-language" class="" onclick="toggleLanguage()">العربية</button>
        </div> -->

        <div class="profile_container">
            <h2 class="english">
                <?php echo translate('personal_profile_form', $lang, $translations); ?>

            </h2>
            <!-- <h2 class="arabic" style="display:none;">الملف الشخصي</h2> -->

            <form id="infoForm">
                <div class="row">
                    <div class="form-group">
                        <label for="title" class="english">
                            <?php echo translate('form_title', $lang, $translations); ?>

                        </label>
                        <!-- <label for="title" class="arabic" style="display:none;">اللقب</label> -->
                        <select id="title" name="title">
                            <option class="english">
                                <?php echo translate('dropdown_mr', $lang, $translations); ?>


                            </option>
                            <option class="english">
                                <?php echo translate('dropdown_mrs', $lang, $translations); ?>


                            </option>
                            <option class="english">
                                <?php echo translate('dropdown_dr', $lang, $translations); ?>


                            </option>
                            <!-- <option class="arabic" style="display:none;">السيد</option> -->
                            <!-- <option class="arabic" style="display:none;">السيدة</option> -->
                            <!-- <option class="arabic" style="display:none;">الدكتور</option> -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="firstName" class="english">
                            <?php echo translate('form_first_name', $lang, $translations); ?>
                        </label>
                        <input type="text" id="name" name="name" value=""
                            placeholder="<?php echo translate('form_first_name', $lang, $translations); ?>">
                    </div>

                    <div class="form-group">
                        <label for="designation" class="english">
                            <?php echo translate('form_designation', $lang, $translations); ?>

                        </label>
                        <!-- <label for="designation" class="arabic" style="display:none;">التعيين</label> -->
                        <select id="designation" name="designation">
                            <option>
                                <?php echo translate('designation_select', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_co', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_ceo', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_director', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_compliance', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_president', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_financial', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_technology', $lang, $translations); ?>

                            </option>
                            <option class="english">
                                <?php echo translate('designation_vice_president', $lang, $translations); ?>

                            </option>
                            <!-- <option class="arabic" style="display:none;">الرئيس التنفيذي للعمليات</option> -->
                            <!-- <option class="arabic" style="display:none;">الرئيس التنفيذي</option> -->
                            <!-- <option class="arabic" style="display:none;">مدير</option> -->
                            <!-- <option class="arabic" style="display:none;">رئيس الالتزام</option> -->
                            <!-- <option class="arabic" style="display:none;">الرئيس</option> -->
                            <!-- <option class="arabic" style="display:none;">المدير المالي</option> -->
                            <!-- <option class="arabic" style="display:none;">مدير التكنولوجيا</option> -->
                            <!-- <option class="arabic" style="display:none;">نائب الرئيس</option> -->
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="email" class="english">
                            <?php echo translate('form_email', $lang, $translations); ?>
                        </label>
                        <input type="email" id="email" name="email" value="" disabled>
                    </div>

                    <div class="form-group">
                        <label for="mobileCode" class="english">
                            <?php echo translate('form_mobile_code', $lang, $translations); ?>

                        </label>
                        <!-- <label for="mobileCode" class="arabic" style="display:none;">كود الجوال*</label> -->
                        <input type="tel" id="mobileCode" name="mobile_code" value="966">
                    </div>

                    <div class="form-group">
                        <label for="mobileNumber" class="english">
                            <?php echo translate('form_mobile_number', $lang, $translations); ?>
                        </label>
                        <input type="text" id="mobileNumber" name="mobile_number" placeholder="eg. XXX XXX XXX">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group">
                        <label for="company" class="english">
                            <?php echo translate('form_company', $lang, $translations); ?>

                        </label>
                        <!-- <label for="company" class="arabic" style="display:none;">شركة</label> -->
                        <input type="text" id="company" name="company"
                            placeholder="<?php echo translate('form_company', $lang, $translations); ?>">
                    </div>

                    <div class="form-group">
                        <label for="industry" class="english">
                        </label>
                        <!-- <label for="industry" class="arabic" style="display:none;">الصناعة*</label> -->

                        <!-- <option class="arabic" style="display:none;">تكنولوجيا المعلومات</option> -->
                        <!-- <option class="arabic" style="display:none;">الرعاية الصحية</option> -->
                        <!-- <option class="arabic" style="display:none;">الطاقة المتجددة</option> -->
                        <!-- <option class="arabic" style="display:none;">الزراعة</option> -->
                        <!-- <option class="arabic" style="display:none;">التصنيع</option> -->
                        </select>
                    </div>

                </div>

                <!-- <div class="row">
                    <div class="form-group">
                        <label for="vat" class="english">
                            <?php echo translate('form_vat', $lang, $translations); ?>

                        </label> -->
                <!-- <label for="vat" class="arabic" style="display:none;">شهادة ضريبة القيمة المضافة*</label> -->
                <!-- <input type="text" id="vat" name="vat" placeholder="eg. 123456">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="vat-upload" class="english">
                            <!-- <?php echo translate('form_vat_upload', $lang, $translations); ?>  -->

                <!-- </label> -->
                <!-- <label for="vat-upload" class="arabic" style="display:none;">تحميل نسخة من شهادة ضريبة القيمة المضافة *</label> -->
                <!-- <input type="file" id="vat-upload" name="vat-upload"> -->

                <!-- <button class="file-upload-custom-button">Choose file</button>
                            <span id="vat-upload"></span> -->
                <!-- 
                    </div>
                </div> -->

                <button id="saveButton" type="submit" class="save-btn english">
                    <?php echo translate('save_info', $lang, $translations); ?>

                </button>
                <!-- <button type="button" class="save-btn arabic" style="display:none;" onclick="saveInfo()">حفظ المعلومات</button> -->
            </form>

            <hr>

            <h2 class="english">
                <?php echo translate('form_contact', $lang, $translations); ?>

            </h2>
            <!-- <h2 class="arabic" style="display:none;">اتصالات</h2> -->
            <table>
                <thead>

                    <tr class="english">
                        <th class="table-header">
                            <?php echo translate('form_account_no', $lang, $translations); ?>
                        </th>

                        <th>
                            <?php echo translate('form_contact_name', $lang, $translations); ?>

                        </th>
                        <th>
                            <?php echo translate('form_email_id', $lang, $translations); ?>

                        </th>
                        <th>
                            <?php echo translate('form_mobile_no', $lang, $translations); ?>

                        </th>
                        <th>
                            <?php echo translate('form_action', $lang, $translations); ?>

                        </th>
                    </tr>


                    <!-- <tr class="arabic" style="display:none;">
                        <th>رقم الحساب</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الجوال</th>
                        <th>الإجراء</th>
                    </tr> -->
                </thead>

                <tbody>
                    <tr>
                        <td id="account_no">

                        </td>
                        <td id="account_name">
                            <?php echo translate('filled_contact_name', $lang, $translations); ?>


                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <hr class="extra-line">

            <div class="change-password-container">
                <h2 class="english">
                    <?php echo translate('form_password_title', $lang, $translations); ?>

                </h2>
                <!-- <h2 class="arabic" style="display:none;">تغيير كلمة المرور</h2> -->

                <form>
                    <div class="form-group">
                        <label for="currentPassword" class="english">
                            <?php echo translate('form_current_password', $lang, $translations); ?>

                        </label>
                        <!-- <label for="currentPassword" class="arabic" style="display:none;">كلمة المرور الحالية *</label> -->
                        <div class="password-wrapper">
                            <input type="password" id="currentPassword" name="currentPassword" required>
                            <span class="toggle-password" onclick="togglePassword('currentPassword')">👁️</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newPassword" class="english">
                            <?php echo translate('form_new_password', $lang, $translations); ?>

                        </label>
                        <!-- <label for="newPassword" class="arabic" style="display:none;">كلمة المرور الجديدة*</label> -->
                        <div class="password-wrapper">
                            <input type="password" id="newPassword" name="newPassword" required>
                            <span class="toggle-password" onclick="togglePassword('newPassword')">👁️</span>
                        </div>
                    </div>

                    <button type="submit" class="change-password-btn english">
                        <?php echo translate('form_update_password', $lang, $translations); ?>

                    </button>
                    <!-- <button type="submit" class="change-password-btn arabic" style="display:none;">تحديث كلمة المرور</button> -->
                </form>
            </div>

        </div>
    </div>

    <!-- <script src="./build/js/intlTelInput.js"></script> -->
    <script src="script.js"></script>
    <script>
        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }

        var input = document.querySelector("#phone");
        // window.intlTelInput(input, {});  

        function saveInfo() {
            const form = document.getElementById('infoForm');
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            console.log('Data to be sent:', data);
            return data;
        }




        async function fetchUserProfile() {
            console.log("========================================");
            const token = localStorage.getItem('jwt_token');
            console.log('Auth token:', token);

            if (!token) {
                alert('Authorization token not found. Please log in.');
                return;
            }

            try {
                const response = await fetch('https://smartprintsa.com/api/profile', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                });

                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                const data = await response.json();
                console.log('API Response:', data);

                // Check if user data is available in the expected structure
                if (data.data) {
                    populateProfile(data.data);
                } else {
                    populateProfile(data.user); // In case the data is not wrapped inside `data`
                }
            } catch (error) {
                alert('Error fetching user profile: ' + error.message);
                console.error('Error fetching user profile:', error);
            }
        }

        // Function to safely set values in input fields
        function populateProfile(userData) {
            console.log(userData);

            // Function to set value safely
            function setValueById(id, value) {
                const element = document.getElementById(id);
                if (element) {
                    element.value = value !== null && value !== undefined ? value : ''; // Set to empty string if value is null or undefined
                } else {
                    console.error(`Element with ID '${id}' not found.`);
                }
            }



            // Populate fields using the safe setValue function
            setValueById('email', userData.email);

            document.getElementById("account_no").innerText = userData.id;
            document.getElementById("account_name").innerText = userData.name;
            // Adjust according to your property name
            setValueById('name', userData.name);
            setValueById('designation', userData.designation);
            setValueById('title', userData.title);
            // setValueById('phone', userData.phone);
            setValueById('company', userData.company);
            setValueById('mobileNumber', userData.mobile_number);
            setValueById('mobileCode', userData.mobile_code);
        }

        // Populate profile on DOM content loaded
        document.addEventListener('DOMContentLoaded', function () {
            fetchUserProfile();
        });

        async function saveUserProfile() {
            let user = saveInfo();
            const token = localStorage.getItem('jwt_token');

            if (!token) {
                alert('Authorization token not found. Please log in.');
                return;
            }

            // // Collect data from the form
            // const userData = {
            //     email: document.getElementById('email').value,
            //     name: document.getElementById('firstName').value,
            //     phone: document.getElementById('phone').value,
            //     company: document.getElementById('company').value,
            //     mobile_number: document.getElementById('mobileNumber').value,
            //     industry: document.getElementById('industry').value
            // };

            try {
                const response = await fetch('https://smartprintsa.com/api/profileUpdate', {
                    method: 'POST', // or 'PUT' depending on your API
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify(user)  // Convert data to JSON string
                });

                console.log(user);


                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                const result = await response.json();
                console.log('Profile updated successfully:', result);
                alert('Profile updated successfully!');
            } catch (error) {
                console.error('Error updating profile:', error);
                alert('Error updating profile: ' + error.message);
            }
        }

        // Add event listener to the "Save Info" button
        document.getElementById('saveButton').addEventListener('click', saveUserProfile);

        // // Ensure the user data is populated if available on the server-side
        // const userData = <?php echo json_encode($user); ?>;
        // populateProfile(userData);


        // async function updatePassword () {
        //     if(token) {
        //         if(currentPassword === newPassword){
        //             try{
        //                 const response = await fetch('https://smartprintsa.com/api/changePassword', {
        //                     method: 'POST'
        //                     headers: {

        //                     }
        //                 })

        //             }
        //             catch (error){
        //                 console.log("error", error);
        //             }

        //         }

        //     }


        // } 
    </script>
</body>

</html>