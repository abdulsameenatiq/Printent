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
                    <h2 class="pt-3">Add Category</h2>
                    <form id="categoryForm" onsubmit="submitForm(event)">
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control py-2" id="name" name="name" placeholder="Name" required>
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
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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

    fetch('https://smartprintsa.com/api/category', {
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
        alert('Category added successfully!'); // Show success alert
        document.getElementById('categoryForm').reset(); // Reset the form
        document.getElementById('uploadedImage').style.display = 'none'; // Hide the uploaded image
        document.getElementById('uploadText').style.display = 'block'; // Show the upload text again
        window.location.href = "/admin/category";
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message); // Show error alert
    });
}
</script>
