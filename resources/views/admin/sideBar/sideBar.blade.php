<section class="min-vh-100 sideBar d-flex flex-column">
    <div class="mx-3 sidebar-logo">
        <img id="logo-img" height="45" width="140" class="img-fluid auto_size" src="{{ asset('images/newLogo.svg') }}" alt="logo-img">
    </div>
    <div class="list-group list-group-flush flex-grow-1">
        <!-- <a href="#" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-tachometer-alt"></i> Dashboard
        </a> -->
        <a href="/admin/product" class="list-group-item list-group-item-action aa text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-box-open"></i> Product
        </a>
        <a href="/admin/category" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-tags"></i> Category
        </a>
        <a href="/admin/subCategory" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-tags"></i> Sub Category
        </a>
        <a href="/admin/order" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-shopping-cart"></i> Order
        </a>
        <a href="/admin/quote" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-shopping-cart"></i> Quote
        </a>
        <a href="/admin/direct-order" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-shopping-cart"></i> Direct Order
        </a>
    </div>
    <div class="list-group">
        <a href="#" id="logout-button" class="list-group-item list-group-item-action text-light py-3 d-flex align-items-center gap-3">
            <i style="font-size:18px" class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current path
            const currentPath = window.location.pathname;

            // Get all sidebar links
            const links = document.querySelectorAll('.sideBar .list-group-item');

            // Loop through each link
            links.forEach(link => {
                // Check if link href matches the current path
                if (link.getAttribute('href') === currentPath) {
                    // Add 'active' class to the matching link
                    link.classList.add('active');
                }
            });

            // Logout functionality
            const logoutButton = document.getElementById('logout-button');
            logoutButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior
                localStorage.removeItem('admin-token'); // Remove the token
                window.location.href = '/admin/login'; // Redirect to login page
            });
        });
    </script>
</section>