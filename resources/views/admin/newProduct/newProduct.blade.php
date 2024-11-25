<section>
    <div class="row g-0">
        <!-- Sidebar Column -->
        <div class="col-xl-2 col-md-3 col-sm-4">
            @include("admin.sideBar.sideBar")
        </div>

        <!-- Content Column -->
        <div class="col-xl-10 col-md-9 col-sm-8 mt-5 product-detail">
            <div class="container mt-5">
                <div class="info">
                    <h2 class="pt-3">Add Product</h2>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control py-2" id="name" placeholder="name">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" class="form-control py-2" id="price" placeholder="Price">
                            </div>
                            <div class="col-md-6">
                                <label for="size" class="form-label">Size:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control py-2 bg-transparent" id="size" placeholder="Select Size" readonly>
                                    <button class="btn bg-light plus" type="button" data-bs-toggle="modal" data-bs-target="#sizeModal">+</button>
                                </div>
                                <div id="selectedSizes" class="mt-2"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Upload Image:</label>
                                <input type="file" class="form-control py-2" id="image">

                            </div>
                            <div class="col-md-6">
                                <label for="side" class="form-label">Side:</label>
                                <select class="form-select py-2" id="side">
                                    <option disabled selected>Select Side</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="material" class="form-label">Material:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control py-2 bg-transparent" id="material" placeholder="Select Material" readonly>
                                    <button class="btn bg-light plus" type="button" data-bs-toggle="modal" data-bs-target="#materialModal">+</button>
                                </div>
                                <div id="selectedMaterials" class="mt-2"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category Name:</label>
                                <select class="form-select py-2" id="category">
                                    <option selected disabled>Select Category Name</option>
                                    <!-- Categories will be populated here dynamically -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="subcategory" class="form-label">SubCategory Name:</label>
                                <select class="form-select py-2" id="subcategory">
                                    <option selected disabled>Select Sub Category Name</option>
                                    <!--Sub Categories will be populated here dynamically -->
                                </select>
                            </div>
                            <div class="col-12">
                                <button for="attribute" type="button" class="btn btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#attributeModal">Add Attributes</button>
                                <div id="selectedAttributesdiv" class="mt-2"></div>
                                <button type="submit" class="btn custom-button">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modals for Size, Material, and Attributes are unchanged -->
                <!-- Size Modal -->
                <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sizeModalLabel">Select Size</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control mb-2" id="newSize" placeholder="Enter size">
                                <div id="modalSelectedSizes" class="mb-2"></div>
                                <button class="btn btn-primary me-2" id="addSize">Add</button>
                                <button class="btn btn-success" id="saveSize">Save</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Attribute Modal -->
                <div class="modal fade" id="attributeModal" tabindex="-1" aria-labelledby="attributeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="attributeModalLabel">Add Attribute</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control mb-2" id="attributeName" placeholder="Attribute Name">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control mb-2" id="attributeValue" placeholder="Attribute Value">
                                </div>
                                <div id="modalSelectedAttributes" class="mb-2"></div>
                                <button class="btn btn-primary me-2" id="addAttribute">Add</button>
                                <button class="btn btn-success" id="saveAttribute">Save</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Material Modal -->
                <div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="materialModalLabel">Select Material</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control mb-2" id="newMaterialInput" placeholder="Enter material">
                                <div id="modalSelectedMaterials" class="mb-2"></div>
                                <button class="btn btn-primary me-2" id="addMaterial">Add</button>
                                <button class="btn btn-success" id="saveMaterial">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeInput = document.getElementById('size');
            const newSizeInput = document.getElementById('newSize');
            const addSizeBtn = document.getElementById('addSize');
            const saveSizeBtn = document.getElementById('saveSize');
            const selectedSizesDiv = document.getElementById('selectedSizes');
            const modalSelectedSizesDiv = document.getElementById('modalSelectedSizes');
            const sizeModal = new bootstrap.Modal(document.getElementById('sizeModal'));

            const materialInput = document.getElementById('material');
            const newMaterialInput = document.getElementById('newMaterialInput');
            const addMaterialBtn = document.getElementById('addMaterial');
            const saveMaterialBtn = document.getElementById('saveMaterial');
            const selectedMaterialsDiv = document.getElementById('selectedMaterials');
            const modalSelectedMaterialsDiv = document.getElementById('modalSelectedMaterials');
            const materialModal = new bootstrap.Modal(document.getElementById('materialModal'));

            const attributeInput = document.getElementById('attribute');
            const newAttributeNameInput = document.getElementById('attributeName');
            const newAttributeValueInput = document.getElementById('attributeValue');
            const addAttributeBtn = document.getElementById('addAttribute');
            const saveAttributeBtn = document.getElementById('saveAttribute');
            const selectedAttributesDiv = document.getElementById('selectedAttributesdiv');
            const modalSelectedAttributesDiv = document.getElementById('modalSelectedAttributes');
            const attributeModal = new bootstrap.Modal(document.getElementById('attributeModal'));

            let attributeNames;
            let sizes = [];
            let materials = [];
            let attributeValues = [];
            let attributeData = [];
            let subCategoryId;

            function updateAttributeValueBadges(container) {
                container.innerHTML = attributeData.map(data =>
                    `<div">
                        <span class="badge bg-primary">${data.name}</span>
                        ${data.values.map(value => 
                            `<span class="badge bg-success" style="margin-right: 5px;">${value}<span class="remove pl-2 cursor-pointer" data-value="${value}">×</span></span>`
                        ).join('')}
                    </div>`
                ).join('');
            }
            addAttributeBtn.addEventListener('click', function() {
                const newName = newAttributeNameInput.value.trim();
                const newValue = newAttributeValueInput.value.trim();

                if (newName && newValue) {
                    const existingAttribute = attributeData.find(attr => attr.name === newName);
                    if (existingAttribute) {
                        if (!existingAttribute.values.includes(newValue)) {
                            existingAttribute.values.push(newValue);
                        }
                    } else {
                        attributeData.push({
                            name: newName,
                            values: [newValue]
                        });
                    }
                    updateAttributeValueBadges(modalSelectedAttributesDiv);
                    newAttributeValueInput.value = '';
                }
            });

            saveAttributeBtn.addEventListener('click', function() {
                updateAttributeValueBadges(selectedAttributesDiv);
                attributeModal.hide();
            });

            function resetAttributeModal() {
                newAttributeNameInput.value = '';
                newAttributeValueInput.value = '';
                modalSelectedAttributesDiv.innerHTML = '';
            }
            const attributeModalElement = document.getElementById('attributeModal');
            attributeModalElement.addEventListener('show.bs.modal', resetAttributeModal);


            // Functions to update badges (unchanged)
            function updateSizeBadges(container) {
                container.innerHTML = sizes.map(size =>
                    `<span class="badge bg-success" style="margin-right: 5px;">${size}<span class="remove pl-2 cursor-pointer" data-size="${size}">×</span></span>`
                ).join('');
            }

            function updateMaterialBadges(container) {
                container.innerHTML = materials.map(material =>
                    `<span class="badge bg-success" style="margin-right: 5px;">${material}<span class="remove pl-2 cursor-pointer" data-material="${material}">×</span></span>`
                ).join('');
            }

            // Add size functionality (unchanged)
            addSizeBtn.addEventListener('click', function() {
                const newSize = newSizeInput.value.trim();
                if (newSize && !sizes.includes(newSize)) {
                    sizes.push(newSize);
                    updateSizeBadges(modalSelectedSizesDiv);
                    newSizeInput.value = '';
                }
            });

            saveSizeBtn.addEventListener('click', function() {
                updateSizeBadges(selectedSizesDiv);
                sizeInput.value = sizes.join(', ');
                sizeModal.hide();
            });

            // Material functionality (unchanged)
            addMaterialBtn.addEventListener('click', function() {
                const newMaterial = newMaterialInput.value.trim();
                if (newMaterial && !materials.includes(newMaterial)) {
                    materials.push(newMaterial);
                    updateMaterialBadges(modalSelectedMaterialsDiv);
                    newMaterialInput.value = '';
                }
            });

            saveMaterialBtn.addEventListener('click', function() {
                updateMaterialBadges(selectedMaterialsDiv);
                materialInput.value = materials.join(', ');
                materialModal.hide();
            });

            const subcategorySelect = document.getElementById('subcategory');

            function getsubCategories(categoryid) {
                fetch(`https://smartprintsa.com/api/getSubcategoriesByCategory/${categoryid}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('admin-token')}`,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Fetched subcategories:", data);

                        // subcategorySelect.innerHTML = '';
                        if (data.subcategories && Array.isArray(data.subcategories)) {
                            data.subcategories.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.name;
                                subcategorySelect.appendChild(option);
                            });
                        } else {
                            console.error('Unexpected data format for subcategories:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        alert('Unable to fetch subcategories. Please try again later.');
                    });
            }
            // Handle category selection (unchanged)
            subcategorySelect.addEventListener('change', function() {
                const selectedsubCategoryId = this.value;
                subCategoryId = selectedsubCategoryId;
                console.log("lajfdkladjflka", subCategoryId, selectedsubCategoryId)
            });

            // Fetch categories
            const categorySelect = document.getElementById('category');

            // for testing use local api url
            // https://smartprintsa.com/api/getAllCategories

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

            // Handle category selection (unchanged)
            categorySelect.addEventListener('change', function() {
                const selectedCategoryId = this.value;
                subcategorySelect.innerHTML = '<option selected disabled>Select Sub Category Name</option>';
                getsubCategories(selectedCategoryId);
            });

            const form = document.querySelector('form');
            const addProductButton = form.querySelector('button[type="submit"]');

            addProductButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Collect form data
                const name = document.getElementById('name').value;
                const price = document.getElementById('price').value;
                const side = document.getElementById('side').value;
                const category_id = document.getElementById('category').value;

                const size = sizes;
                const material = materials;
                const attributes = attributeData;

                const imageInput = document.getElementById('image');
                const images = Array.from(imageInput.files).map(file => file);

                console.log("image21", images);
                // console.log("image22", images[0].name);

                console.log('Selected Sub Category ID:', subCategoryId);

                const productData = {
                    name,
                    price,
                    size,
                    side,
                    material,
                    category_id,
                    images,
                    attributes,
                    subCategoryId,
                };

                const formData = new FormData();
                formData.append('name', productData.name);
                formData.append('price', productData.price);
                productData.size.forEach(s => formData.append('size[]', s)); // Append sizes
                productData.material.forEach(m => formData.append('material[]', m)); // Append materials
                formData.append('side', productData.side);
                formData.append('category_id', productData.category_id);
                formData.append('subcategory_id', productData.subCategoryId);
                // Append attributes in the required format
                attributes.forEach((attribute, index) => {
                    formData.append(`attributes[${index}][name]`, attribute.name);
                    attribute.values.forEach(value => {
                        formData.append(`attributes[${index}][value][]`, value);
                    });
                });
                // Append each image to the FormData object
                productData.images.forEach(image => formData.append('images[]', image));
                console.log("formdata", JSON.stringify(formData));

                // Send the form data to the API via a POST request
                fetch('https://smartprintsa.com/api/product', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('admin-token')}`
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Product successfully added:', JSON.stringify(data));
                        alert('Product added successfully!');
                        form.reset(); // Reset the form
                        window.location.href = "/admin/product";

                        // Clear sizes and materials
                        sizes = [];
                        materials = [];
                        updateSizeBadges(selectedSizesDiv);
                        updateMaterialBadges(selectedMaterialsDiv);

                        // Clear uploaded images
                        imageInput.value = '';
                    })
                    .catch(error => {
                        console.error('Error adding product:', error);
                        alert('Unable to add product. Please try again.');
                    });
            });






        });
    </script>
</section>