$(document).ready(function() 
{
    
    if($('body').width() < 992) {
        $('.main-product').attr('id', 'page-title');
    }
    
    $('#name').rules("add", {
        required:true
    });

    //for active grid or list on product
    if((typeof $.cookie('state') == "undefined") || ($.cookie('state') == "list"))
    {
        $('#grid').removeClass('active');
        $('#list').addClass('active');
        $('#products-grid').hide();
        $('#products-list').show();
    }
    else
    {
        $('#list').removeClass('active');
        $('#grid').addClass('active');
        $('#products-list').hide();
        $('#products-grid').show();
    }

    //list button on product onClick
    $('#list').click(function(event)
    {
        if(!$('#list').hasClass('active')) 
        {
            event.preventDefault();
            $('#products-grid').fadeOut(500, function()
            {
                $('#grid').removeClass('active');
                $('#list').addClass('active');
                $('#products-grid').hide();
                $('#products-list').show();
                $('#products-list').fadeIn(500);
                $.cookie('state', 'list');
            });
        }
    });
    //grid button on product onClick
    $('#grid').click(function(event)
    {
    	if(!$('#grid').hasClass('active')) {
            event.preventDefault();
            $('#products-list').fadeOut(500, function() {
                $('#list').removeClass('active');
                $('#grid').addClass('active');
                $('#products-list').hide();
                $('#products-grid').show();
                $('#products-grid').fadeIn(500);
                $.cookie('state', 'grid');
            });
        }
    });

    //for active state category
    $(function() {
        var currentUrl = window.location.pathname;
        if(typeof currentUrl.split('/')[2] != "undefined")
        {
            $("a[href='" + currentUrl + "#page-title']").closest('div').parent().closest('div').parent().closest('div').collapse().in;
            $("a[href='" + currentUrl + "#page-title']").closest('div').parent().closest('div').collapse().in;
            $("a[href='" + currentUrl + "#page-title']").closest('div').collapse().in;
            $("a[href='" + currentUrl + "#page-title']").closest("div").collapse().in;
        }
    });
});


//image-list on product detail onClick
function imagePreviewClick(image) 
{
    document.getElementById("myImagePrev").src = $('#'+image+'_prev').val();
    document.getElementById("myImagePrevShow").href = $('#'+image+'_prev').val();
}

function categoryOnClick() {
    alert(1);
}