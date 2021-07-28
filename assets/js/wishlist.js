
let $container = $('.add-to-wishlist');
$container.find('.wishListAdd').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
    $.ajax({
        url:'/wishlists/'+$link.data('add')+'/'+$link.data('user'),
        method: 'POST',
    })
});
let $cont = $('.add-to-cart');
$cont.find('.addToCart').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);

    if($link.data('secret')) {
        let fromWishList = $link.data('secret');
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user')+'/'+fromWishList,
            method: 'POST',
        })
    } else {
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user'),
            method: 'POST',
        })
    }
});