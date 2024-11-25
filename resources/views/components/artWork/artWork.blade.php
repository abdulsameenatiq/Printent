<!-- artWork.blade.php -->
@include('components.modals.UploadDesignModal')

<section class="container">
    @include('components.artWork.artWorkUploadSelection')
    @include('components.artWork.artWorkUploadInput')
    @include('components.artWork.artWorkAddToCart')
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="customRadio"]');
        const containers = document.querySelectorAll('.contan');

        function showContainer(containerId) {
            containers.forEach(container => {
                if (container.id === containerId) {
                    container.classList.remove('d-none');
                    container.classList.add('active');
                } else {
                    container.classList.add('d-none');
                    container.classList.remove('active');
                }
            });
        }

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.id === 'radio1') {
                    showContainer('container1');
                } else if (this.id === 'radio2') {
                    showContainer('container2');
                } else if (this.id === 'radio3') {
                    showContainer('container3');
                }
            });
        });

        // Set default active container
        showContainer('container1');
    });
</script>
