<section>
    <div class="row g-0">
        <!-- Sidebar Column -->
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <!-- Content Column -->
        <div class="col-xl-10 col-md-9 col-sm-8 mt-5 category-form">
            <div class="container">
                <div class="info">
                    <h2 class="pt-3">Add Sub Category</h2>
                    <form id="categoryForm" onsubmit="submitForm(event)">
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control py-2" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="col-md-6">
                                <label for="category" class="form-label">Category Name:</label>
                                <select class="form-select py-2" id="category">
                                    <option selected disabled>Select Category Name</option>
                                    <!-- Categories will be populated here dynamically -->
                                </select>
                        </div>
                        <!-- Image Upload Field -->
                        <div class="category-image-upload">
                            <input type="file" id="fileInput" accept="image/*" required>
                            <img id="uploadedImage" style="display: none; max-width: 100%; margin-top: 10px;" alt="Uploaded Image">
                            <span id="uploadText">Click to upload image</span>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn custom-button">
                                Add Sub Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    const categorySelect = document.getElementById('category');
    fetch('https://smartprintsa.com/api/getAllCategories', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('admin-token')}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log("response", response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log("data>>", data);
        
        if (data.categories && Array.isArray(data.categories)) {
            data.categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        } else {
            console.error('Unexpected data format:', data);
        }
    })
    .catch(error => {
        console.error('Error fetching categories:', error);
        alert('Unable to fetch categories. Please try again later.');
    });

    let subCategoryId;
    // Handle category selection (unchanged)
    categorySelect.addEventListener('change', function() {
        const selectedCategoryId = this.value;
        subCategoryId = selectedCategoryId;
        console.log('Selected Category ID:', selectedCategoryId);
    });
    document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const uploadedImage = document.getElementById('uploadedImage');
            uploadedImage.src = e.target.result; // Set the image source to the loaded file
            uploadedImage.style.display = 'block'; // Show the image
            document.getElementById('uploadText').style.display = 'none'; // Hide the text
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    }
});

function submitForm(event) {
    event.preventDefault(); // Prevent the default form submission

    const name = document.getElementById('name').value;
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0]; // Get the uploaded file

    const formData = new FormData();
    formData.append('name', name);
    formData.append('image', file); // Append the file
    formData.append('category_id', subCategoryId);

    fetch('https://smartprintsa.com/api/addSubcategory', {
        method: 'POST',
        body: formData,
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('admin-token') // Add your token here
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(`Error ${response.status}: ${err.message}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        alert('Sub Category added successfully!'); // Show success alert
        document.getElementById('categoryForm').reset(); // Reset the form
        document.getElementById('uploadedImage').style.display = 'none'; // Hide the uploaded image
        document.getElementById('uploadText').style.display = 'block'; // Show the upload text again
        window.location.href = "/admin/subCategory";
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message); // Show error alert
    });
}
</script>
