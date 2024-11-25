<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('meta_description', 'Smart provide you to design and customize affordable marketing materials for your business. You can order business cards, flyers, business card, t-shirts, stamps, postcards, invitations, signage, and more.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Online printing shop in Saudi Arabia, digital printing press in Saudi Arabia, business cards Riyadh, offset printing in Saudi Arabia, printing press Dammam, print shop in Riyadh, copy centre in Saudi Arabia, offset printing Jeddah, printing press in Jeddah, print centre in Riyadh.')">
    <title>@yield('title', 'Smart | Online Printing Services in Saudi Arabia - KSA')</title>

    <base href="/public">
    <link rel="stylesheet" href="app.css">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/aos.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontello.css">
    <link rel="stylesheet" type="text/css" href="css/flaticon_printing.css">
    <link rel="stylesheet" type="text/css" href="css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/twentytwenty.css">
    <link rel="stylesheet" type="text/css" href="css/shortcodes.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/megamenu.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- REVOLUTION LAYERS STYLES -->
    <link rel='stylesheet' id='rs-plugin-settings-css' href="revolution/css/rs6.css">
    {{-- <link rel="stylesheet" href="css/tailwind/output.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

@yield('content')

</html>