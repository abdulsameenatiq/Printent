<section style="padding: 15px; background-color: yelow;">
    <h1 style="font-size: 30px;">Getting All Addresses</h1>
    <div class="table-container">
        <table id="addressTable" class="table">
            <thead>
                <tr style="text-align: center;">
                    <th>Address Title</th>
                    <th>Address Type</th>
                    <th>Building Name</th>
                    <th>Building No</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Postal Code</th>
                    <th>Street</th>
                    <th>Unit No</th>
                    <th>Additional Code</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody style="text-align: center;" id="addressTBody">
                <!-- Address rows will be dynamically added here -->
            </tbody>
        </table>
    </div>
</section>

<script>
    const fetchAddresses = async () => {
        try {
            const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage

            const response = await fetch('/api/getAddress', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                const addresses = data.address; // Assuming data has an address array
                console.log("Addresses:", addresses);

                // Generate the table rows
                const addressRows = addresses.map(address => `
                    <tr>
                        <td>${address.address_title}</td>
                        <td>${address.address_type}</td>
                        <td>${address.building_name}</td>
                        <td>${address.building_no}</td>
                        <td>${address.city}</td>
                        <td>${address.country}</td>
                        <td>${address.contact_person_name}</td>
                        <td>${address.email}</td>
                        <td>${address.mobile_number}</td>
                        <td>${address.postal_code}</td>
                        <td>${address.street}</td>
                        <td>${address.unit_no}</td>
                        <td>${address.additional_code}</td>
                        <td>${address.notes}</td>
                    </tr>
                `).join('');

                // Insert rows into the table body
                document.getElementById('addressTBody').innerHTML = addressRows;

            } else {
                console.error('API call failed', response.statusText);
            }

        } catch (error) {
            console.error('Error fetching addresses:', error);
        }
    }

    fetchAddresses();
</script>

<style>
    .table-container {
        margin-top: 20px;
        overflow-x: auto;
        /* background-color: red; */
        /* Enable horizontal scrolling */
    }

    table {
        /* background-color: red; */
        /* width: 100%; */
        border-collapse: collapse;
        text-align: left;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    /* th {
        background-color: #f4f4f4;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    } */
</style>