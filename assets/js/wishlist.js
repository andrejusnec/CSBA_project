
let $container = $('.add-to-wishlist');
$container.find('.wishListAdd').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
    $.ajax({
        url:'/wishlists/'+$link.data('add')+'/'+$link.data('user'),
        method: 'POST',
    })
});

let $counter = $('body');
let $cont = $('.add-to-cart');
$cont.find('.addToCart').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);

    if($link.data('secret')) {
        let fromWishList = $link.data('secret');
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user')+'/'+fromWishList,
            method: 'POST',
        }).then(function (response){
            $counter.find('.cart_count_total').text(response.cart_count);
        })
    } else {
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user'),
            method: 'POST',
        }).then(function (response){
            $counter.find('.cart_count_total').text(response.cart_count);
        })
    }
});


let $cartContainer = $('.cart-item-full');
$cartContainer.find('.cart-amount').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
        $.ajax({
            url: '/cart_quantity/' + $link.data('product') + '/' + $link.data('user')+'/'+$link.data('direction'),
            method: 'POST'
        }).then(function (response){
            let cart = $link.data('cart');
            let price = parseFloat(response.cart);
            price = price.toFixed(2);
            $('#'+cart).text('€'+price);
        })

});