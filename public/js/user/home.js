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
    $(window).scroll(function() {
        localStorage.setItem("scroll", true);
        console.log('scr');
        if( ( $(window).scrollTop() + $(window).height()  ) === $(document).height()) {
            var last_id = $("#baiviet-tintuc .baiviet-box:last").attr("id");
            $('html, body').stop().animate({
                scrollTop: $(document).height() -100
            }, 100);

            loadMoreData(last_id);
            
            
        }
    });
});


function loadMoreData(last_id){
    // var category_id = $('#category_id').val();
    // var name = $('#s').val();
    $.ajax(
    {
        url: '/loadmore',
        type: "get",
        data:{
            last_id : last_id,
            // category: category_id,
            // name: name,
        },
        beforeSend: function()
        {
            // $('.ajax-load').show();
        }
    })
    .done(function(data)
    {
        var data = $.parseJSON(data);
        console.log('---------------');
        $('#baiviet-tintuc').append(data.html);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
          alert('server not responding...');
    });
}

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
