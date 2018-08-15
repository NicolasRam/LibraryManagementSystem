$( document ).ready(function() {
    $.ajax({
        method: 'GET',
        url: 'http://54.36.182.3/lms/public/index.php/api/books',
        // url: 'https://lms-library-management-s-c0b6b.firebaseio.com/book.json?auth=55LnjVb52U871YZFcdIWW57q2tVeeKzCA98T0yhc&limitToFirst=10&orderBy="$key"',
        // data: 'number='+$(this).data('number')
    }).done(function (response) {
        // $('#tg-bestsellingbooksslider').empty();
        // console.log(response);

        console.log('<div class="item">' +
            '<div class="tg-postbook">' +
            '<figure class="tg-featureimg">' +
            '<div class="tg-bookimg">' +
            '<div class="tg-frontcover"><img src="image_url" alt="image description"></div>' +
            '<div class="tg-backcover"><img src="image_url" alt="image description"></div>' +
            '</div>' +
            '<a class="tg-btnaddtowishlist" href="javascript:void(0);">' +
            '<i class="icon-heart"></i>' +
            '<span>add to wishlist</span>' +
            '</a>' +
            '</figure>' +
            '<div class="tg-postbookcontent">' +
            '<ul class="tg-bookscategories">' +
            '<li><a href="javascript:void(0);">Adventure</a></li>' +
            '<li><a href="javascript:void(0);">Fun</a></li>' +
            '</ul>' +

            '<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>' +

            '<div class="tg-booktitle">' +
            '<h3><a href="javascript:void(0);">title</a></h3>' +
            '</div>' +

            '<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>' +

            '<span class="tg-stars"><span></span></span>' +

            '<span class="tg-bookprice">' +
            '<ins>$25.18</ins>' +
            '<del>$27.20</del>' +
            '</span>' +
            '<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">' +
            '<i class="fa fa-shopping-basket"></i>' +
            '<em>Add To Basket</em>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>');
        $.each( response, function(index) {


            $('#tg-bestsellingbooksslider').append(
                '<div class="item">' +
                '<div class="tg-postbook">' +
                '<figure class="tg-featureimg">' +
                '<div class="tg-bookimg">' +
                '<div class="tg-frontcover"><img src="' + response[index].image + '" alt="image description"></div>' +
                '<div class="tg-backcover"><img src="' + response[index].image + '" alt="image description"></div>' +
                '</div>' +
                '<a class="tg-btnaddtowishlist" href="javascript:void(0);">' +
                '<i class="icon-heart"></i>' +
                '<span>add to wishlist</span>' +
                '</a>' +
                '</figure>' +
                '<div class="tg-postbookcontent">' +
                '<ul class="tg-bookscategories">' +
                '<li><a href="javascript:void(0);">Adventure</a></li>' +
                '<li><a href="javascript:void(0);">Fun</a></li>' +
                '</ul>' +

                '<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>' +

                '<div class="tg-booktitle">' +
                '<h3><a href="javascript:void(0);">' + response[index].title + '</a></h3>' +
                '</div>' +

                '<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>' +

                '<span class="tg-stars"><span></span></span>' +

                '<span class="tg-bookprice">' +
                '<ins>$25.18</ins>' +
                '<del>$27.20</del>' +
                '</span>' +
                '<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">' +
                '<i class="fa fa-shopping-basket"></i>' +
                '<em>Add To Basket</em>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        });
    });
});

/*
$('.button-ajax').click(function () {
    $.ajax({
        method: 'POST',
        url: '/',
        data: 'number='+$(this).data('number')
    }).done(function (response) {
        var number = response.number;
        $('#number').text(parseInt($('#number').text())+number);
    });
});

setInterval(function () {
    $.ajax({
        method: 'POST',
        url: '/',
        data: 'number='+parseInt(10*Math.random())
    }).done(function (response) {
        var number = response.number;
        $('#number').text(parseInt($('#number').text())+number);
    });
}, 1000);
*/