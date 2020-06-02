function showCart(cart) {
 $('#modalCart .modal-body').html(cart);
 $('#modalCart').modal();
}

$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});

$('.add-to-cart').on('click', function (e) {
    let link = $('.add-to-cart');
    e.preventDefault();
    let id = $(this).data('id');
    let count = $('#count').val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, count: count},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Error');
            console.log(res);
            showCart(res);
        },
        error: function () {
            alert('Warning');
        },
    });
});


function clearCart() {

    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Error');
            showCart(res);
        },
        error: function () {
            alert('Warning');
        },
    });
}
