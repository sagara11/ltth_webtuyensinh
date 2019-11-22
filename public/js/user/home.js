function openNav() {
    document.getElementById("Sidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}

function openSearch() {
    document.getElementById("searchbar").style.display = "block";
}

$(document).mouseup(function (e)
                    {
  var container = $("#searchbar"); // YOUR CONTAINER SELECTOR

  if (!container.is(e.target) // if the target of the click isn't the container...
      && container.has(e.target).length === 0) // ... nor a descendant of the container
  {
    container.hide();
  }
});

$(document).ready(function() {
    $(".header-news").marquee({
        //speed in milliseconds of the marquee
        duration: 16000,
        //gap in pixels between the tickers
        gap: 50,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: "left",
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true
    });
});
