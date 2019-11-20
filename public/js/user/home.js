function openNav() {
    document.getElementById("Sidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}

function openSearch(){
    document.getElementById("searchbar").style.display = "block";
}

function closeSearch(){
    document.getElementById("searchbar").style.display = "none";
}

$(document).ready(function() {
    $(".header-news").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 800,
          settings: {
            prevArrow: false,
            nextArrow: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        }
      ]
    });
});
