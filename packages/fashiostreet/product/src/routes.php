<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('adminOrders','fashiostreet\product\OrderController@adminOrders');

    Route::get('coupons','fashiostreet\product\UserController@coupons');

    Route::get('checkCoupon/{mobile}/{code}','fashiostreet\product\UserController@checkCoupon');

    Route::post('saveCoupon','fashiostreet\product\UserController@saveCoupon');

    Route::post('addSpoonToCart','fashiostreet\product\CartController@addSpoonToCart');

    Route::post('changeOrderStatus','fashiostreet\product\OrderController@changeOrderStatus');

    Route::post('saveOrder','fashiostreet\product\UserController@saveOrder');

    Route::post('deleteQtyFromCartWithoutCheese','fashiostreet\product\CartController@deleteQtyFromCartWithoutCheese');

    Route::post('deleteQtyFromCartWithCheese','fashiostreet\product\CartController@deleteQtyFromCartWithCheese');

    Route::post('deleteMenuFromCartWithoutCheese','fashiostreet\product\CartController@deleteMenuFromCartWithoutCheese');

    Route::post('deleteMenuFromCartWithCheese','fashiostreet\product\CartController@deleteMenuFromCartWithCheese');

    Route::post('addMenuToCartWithoutCheese','fashiostreet\product\CartController@addMenuToCartWithoutCheese');

    Route::post('addMenuToCartWithCheese','fashiostreet\product\CartController@addMenuToCartWithCheese');

    Route::get('getDiscountNo/{mobile}','fashiostreet\product\UserController@getDiscountNo');

    Route::get('offerBanners','fashiostreet\product\ViewController@getOfferBanners');

    Route::get('getUserDiscount/{mobile}','fashiostreet\product\UserController@getUserDiscount');

    Route::get('getUserOfferNumber/{mobile}','fashiostreet\product\UserController@getUserOfferNumber');

    Route::post('deliveredOrder','fashiostreet\product\OrderController@deliveredOrder');

    Route::get('/user/address/{json?}/{mobile}','fashiostreet\product\AddressController@getAddress');

    Route::post('user/deleteaddress','fashiostreet\product\AddressController@deleteAddress');

    Route::post('user/editAddress','fashiostreet\product\AddressController@editAddress');

    Route::post('/user/placeOrder','fashiostreet\product\OrderController@addOrder');

    Route::post('cancelOrder','fashiostreet\product\OrderController@cancelUserOrder');

    Route::get('/usersOrders/{mobile}','fashiostreet\product\OrderController@usersOrders');

    Route::post('/user/addAddress','fashiostreet\product\AddressController@addAddress');

    Route::post('/getAppLink','fashiostreet\product\CityController@sendAppLink');

    Route::post('addToCart','fashiostreet\product\CartController@addMenuToCart');

    Route::post('addToCart1','fashiostreet\product\CartController@addMenuToCart1');

    Route::post('deleteMenuFromCart','fashiostreet\product\CartController@deleteMenuFromCart');

    Route::post('addToCart2','fashiostreet\product\CartController@addMenuToCart2');

    Route::post('deleteMenuFromCart2','fashiostreet\product\CartController@deleteMenuFromCart2');

    Route::get('getUserCart/{mobile}','fashiostreet\product\CartController@getUserCart');

    Route::get('/testing/{city}','fashiostreet\product\ViewController@city_offer');

    Route::get('/getShopContact/{shop_name}','fashiostreet\product\ShopController@getShopContact');

    Route::get('/menSuperDiscountedProducts/{city}','fashiostreet\product\ViewController@getMenSuperDiscountedProducts');

    Route::post('/footwearSuperDiscountedProducts/{city}','fashiostreet\product\ViewController@getFootwearSuperDiscountedProducts');

    Route::post('saveFeedback','fashiostreet\product\UserController@saveFeedback');

    Route::get('getAppVersion','fashiostreet\product\ViewController@getAppVersion');

    Route::get('/shop/{city}/trending','fashiostreet\product\ShopController@getTrendingShops');

    Route::get('/trendingInnerwear/{city}','fashiostreet\product\ViewController@getTrendingInnerwear');

    Route::get('/trendingJeans/{city}','fashiostreet\product\ViewController@getTrendingJeans');

    Route::get('/trendingTShirts/{city}','fashiostreet\product\ViewController@getTrendingTShirts');

    Route::get('/trendingShirts/{city}','fashiostreet\product\ViewController@getTrendingShirts');

    Route::get('/trendingKurtis/{city}','fashiostreet\product\ViewController@getTrendingKurtis');

    Route::get('/trendingCasualShoes/{city}','fashiostreet\product\ViewController@getTrendingCasualShoes');

    Route::get('/trendingChappals/{city}','fashiostreet\product\ViewController@getTrendingChappals');

    Route::get('/trendingSandals/{city}','fashiostreet\product\ViewController@getTrendingSandals');

    Route::get('/offers/{shop_name}/{page}','fashiostreet\product\ViewController@offers_shop');

    Route::get('/offers/{shop_name}/{category}/{discount}/{page}','fashiostreet\product\ShopController@offers_shop');

    Route::get('/getShopName/{shop_id}','fashiostreet\product\ShopController@getName');

    Route::get('/getlist/{city}','fashiostreet\product\ShopController@getList');

    Route::post('/deleteProduct','fashiostreet\product\ProductController@deleteProduct');

    //Route::post('/priceFilter','fashiostreet\product\ProductController@priceFilter');

    Route::get('shop/{city_name}','fashiostreet\product\ShopController@getShops');

    Route::get('/getGenders/{id}','fashiostreet\product\ShopController@getGenders');

    Route::get('checkShop/{shop_name}','fashiostreet\product\ShopController@checkShop');

    Route::post('/order','fashiostreet\product\OrderController@sendOrderSms');

    Route::get('/saveDiscount/{money}','fashiostreet\product\OrderController@saveDiscount');

    Route::get('/getOrderCashback/{id}','fashiostreet\product\OrderController@getCashback');

    Route::get('/user/getMoney/{mobile}','fashiostreet\product\UserController@getWalletMoney');

    Route::post('/user/addUserWallet/{mobile}','fashiostreet\product\UserController@addUserWallet');

    Route::post('/upcoming','fashiostreet\product\UserController@addUpcomingFeature');

    Route::post('/updateCustomerWallet','fashiostreet\product\UserController@updateMoney'); 

    Route::post('/updateShopWallet','fashiostreet\product\ShopController@updateMoney');

    Route::get('/getShopMoney/{shop_name}','fashiostreet\product\ShopController@getShopMoney');

    Route::get('/getShopWalletMoney/{product_id}','fashiostreet\product\ShopController@getShopWalletMoney');

    Route::post('/updateShopWalletMoney','fashiostreet\product\ShopController@updateShopWalletMoney');

    Route::post('/shop/chat','fashiostreet\product\ShopController@chat');

    Route::post('/shop/call','fashiostreet\product\ShopController@call');

    Route::get('/admin/{city}/{sub_category}/{json?}','fashiostreet\product\ViewController@product_list1');

    Route::post('/shop/whatsapp','fashiostreet\product\ShopController@whatsapp');

    Route::post('visitShop','fashiostreet\product\ShopController@visit');

    Route::post('/specific','fashiostreet\product\OrderController@specificOrder');

    Route::get('/','fashiostreet\product\ViewController@main_page');

    Route::post('sendReferal','fashiostreet\product\UserController@sendReferal');

    Route::post('sendReferMessage','fashiostreet\product\UserController@sendReferMessage');

    Route::get('/tmpjson/leftpanel','fashiostreet\product\ViewController@getLeftJoin');

    Route::get('categories/{shop_name}','fashiostreet\product\ShopController@getCategories');

    Route::prefix('/search')->group(function(){
        /*
         * get city name suggestion
         *  */
        Route::post('/city','fashiostreet\product\CityController@city_search');
        /*
         * get shop name suggestion
         * */
        Route::post('/shop','fashiostreet\product\ShopController@shop_search');
        /*
         * get shop name suggestion
         * */
        Route::post('/product','fashiostreet\product\ProductController@product_search');
    });


    Route::prefix('/shop')->group(function (){

        Route::post('/json','fashiostreet\product\ShopController@shop_name_list');

        Route::post('/json1','fashiostreet\product\ShopController@shop_name_list1');

        Route::get('/shopOffers/{city_name}','fashiostreet\product\ShopController@shopOfferBanners');
        /*
        * Get category of that shop
        * */
        Route::get('/{city_name}/available-category/{json?}','fashiostreet\product\ViewController@category_shop');
        /*
         * Get list of shop
         * */
        Route::get('/{city_name}/{json?}','fashiostreet\product\ShopController@shop_list');

        Route::get('/{shop_name}','fashiostreet\product\ShopController@getCategory');

    });

    Route::prefix('/product')->group(function (){

        Route::get('/{city}','fashiostreet\product\ViewController@city_offer');

        Route::get('/{city}/city_offer/json','fashiostreet\product\ViewController@city_offer2');

        /*
            Get Product sizes
        */
        Route::get('/sizes/json','fashiostreet\product\ProductController@getProductSizes');

        Route::get('/topproduct/json','fashiostreet\product\ProductController@top15');
        /*
         * Get product list
         * @ : shop,gender,category (input)
         * */
        Route::get('/{city}/{sub_category}/{json?}','fashiostreet\product\ViewController@product_list');

        //get Search product list
        Route::get('/{city}/search/{q}/{json?}','fashiostreet\product\ProductController@getSearchProduct');
        /*
         * Get product details
         * */
        Route::get('/{city}/{product_name}/{product_id}/buy/{json?}','fashiostreet\product\ProductController@getProduct_full_data');

    });

    Route::prefix('/error')->group(function(){
        Route::get('/500','fashiostreet\product\ViewController@error');
    });



    Route::group(['middleware' => 'checkAuthOut'],function (){
        Route::prefix('/user')->group(function(){

            Route::get('/','fashiostreet\product\UserController@frameView');

            Route::get('/numberOfPromocodeOrders/{mobile}',
                'fashiostreet\product\OrderController@getNumberOfPromocodeOrder');



            

            Route::post('/addtowishlist/{json?}','fashiostreet\product\UserController@add_wishlist');

            Route::post('/deletewishlist/{json?}','fashiostreet\product\UserController@delete_wishlist');

            Route::get('/wishlist/{json?}','fashiostreet\product\UserController@view_wishlist');

            Route::get('/profile/{json?}','fashiostreet\product\UserController@getUser');

            Route::post('/updateProfile','fashiostreet\product\UserController@update_user');

            Route::get('/username','fashiostreet\product\UserController@user_name');

            Route::get('/ordersHistory/{json?}','fashiostreet\product\OrderController@getOrderHistory');


            Route::get('/confirm_address/{json?}','fashiostreet\product\OrderController@confirm_delivery');

            Route::get('/selectAddress/{json?}','fashiostreet\product\AddressController@getAddress')->name('selectName');

            Route::post('/movetocart','fashiostreet\product\CartController@movetowishlist');

            Route::post('/addtocart','fashiostreet\product\CartController@AddToCart');

            Route::post('/removefromcart','fashiostreet\product\CartController@DeleteFromCart');

            Route::get('/viewcart/{json}','fashiostreet\product\CartController@GetFromCart');

            //Route::get('/GetFromCart/{json?}','fashiostreet\product\controller\CartController@GetFromCart');

        });
    });

    Route::post('/allCustomerMsg','fashiostreet\product\CityController@allCustomerMsg');

    Route::post('/hdCartMsg','fashiostreet\product\CityController@hdCartMsg');

    Route::post('/wishlistMsg','fashiostreet\product\CityController@wishlistMsg');

    Route::post('/visitShopMsg','fashiostreet\product\CityController@visitShopMsg');

    Route::post('/callMsg','fashiostreet\product\CityController@callMsg');

    Route::post('/walletMsg','fashiostreet\product\CityController@walletMsg');  

    Route::get('/getAllOrders','fashiostreet\product\CityController@getAllOrders');  

    Route::post('/delivered','fashiostreet\product\CityController@deliveryMessage');  

    Route::post('/cancelled','fashiostreet\product\CityController@cancelledOrder'); 

    Route::post('/restock','fashiostreet\product\CityController@restockProduct');  
});
