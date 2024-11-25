<ul id="navbarCategories">
    <!-- Categories will be added here dynamically -->
</ul>

<script>
    // JavaScript to make API request and display categories in the navbar

    const fetchCategories = async () => {
        const token = localStorage.getItem('jwt_token'); // Retrieve the token from local storage
        console.log(token);

        if (!token) {
            console.error('Token not found');
            return;
        }

        try {
            const response = await fetch('https://smartprintsa.com/api/getAllCategories', {
                method: 'GET',
                headers: {
                    'Authorization': `bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                // console.log(data);

                const categories = data.categories;

                const navbar = document.getElementById('navbarCategories');
                const categoryLinks = categories.map(category => `<li class="nav-link">${category.name}</li>`)
                    .join('');
                navbar.innerHTML = categoryLinks;
            } else {
                console.error('Failed to fetch categories', response.statusText);
            }
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    };

    // Call the function to fetch and display categories
    fetchCategories();
</script>