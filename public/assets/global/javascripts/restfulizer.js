// restfulizer.js

/**
 * Restfulize any hiperlink that contains a data-method attribute by
 * creating a mini form with the specified method and adding a trigger
 * within the link.
 * Requires jQuery!
 *
 * Ex:
 *     <a href="post/1" data-method="delete">destroy</a>
 *     // Will trigger the route Route::delete('post/(:id)')
 *
 */
$(function(){
    $('[data-method]').append(function(){
        var token = function() {
          if ($('input[name="_token"]').length > 0) {
            return '<input name="_token" type="hidden" value="' + $('input[name="_token"]').val() + '">';
          } else return '';
        };
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        token()+"\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor:pointer;')
    .attr('onclick','$(this).find("form").submit();');
});

//generate permalink
function productNameTextOnChange(value)
{
    var string = value.toLowerCase();
    //Make alphanumeric (removes all other characters)
    string = string.replace(/[^a-z0-9_\s-]/g, "-");
    //Clean up multiple dashes or whitespaces
    string = string.replace(/[\s-]+/g, "-");
    //Convert whitespaces and underscore to dash
    string = string.replace(/[\s_]/g, "-");

    $('#product_permalink').val(string); 
}

function formGeneral()
{
    $(".chzn-select").chosen();
    $(".chosen-select-deselect").chosen({
        allow_single_deselect: true
    });

    $(document).ready(function(){

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            update : function () {
                var sortValue = $(this).nestedSortable('getValue');
                if(sortValue != "")
                {
                    $.ajax({
                      type: "POST",
                      url: "/admin/category/management-sorting-category",
                      data: {categories:sortValue},
                    })
                }
            }
        });

    });
}

function chooseParentCategoryOnChanged(value)
{
    if(value == 0)
    {
        document.getElementById('chooseSortCategory').style.display = 'block';
    }
    else
    {
        document.getElementById('chooseSortCategory').style.display = 'none';
    }
}