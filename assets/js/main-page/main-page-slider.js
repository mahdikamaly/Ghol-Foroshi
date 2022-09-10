$('.recent-products-body').slick({
    arrows: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    prevArrow: '<iconify-icon icon="akar-icons:chevron-left"></iconify-icon>',
    nextArrow: '<iconify-icon icon="akar-icons:chevron-right"></iconify-icon>',
});

$('.category-posts-body').slick({
    arrows: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    prevArrow: '<iconify-icon icon="akar-icons:chevron-left"></iconify-icon>',
    nextArrow: '<iconify-icon icon="akar-icons:chevron-right"></iconify-icon>',
});


$('.todays-product').slick({
    dots: false,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear' ,
    prevArrow: '<iconify-icon icon="akar-icons:chevron-left"></iconify-icon>',
    nextArrow: '<iconify-icon icon="akar-icons:chevron-right"></iconify-icon>',
  });
