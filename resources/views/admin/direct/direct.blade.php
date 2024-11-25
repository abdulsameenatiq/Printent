<section>
    <div class="row g-0">
        <!-- Sidebar Column -->
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <!-- Content Column -->
        <div class="col-xl-10 col-md-9 col-sm-8 mt-5 product-detail">
            <div class="container">
                <div class=" info">
                    <h2 class="pt-3">Direct Order</h2>

                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name & Image</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">message</th>

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
        document.addEventListener('DOMContentLoaded', () => {
            const apiUrl = 'https://smartprintsa.com/api/getAllDirectOrders';
            const baseUrl = "https://smartprintsa.com"
            const tableBody = document.querySelector('tbody');

            fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('admin-token')}`,
                    'Content-Type': 'application/json' // Optional, but recommended
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log("data", data); // Log the data to check the structure
                    // Clear existing rows
                    tableBody.innerHTML = '';

                    // Loop through the categories and create table rows
                    data.DirectOrders
                        .forEach(direct => {
                            console.log("direct>>>", direct);

                            let directImage = '';



                            if (direct.images) {
                                try {
                                    const imagesArray = JSON.parse(direct.images);
                                    console.log("imagesArray", imagesArray);

                                    if (Array.isArray(imagesArray) && imagesArray.length > 0) {
                                        console.log("imagesArray[0]", baseUrl + imagesArray[0]);

                                        directImage = baseUrl + imagesArray[0]; // Get the first image
                                    }
                                } catch (error) {
                                    console.error("Error parsing images:", error);
                                }
                            }

                            console.log("directImage", directImage);

                            const row = document.createElement('tr');
                            row.innerHTML = `
                    
                  <td style="vertical-align: middle; width:400px">
                                <img src="${directImage}" alt="${direct.name}" width="50" height="50" style="vertical-align: middle; margin-right: 10px;">
                                <span style="vertical-align: middle;">${direct.name}</span>
                            </td>
                                                        <td style="vertical-align: middle;">${direct.email}</td>

                            <td style="vertical-align: middle;">${direct.mobile}</td>
                            <td class="text-center" style="vertical-align: middle;">${direct.message}</td>
                `;
                            tableBody.appendChild(row);
                        });
                })
                .catch((error) => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });

        function deleteCategory(id) {
            // Implement the delete functionality here
            console.log(`Delete category with ID: ${id}`);
        }
    </script>

</section>