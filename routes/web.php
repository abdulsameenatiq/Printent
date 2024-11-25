<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProductControllerTest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Route::get('/', function () {
//     return view('home', [NavbarController::class, 'categories']);
// });
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [AuthController::class, 'create'])->name('signup.post');

// Route::get('/about', function () {
//     return view('about');  // Adjust according to the actual filename
// })->name('about');

Route::get('/termsofservice', function () {
    return view('termsofservice');  // Adjust according to the actual filename
})->name('termsofservice');



Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('checkout.success');

Route::get('/', function () {
    $navbarController = new NavbarController();
    $navItems = $navbarController->categories();

    return view('home', compact('navItems'));
});

// Route::get('/products', function () {
//     return view('products');
// });

Route::get('/', function () {
    return view('home');
})->name('home');

// Categories Page
Route::get('/category', function () {
    return view('category');
})->name('category');

// Products Page
Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/track-order', function () {
    return view('trackorder');
})->name('trackorder');

Route::get('/get-qoute', function () {
    return view('getQoute');
});



Route::get('/enquiry', function () {
    return view('directorder');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/privacypolicy', function () {
    return view('privacypolicy');
});

Route::get('/trust-safety', function () {
    return view('trustSafety');
});

Route::get('/terms-service', function () {
    return view('termsandservice');
});

Route::get('/category/{id}', function ($id) {
    return view('category', ['id' => $id]);
});

Route::get('/my-designs', function () {
    return view('my-designs');
});
Route::get('/order-history', function () {
    return view('order-history');
});
Route::get('/past-orders', function () {
    return view('past-order');
});
Route::get('/payment', function () {
    return view('payment');
});
Route::get('/personal-profile', function () {
    return view('profile');
});

Route::get('/productdetail', function () {
    return view('productDetail');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/product/{id}', function () {
    return view('productDetail');
});

Route::get('/shipping-address', function () {
    return view('shipping');
});


Route::prefix('admin')->group(function () {
    // Route::get('/', function () {
    //     return view('admin.dashboard');
    // });

    Route::get('/', function () {
        return view('/admin/login');
    });
    Route::get('/login', function () {
        return view('admin.login');
    });
    Route::get('/product', function () {
        return view('admin.product');
    });
    Route::get('/new-product', function () {
        return view('admin.newProduct');
    });
    Route::get('/edit-product/{id}', function () {
        return view('admin.editProduct');
    });
    Route::get('/category', function () {
        return view('admin.category');
    });

    Route::get('/new-category', function () {
        return view('admin.newCategory');
    });

    Route::get('/edit-category', function () {
        return view('admin.editCategory');
    });

    Route::get('/subCategory', function () {
        return view('admin.subCategory');
    });

    Route::get('/edit-subCategory', function () {
        return view('admin.editSubCategory');
    });

    Route::get('/new-subCategory', function () {
        return view('admin.newSubCategory');
    });
    Route::get('/order', function () {
        return view('admin.order');
    });
    Route::get('/quote', function () {
        return view('admin.quote');
    });
    Route::get('/direct-order', function () {
        return view('admin.direct');
    });
});

Route::get('/products/{id}', [ProductControllerTest::class, "showSingle"]);

Route::get('/get-qoute/{service}', function () {
    return view('getQoute');
});

Route::get('/track-order', function () {
    return view('trackOrder');
});
Route::get('/enquiry', function () {
    return view('enquiryForm');
});
