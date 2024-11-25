<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_addcategory($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<section>
    <div class="row g-0">
        <!-- Sidebar Column -->
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <!-- Content Column -->
        <div
            style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
            class="col-xl-10 col-md-9 col-sm-8 mt-5 product-detail">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center info">
                    <h2 class="pt-3">
                        <?php echo translate_addcategory('category', $lang, $translations); ?>


                    </h2>
                    <div>
                        <a class="btn" href="/admin/new-category" role="button">
                            <?php echo translate_addcategory('add_category', $lang, $translations); ?>


                        </a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <?php echo translate_addcategory('category_title', $lang, $translations); ?>


                            </th>
                            <th class="text-center">
                                <?php echo translate_addcategory('category_date', $lang, $translations); ?>


                            </th>
                            <th class="text-center">
                                <?php echo translate_addcategory('category_action', $lang, $translations); ?>


                            </th>
                            <th style="width: 8%;" class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let allCategories = [];
        document.addEventListener('DOMContentLoaded', () => {

            const baseUrl = "https://smartprintsa.com";


            // changing get category url to local for testing
            // https://smartprintsa.com/api/getAllCategories

            const apiUrl = 'https://smartprintsa.com/api/getAllCategories';
            const tableBody = document.querySelector('tbody');

            // inititialize empty array


            fetch(apiUrl)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((categories) => {
                    console.log(categories); // Log the categories to check the structure
                    // Clear existing rows

                    // Store the categories globally so we can access them later in handleClick
                    allCategories = categories.categories;


                    tableBody.innerHTML = '';



                    // Loop through categories and create table rows
                    categories.categories
                        .forEach((category, index) => {




                            console.log("categories in admin", category);
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td style="vertical-align: middle; width:400px">
                                <img src="${baseUrl}${category.image}" alt="${category.name}" width="50" height="50" style="vertical-align: middle; margin-right: 10px;">
                                <span style="vertical-align: middle;">${category.name}</span>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">${category.updated_at}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <button class="btn btn-danger" onclick="deleteCategory(${category.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                             <button class="btn btn-primary" style="background-color: #F3953B; color: white; border: none" onclick="handleClick(${index})">
                                <i class="fas fa-edit"></i> Edit
                             </button>
                            </td>
                        `;
                            tableBody.appendChild(row);
                        });
                })
                .catch((error) => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });

        function deleteCategory(id) {
            const deleteUrl = `https://smartprintsa.com/api/deleteCategory/${id}`;
            fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('admin-token')}`,
                        'Content-Type': 'application/json'
                    },
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data, "Category deleted successfully");
                    window.location.reload();
                    // Optionally, remove the deleted Category from the DOM
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                    }
                })
                .catch((error) => {
                    console.error('There was a problem with the delete operation:', error);
                });
        }

        let pathname = window.location.origin

        const handleClick = (index) => {

            const selectedCategory = allCategories[index]; // Get the category from the global array using the index
            console.log("Selected category: ", selectedCategory)
            // set category data on local storage
            localStorage.setItem("setcategoryData", JSON.stringify(selectedCategory));
            window.location.href = pathname + '/admin/edit-category';
        }
    </script>
</section>