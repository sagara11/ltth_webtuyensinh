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

$('body').on('click', '.child_rep_comment', function set(){
    $('#input1').val(this.id);
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

    
    // $("#commentsend").submit(function(event){
    //     event.preventDefault();
    //     var post_url = $(this).attr("action");
    //     var request_method = $(this).attr("method");
    //     var form_data = $(this).serialize();
        
    //     $.ajax({
    //         url : post_url,
    //         type: request_method,
    //         data : form_data
    //     }).done(function(response){
    //         $("#server-results").html(response);
    //     });
    // });
});
