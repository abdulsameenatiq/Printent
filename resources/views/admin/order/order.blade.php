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
                    <h2 class="pt-3">Order</h2>
                  
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Date</th>

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
        const apiUrl = 'https://smartprintsa.com/api/getAllOrder';
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
            data.allOrders.forEach(order => {
                console.log("order>>>",order);
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    
                    <td style="vertical-align: middle;">${order.order_number}</td>
                                        <td class="text-center" style="vertical-align: middle;">${order.user.name}</td>

                                        <td class="text-center" style="vertical-align: middle;">${order.shipping_address}</td>
                                        <td class="text-center" style="vertical-align: middle;">${order.updated_at}</td>
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
