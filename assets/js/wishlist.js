
let $container = $('.add-to-wishlist');
$container.find('.wishListAdd').on('click', function(e) {
    e.preventDefault();
    let $link = $(e.currentTarget);
    console.log($link);
    $.ajax({
        url:'/wishlists/'+$link.data('add')+'/'+$link.data('user'),
        method: 'POST',
    })
});