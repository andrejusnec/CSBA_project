let $container = $('.add-to-wishlist');
$container.find('.wishListAdd').on('click', function (e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
    $.ajax({
        url: '/wishlists/' + $link.data('add') + '/' + $link.data('user'),
        method: 'POST',
    })
});

let $counter = $('body');
let $cont = $('.add-to-cart');
$cont.find('.addToCart').on('click', function (e) {
    e.preventDefault();
    let $link = $(e.currentTarget);

    if ($link.data('secret')) {
        let fromWishList = $link.data('secret');
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user') + '/' + fromWishList,
            method: 'POST',
        }).then(function (response) {
            $counter.find('.cart_count_total').text(response.cart_count);
            location.reload();
        })
    } else {
        $.ajax({
            url: '/cart_add/' + $link.data('product') + '/' + $link.data('user'),
            method: 'POST',
        }).then(function (response) {
            $counter.find('.cart_count_total').text(response.cart_count);
        })
    }
});


let $cartContainer = $('.cart-item-full');
let $test = $cartContainer.find('.current-amount').on('change', function (e) {
    e.preventDefault();
    let $linkas = $(e.currentTarget);
    return $linkas.data('counter');
});

$cartContainer.find('.cart-amount').on('click', function (e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
    $.ajax({
        url: '/cart_quantity/' + $link.data('product') + '/' + $link.data('user') + '/' + $link.data('direction'),
        method: 'POST'
    }).then(function (response) {
        let cart = $link.data('cart'); //getting data-cart value
        let price = parseFloat(response.cart);
        price = price.toFixed(2);
        let quantityInStock = $test.data('counter');
        let selectorsss = $('#' + quantityInStock);
        if (selectorsss.val() > response.currentAmountInCart) {
            $('.btn-plus').attr("disabled", true);
        } else {
            $('.btn-plus').attr("disabled", false);
        }
        selectorsss.val(response.currentAmountInCart);
        $('#' + cart).text('€' + price);
    })

});

function check($link) {
    let $xxx = $('.cart-item-full');
    $xxx.find('.cart-amount').addEventListener('mousedown', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/cart_quantity/' + $link.data('product') + '/' + $link.data('user') + '/' + $link.data('direction'),
            method: 'POST'
        }).then(function (response) {
            let quantityInStock = $test.data('counter');
            let selectorsss = $('#' + quantityInStock);
            if (selectorsss.val() > response.currentAmountInCart) {
                $('.btn-plus').attr("disabled", true);
            } else {
                $('.btn-plus').attr("disabled", false);
            }
        })
    })
}

// let $kintamasis = $('#myUL');
// $kintamasis.find('.test').on('click', function (e) {
//     e.preventDefault();
//     let $linkas = $(e.currentTarget);
//         $.ajax({
//             url: '/test/' + $linkas.data('test'),
//             method: 'POST',
//         }).then(function (response) {
//             console.log(response)
//         })
//     })
// function myFunction(data)
// {
//     let result = "";
//     for (var i = 0; i < data.length; i++)
//     {
//         result += 'NAME: ' + data[i].name + ', AGE: ' + data[i].age + '<br/>';
//     }
//     $('#info').html(result)

