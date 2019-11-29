function openNav() {
    $('#Sidenav').show();
    document.getElementById("Sidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    $('#Sidenav').hide();
    document.getElementById("Sidenav").style.width = "0";
}

function openSearch() {
    $(".searchbar").show();
}

$(document).mouseup(function(e) {
    var container = $(".searchbar"); // YOUR CONTAINER SELECTOR

    if (
        !container.is(e.target) && // if the target of the click isn't the container...
        container.has(e.target).length === 0
    ) {
        // ... nor a descendant of the container
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

$(document).ready(function() {
    $('.send').click(function() {
        var parent_id = $(this).attr('id');
        var comment = $('#comment'+parent_id).val();
        var token = $('#token').val();
        
        if(comment) {
            $.ajax({
                type: 'post',
                url: '/admin/comments/add',
                headers: { 'X-XSRF-TOKEN' : token },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                data: {type: 'ajax', _csrfToken : token},
                data: {comment: comment, parent_id: parent_id},
                success: function(response) {
                    var res = $.parseJSON(response);
                    if(!res.status) {
                        return;
                    }
                    location.reload(true);
                },
            });        
        }
    });
    $('.response').click(function() {
        var id = $(this).attr('id');
        $('#comment'+id).focus();
    })
});
