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
                    <h2 class="pt-3">Edit Product</h2>
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
                                <div id="imagesSelected"></div>
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
                                <!-- <button for="attribute" type="button" class="btn btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#attributeModal">Add Attributes</button>
                                <div id="selectedAttributesdiv" class="mt-2"></div> -->
                                <button type="submit" class="btn custom-button">Update Product</button>
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
        const nameInput = document.getElementById('name');
        const sizeInput = document.getElementById('size');
        const newSizeInput = document.getElementById('newSize');
        const addSizeBtn = document.getElementById('addSize');
        const saveSizeBtn = document.getElementById('saveSize');
        const selectedSizesDiv = document.getElementById('selectedSizes');
        const modalSelectedSizesDiv = document.getElementById('modalSelectedSizes');

        const materialInput = document.getElementById('material');
        const newMaterialInput = document.getElementById('newMaterialInput');
        const addMaterialBtn = document.getElementById('addMaterial');
        const saveMaterialBtn = document.getElementById('saveMaterial');
        const selectedMaterialsDiv = document.getElementById('selectedMaterials');
        const modalSelectedMaterialsDiv = document.getElementById('modalSelectedMaterials');

        const attributeInput = document.getElementById('attribute');
        const newAttributeNameInput = document.getElementById('attributeName');
        const newAttributeValueInput = document.getElementById('attributeValue');
        const addAttributeBtn = document.getElementById('addAttribute');
        const saveAttributeBtn = document.getElementById('saveAttribute');
        const selectedAttributesDiv = document.getElementById('selectedAttributesdiv');
        const modalSelectedAttributesDiv = document.getElementById('modalSelectedAttributes');
        const categorySelect = document.getElementById('category');
        const subcategorySelect = document.getElementById('subcategory');
        const imagesSelected = document.getElementById('imagesSelected');
        let sizes = [];
        let materials = [];
        let subCategoryId;
        const pathSegments = window.location.pathname.split('/');
        const pageId = pathSegments[pathSegments.length - 1];

        function updateSizeBadges(container) {

            container.innerHTML = sizes.map(size =>
                `<span class="badge bg-success" style="background-color: red; margin-right: 5px;">${size}<span class="remove pl-2 cursor-pointer" data-size="${size}">×</span></span>`
            ).join('');
            console.log('Updated sizes:', sizes);
        }

        function updateMaterialBadges(container) {
            container.innerHTML = materials.map(material =>
                `<span class="badge bg-success" style="margin-right: 5px;">${material}<span class="remove pl-2 cursor-pointer" data-material="${material}">×</span></span>`
            ).join('');
        }


        function getsubCategories(categoryid) {
            fetch(`https://smartprintsa.com/api/getSubcategoriesByCategory/${categoryid}`, {
                    // fetch(`https://smartprintsa.com/api/getSubcategoriesByCategory/${categoryid}`, {
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



        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagesSelectedDiv = document.getElementById('imagesSelected');

            // Handle new image selections
            imageInput.addEventListener('change', function(event) {
                const files = event.target.files;

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            imagesSelectedDiv.innerHTML += `<img style="height: 120px; width: 120px" src="${e.target.result}">`;
                        };

                        reader.readAsDataURL(file);
                    }
                });
            });
        });
        
        function displayServerImage(imagePath) {
            const imagesSelectedDiv = document.getElementById('imagesSelected');
            imagesSelectedDiv.innerHTML += `<div style= "padding: 5px "><img style="height: 120px; width: 120px" src="https://smartprintsa.com${imagePath}"> <div>`;
        }
        
        let imageAddresses = [];
        // Prefill the form with data from localStorage when the page loads
        document.addEventListener('DOMContentLoaded', function() {

        // Send the form data to the API via a POST request
        fetch('https://smartprintsa.com/api/getSingleProduct/' + pageId, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
                // body: formData
            })
            .then(response => {
                console.log("single product response", response);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('get single product', JSON.stringify(data));
                nameInput.value = data.Products.name
                price.value = data.Products.price
                side.value = data.Products.side
                sizes = JSON.parse(data.Products.size);
                updateSizeBadges(selectedSizesDiv);
                materials = JSON.parse(data.Products.material)
                updateMaterialBadges(selectedMaterialsDiv);
                selectedCategoryId = data.Products.category_id;
                categorySelect.value = selectedCategoryId
                subcategorySelect.innerHTML = '<option selected disabled>Select Sub Category Name</option>';
                getsubCategories(selectedCategoryId);
                // category.value = data.Products.category_id
                subCategoryId = data.Products.subcategory_id
                subcategorySelect.value = data.Products.subcategory_id

                imageAddresses = JSON.parse(data.Products.images);
                updateImages(); // Display the images with cross buttons

                // let networkImages = JSON.parse(data.Products.images)
                // console.log("netweorkImages", networkImages);
                // networkImages.forEach((image) => {
                //     console.log("onlyimgae", image);
                //     imagesSelected.innerHTML += `<img style= "height: 120px; width: 120px" src=${"https://smartprintsa.com" + (image)}>`
                // })

                let parsedImages = JSON.parse(data.Products.images);
                let imageURL = parsedImages;
                // imageInput.value = '';
            })
            .catch(error => {
                console.error('Error edit product:', error);
                alert('Unable to edit product. Please try again.');
            });


            // Function to update images on the UI
            function updateImages() {
                imagesSelected.innerHTML = ''; // Clear the current images
                imageAddresses.forEach((image, index) => {
                    imagesSelected.innerHTML += `
                        <div style="position: relative; display: inline-block; margin: 5px;">
                            <img style="height: 120px; width: 120px; display: block;" src=${"https://smartprintsa.com" + image}>
                            <button 
                                style="position: absolute; top: 0; right: 0; background-color: red; color: white; border: none; cursor: pointer; font-size: 18px; padding: 2px 6px;"
                                onclick="removeImage(${index})">
                                &times;
                            </button>
                        </div>
                    `;
                });
            }

            // Function to remove image from the array
            window.removeImage = function(index) {
                imageAddresses.splice(index, 1); // Remove the image from the array
                updateImages(); // Update the UI after removal
                console.log('Updated image addresses:', imageAddresses);
            }

        });

        document.addEventListener('DOMContentLoaded', function() {

            const sizeModal = new bootstrap.Modal(document.getElementById('sizeModal'));
            const materialModal = new bootstrap.Modal(document.getElementById('materialModal'));
            const attributeModal = new bootstrap.Modal(document.getElementById('attributeModal'));

            let attributeNames;
            let attributeValues = [];
            let attributeData = [];

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



            // Add size functionality (unchanged)
            addSizeBtn.addEventListener('click', function() {
                console.log('Add Size Button Clicked');
                const newSize = newSizeInput.value.trim();
                if (newSize && !sizes.includes(newSize)) {
                    sizes.push(newSize);
                    console.log('New size added:', sizes); // Log the updated sizes array
                    updateSizeBadges(modalSelectedSizesDiv);
                    newSizeInput.value = '';
                }
            });

            saveSizeBtn.addEventListener('click', function() {
                updateSizeBadges(selectedSizesDiv);
                sizeInput.value = sizes.join(', ');
                console.log('Size input value:', sizeInput.value); // Log to confirm
                sizeModal.hide();
            });

            // Material functionality (unchanged)
            addMaterialBtn.addEventListener('click', function() {
                console.log('Add newMaterial Button Clicked');
                const newMaterial = newMaterialInput.value.trim();
                if (newMaterial && !materials.includes(newMaterial)) {
                    materials.push(newMaterial);
                    console.log('newMaterial:', materials); // Log the updated sizes array
                    updateMaterialBadges(modalSelectedMaterialsDiv);
                    newMaterialInput.value = '';
                }
            });

            saveMaterialBtn.addEventListener('click', function() {
                updateMaterialBadges(selectedMaterialsDiv);
                materialInput.value = materials.join(', ');
                materialModal.hide();
            });




            // Handle category selection (unchanged)
            subcategorySelect.addEventListener('change', function() {
                const selectedsubCategoryId = this.value;
                subCategoryId = selectedsubCategoryId;
            });

            // Fetch categories

            // url changing for testing the original one is below
            //https://smartprintsa.com/api/getAllCategories


            fetch('https://smartprintsa.com/api/getAllCategories', {
                    // fetch('https://smartprintsa.com/api/getAllCategories', {
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

            // const form = document.querySelector('form');
            // const addProductButton = form.querySelector('button[type="submit"]');

            // addProductButton.addEventListener('click', function(event) {
            //     event.preventDefault();

            //     // Collect form data
            //     const name = document.getElementById('name').value;
            //     const price = document.getElementById('price').value;
            //     const side = document.getElementById('side').value;
            //     const category_id = document.getElementById('category').value;


            //     // Use a Set to merge and eliminate duplicates in sizes and materials
            //     const mergedSizes = [...new Set(sizes)]; // Combine previous and new sizes
            //     const mergedMaterials = [...new Set(materials)]; // Combine previous and new materials

            //     // Log to ensure we have the correct final size and material arrays
            //     console.log("Final Sizes before submitting:", mergedSizes);
            //     console.log("Final Materials before submitting:", mergedMaterials);

            //     // const size = sizes;
            //     // const material = materials;
            //     const attributes = attributeData;

            //     const imageInput = document.getElementById('image');


            //     const newImages = Array.from(imageInput.files).map(file => file);
            //     console.log('newImages:', newImages);


            //     const productData = {
            //         name,
            //         price,
            //         size: mergedSizes, // Use merged sizes
            //         side,
            //         material: mergedMaterials, // Use merged materials
            //         category_id,
            //         newImages,
            //         attributes,
            //         subCategoryId,
            //     };
            //     console.log("productData", productData);


            //     const formData = new FormData();

            //     formData.append('name', productData.name);
            //     formData.append('price', productData.price);


            //     // Ensure merged sizes and materials are appended correctly
            //     mergedSizes.forEach(s => formData.append('size[]', s)); // Append sizes
            //     mergedMaterials.forEach(m => formData.append('material[]', m)); // Append materials

            //     formData.append('side', productData.side);
            //     formData.append('category_id', productData.category_id);
            //     formData.append('subcategory_id', productData.subCategoryId);
            //     // Append attributes in the required format
            //     // productData.newImages.forEach(image => {
            //     //     formData.append('images[]', image)

            //     // });

            //     productData.newImages.forEach(image => {
            //         formData.append('images[]', image)

            //     });



            //     // attributes.forEach((attribute, index) => {
            //     //     formData.append(`attributes[${index}][name]`, attribute.name);
            //     //     attribute.values.forEach(value => {
            //     //         formData.append(`attributes[${index}][value][]`, value);
            //     //     });
            //     // });


            //     // Send the form data to the API via a POST request
            //     fetch('https://smartprintsa.com/api/updateProduct/' + pageId, {
            //             // fetch('https://smartprintsa.com/api/getSingleProduct', {
            //             method: 'POST',
            //             headers: {
            //                 'Authorization': `Bearer ${localStorage.getItem('admin-token')}`
            //             },
            //             // formData
            //             body: formData
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error(`HTTP error! status: ${response.status}`);
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             console.log('Product successfully added:', JSON.stringify(data));
            //             alert('Product added successfully!');
            //             form.reset(); // Reset the form
            //             window.location.href = "/admin/product";

            //             // Clear sizes and materials
            //             sizes = [];
            //             materials = [];
            //             updateSizeBadges(selectedSizesDiv);
            //             updateMaterialBadges(selectedMaterialsDiv);


            //             // Clear uploaded images
            //             imageInput.value = '';
            //         })
            //         .catch(error => {
            //             console.error('Error adding product:', error);
            //             alert('Unable to add product. Please try again.');
            //         });
            //     console.log("formData updated", formData);
            // });


            const form = document.querySelector('form');
            const addProductButton = form.querySelector('button[type="submit"]');

            addProductButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Collect form data
                const name = document.getElementById('name').value;
                const price = document.getElementById('price').value;
                const side = document.getElementById('side').value;
                const category_id = document.getElementById('category').value;

                // Use a Set to merge and eliminate duplicates in sizes and materials
                const mergedSizes = [...new Set(sizes)]; // Combine previous and new sizes
                const mergedMaterials = [...new Set(materials)]; // Combine previous and new materials

                // Log to ensure we have the correct final size and material arrays
                console.log("Final Sizes before submitting:", mergedSizes);
                console.log("Final Materials before submitting:", mergedMaterials);

                const imageInput = document.getElementById('image');
                const newImages = Array.from(imageInput.files).map(file => file);

                const productData = {
                    name,
                    price,
                    size: mergedSizes, // Use merged sizes
                    side,
                    material: mergedMaterials, // Use merged materials
                    category_id,
                    newImages,
                    subCategoryId,
                    imageAddresses,
                };

                console.log("productdata", JSON.stringify(productData));
                const formData = new FormData();
                formData.append('name', productData.name);
                formData.append('price', productData.price);
                productData.size.forEach(s => formData.append('size[]', s)); // Append sizes
                productData.material.forEach(m => formData.append('material[]', m)); // Append materials
                formData.append('side', productData.side);
                formData.append('category_id', productData.category_id);
                formData.append('subcategory_id', productData.subCategoryId);
                // // Append attributes in the required format
                productData.newImages.forEach(image => {
                    formData.append('images[]', image)
                });
                // // Ensure merged sizes and materials are appended correctly
                // mergedSizes.forEach(s => formData.append('size', s)); // Append sizes
                // mergedMaterials.forEach(m => formData.append('material', m)); // Append materials
                
                // Append sizes with array notation
                // productData.size.forEach(size => {
                    console.log("0------------------------0");
                formData.append('size[]', sizes); // Use 'size[]' as the key
                // });

                // // Append materials with array notation
                // productData.material.forEach(material => {
                formData.append('material[]', materials); // Use 'material[]' as the key
                // });

                formData.append('side', productData.side);
                formData.append('category_id', productData.category_id);
                formData.append('subcategory_id', productData.subCategoryId);

                // Append images
                productData.newImages.forEach(image => {
                    formData.append('images[]', image);
                });
                productData.imageAddresses.forEach(address => {
                    formData.append('previous_images[]', address)
                });



                // attributes.forEach((attribute, index) => {
                //     formData.append(`attributes[${index}][name]`, attribute.name);
                //     attribute.values.forEach(value => {
                //         formData.append(`attributes[${index}][value][]`, value);
                //     });
                // });

          
                


                // Send the form data to the API via a POST request
                // url changing for testing the original one is below
                //https://smartprintsa.com/api/updateProduct/

                fetch('https://smartprintsa.com/api/updateProduct/' + pageId, {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('admin-token')}`
                        },
                        body: formData // Pass the FormData here
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Product successfully Updated:', JSON.stringify(data));
                        alert('Product Updated successfully!');
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
                        console.error('Error Edit product:', error);
                        alert('Unable to Edit product. Please try again.');
                    });

                console.log("FormData after appending:", formData);
   
        });


    });
        //calling in DOM single product api

       
    </script>
</section>