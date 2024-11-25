<section>
    <div class="row g-0" style="height: 100vh;">
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <div class="col-xl-10 col-md-9 col-sm-8 mt-5 product-detail" style="display: flex; flex-direction: column;">
            <div class="container-fluid" style="flex-grow: 1;">
                <div class="d-flex justify-content-between align-items-center info">
                    <h2 class="pt-3">Product</h2>
                    <div>
                        <a class="btn" href="/admin/new-product" role="button">
                            Add Product
                        </a>
                    </div>
                </div>
                <div class="table-responsive" style="height: calc(100vh - 150px); overflow-y: auto;">
                    <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 20%;">Product</th> <!-- Increased width here -->
                                <th style="width: 10%;" class="text-center">Price</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Sub Category</th>
                                <th style="width: 5%;" class="text-center">Side</th>
                                <th class="text-center">Material</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Attributes</th>
                                <th style="width: 8%;" class="text-center">Action</th>
                                <th style="width: 8%;" class="text-center">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product rows will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            table-layout: fixed;
            width: 100%;
            overflow: auto;
        }

        .table th,
        .table td {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        .table td:nth-child(7) {
            max-width: 300px;
        }

        .row.g-0 {
            height: 100vh;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // const baseUrl = "https://smartprintsa.com";
            const baseUrl = "https://smartprintsa.com";
            // adding local url for testing
            //  https://smartprintsa.com/api/getAllProducts

            const apiUrl = 'https://smartprintsa.com/api/getAllProducts';
            const tableBody = document.querySelector('tbody');

            fetch(apiUrl)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data, "testing here"); // Log the data to check the structure
                    // console.log(data.Products[0].id, "get ID")

                    tableBody.innerHTML = '';

                    data.Products.forEach(prod => {
                        let productImage = '';
                        let material = JSON.parse(prod.material);
                        let size = JSON.parse(prod.size);
                        let attributes = JSON.parse(JSON.stringify(prod.attributes));

                        console.log("material", material);

                        if (prod.images) {
                            try {
                                const imagesArray = JSON.parse(prod.images);
                                console.log("imagesArray", imagesArray);

                                if (Array.isArray(imagesArray) && imagesArray.length > 0) {
                                    console.log("imagesArray[0]", baseUrl + imagesArray[0]);

                                    productImage = baseUrl + imagesArray[0]; // Get the first image
                                }
                            } catch (error) {
                                console.error("Error parsing images:", error);
                            }
                        }

                        let attributesString = '';
                        if (attributes && attributes.length > 0) {
                            attributes.forEach(attr => {
                                let values = JSON.parse(attr.value);
                                attributesString += `${attr.name}: ${values.join(', ')}<br>`;
                            });
                        }

                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td style="vertical-align: middle; width:30%">
                                <img src="${productImage}" alt="${prod.name}" width="40" height="40" style="vertical-align: middle; margin-right: 10px;">
                                <span style="vertical-align: middle;">${prod.name}</span>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">${prod.price}</td>
                            <td class="text-center" style="vertical-align: middle;">${prod.category.name}</td>
                            <td class="text-center" style="vertical-align: middle;">${prod.subcategory.name}</td>
                            <td class="text-center" style="vertical-align: middle;">${prod.side}</td>
                            <td class="text-center" style="vertical-align: middle;">${material.join(', ')}</td>
                            <td class="text-center" style="vertical-align: middle;">${size.join(', ')}</td>
                            <td class="text-center" style="vertical-align: middle;">${attributesString}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <button class="btn btn-danger" onclick="deleteCategory(${prod.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                             <button class="btn btn-primary" style="background-color: #F3953B; color: white; border: none" onclick="handleClick(${prod.id})">
                                <i class="fas fa-edit"></i> Edit
                             </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch((error) => {
                    console.log('There has been a problem with your fetch operation:', error);
                });

        });


        function deleteCategory(id) {
            const deleteUrl = `https://smartprintsa.com/api/deleteProduct/${id}`;
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
                    console.log(data, "Product deleted successfully");
                    window.location.reload();
                    // Optionally, remove the deleted product from the DOM
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

        const handleClick = (id) => {
            window.location.href = pathname + `/admin/edit-product/${id}`;
        }
    </script>
</section>