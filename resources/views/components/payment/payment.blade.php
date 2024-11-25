<!-- resources/views/payment.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STC Pay Integration with Moyasar</title>

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />

    <!-- Polyfill and Moyasar Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/polyfill/3.52.1/polyfill.min.js"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
</head>

<body>

    <!-- Button to trigger the payment form -->
    <button onclick="initiateSTCPayment()">Pay with STC Pay</button>

    <!-- Moyasar Payment Form -->
    <div class="mysr-form" style="display: none;"></div>

    <script>
        function initiateSTCPayment() {

            console.log("Proceed to Pay button clicked");
            document.querySelector('.mysr-form').style.display = 'block';

            Moyasar.init({
                element: '.mysr-form',
                amount: 1000, // Amount in smallest currency unit (1000 Halalas = 10 SAR)
                currency: 'SAR',
                description: 'Order Payment',
                publishable_api_key: '{{ env("MOYASAR_PUBLISHABLE_KEY") }}', // Use environment variable for the key
                methods: ['stcpay'],
                callback_url: '{{ route("payment.success") }}', // Laravel route for post-payment callback

                on_completed: function (payment) {
                    verifyPayment(payment.id).then(result => {
                        if (result.success) {
                            window.location.href = '{{ route("checkout.success") }}';
                        } else {
                            alert('Payment verification failed, please try again.');
                        }
                    }).catch(() => {
                        alert('An error occurred during payment verification.');
                    });
                }
            });
        }

        async function verifyPayment(paymentId) {
            const response = await fetch('{{ route("payment.verify") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ paymentId })
            });
            return response.json();
        }
    </script>
</body>

</html>