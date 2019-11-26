var main = document.getElementsByTagName("main");
var content = document.getElementById("baiviet-content");
var preview = content.getElementsByClassName('VCSortableInPreviewMode');
var description = document.getElementById("baiviet-description");
var des_a = description.getElementsByTagName("a");
var a_tag = content.getElementsByTagName("a");

function openNav() {
    document.getElementById("Sidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}

function openSearch() {
    document.getElementById("searchbar").style.display = "block";
}

$(document).mouseup(function(e) {
    var container = $("#searchbar");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }
});

$(document).ready(function() {
    for (var i = 0; i < a_tag.length; i++) {
        a_tag[i].removeAttribute("href");
    }
    for (var i = 0; i < des_a.length; i++) {
        des_a[i].parentNode.removeChild(des_a[i]);
    }
    for (var i = 0; i < preview.length; i++) {
        preview[i].style.display = "none";
    }
    $(".header-news").marquee({
        duration: 16000,
        gap: 50,
        delayBeforeStart: 0,
        direction: "left",
        duplicated: true
    });
});
