<section>
    <div class="row g-0">
        <!-- Sidebar Column -->
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <!-- Content Column -->
        <div class="col-xl-10 col-md-9 col-sm-8 mt-5 product-detail">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center info">
                    <h2 class="pt-3">
                        Subcategory
                    </h2>
                    <div>
                        <a class="btn" href="/admin/new-subCategory" role="button">
                            Add Sub Category
                        </a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subcategory Title</th>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Subcategory Date</th>
                            <th class="text-center">Subcategory Action</th>
                            <th class="text-center">Subcategory Edit</th>
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
        let allSubCategories = [];
        document.addEventListener('DOMContentLoaded', () => {

            const baseUrl = "https://smartprintsa.com";
            // changing getall subcategory url to local for testing
            // https://smartprintsa.com/api/getAllSubcategory
            const apiUrl = 'https://smartprintsa.com/api/getAllSubcategory';
            const tableBody = document.querySelector('tbody');

            fetch(apiUrl)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((subcategories) => {

                    // Store the categories globally so we can access them later in handleClick
                    allSubCategories = subcategories.subcategories;



                    // Clear existing rows
                    tableBody.innerHTML = '';

                    // Loop through categories and create table rows
                    subcategories.subcategories.forEach((subcategory, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td style="vertical-align: middle; width:400px">
                                <img src="${baseUrl}${subcategory.image}" alt="${subcategory.name}" width="50" height="50" style="vertical-align: middle; margin-right: 10px;">
                                <span style="vertical-align: middle;">${subcategory.name}</span>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">${subcategory.category.name}</td>
                            <td class="text-center" style="vertical-align: middle;">${subcategory.updated_at}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <button class="btn btn-danger" onclick="deleteSubCategory(${subcategory.id})">
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

        function deleteSubCategory(id) {
            const deleteUrl = `https://smartprintsa.com/api/deleteSubCategory/${id}`;
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
                    console.log(data, "Subcategory deleted successfully");
                    window.location.reload();
                    // Optionally, remove the deleted subcategory from the DOM
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
            const selectedSubcategory = allSubCategories[index];
            console.log("selected sub category", selectedSubcategory);
            localStorage.setItem('setSubcategoryData', JSON.stringify(selectedSubcategory));
            window.location.href = pathname + '/admin/edit-subCategory';
        }
    </script>
</section>