    var updateOutput = function () {
        $('#nestable-output').val(JSON.stringify($('#nestable').nestable('serialize')));
    };
    $("body").delegate(".item-edit, .item-close", "click", function (e) {
        var item_setting = $(this).closest(".dd-item").find(".item-settings");
        if (item_setting.hasClass("d-none")) {
            item_setting.removeClass("d-none");
        } else {
            item_setting.addClass("d-none");
        }
    })
    $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("label", $(this).val());
        $(this).closest(".dd-item").children(".dd3-content").find('span').text($(this).val());
    });

    $("body").delegate("input[name='navigation_url']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("url", $(this).val());
    });
    $("body").delegate("input[name='attr_class']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("attr_class", $(this).val());
    });
    $("body").delegate("input[name='attr_id']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("attr_id", $(this).val());
    });
    $("body").delegate(".item-delete", "click", function (e) {
        let res = true;
        if ($(this).closest(".dd-item").find('ol').length > 0)
            res = confirm('Deleteing parent menu will cause its child to deleted');

        if (res) {        
            $(this).closest(".dd-item").data("delete", true);
            updateOutput();
            $(this).closest(".dd-item").remove();
        }
    });
    $('#nestable').nestable().on('change', updateOutput);
    updateOutput();


    function addLink(label, url) {
        if ((url == "") || (label == "")) return;
        var item =
            '<li class="dd-item dd3-item" data-label="' + label + '" data-url="' + url + '">' +
            '<div class="dd-handle dd3-handle" > Drag</div>' +
            '<div class="dd3-content"><span>' + label + '</span>' +
            '<div class="item-edit">Edit</div>' +
            '</div>' +
            '<div class="item-settings d-none">' +
            '<p><label for="">Navigation Label<br><input class="form-control" type="text" name="navigation_label" value="' + label + '"></label></p>' +
            '<p><label for="">Navigation Url<br><input class="form-control" type="text" name="navigation_url" value="' + url + '"></label></p>' +
            '<p><label for="">Custom Class<br><input type="text" class="form-control" name="attr_class" value=""></label></p>'+
            '<p><label for="">Custom ID<br><input type="text" class="form-control" name="attr_id" value=""></label></p>'+
            '<p><a class="item-delete" href="javascript:;">Remove</a> |' +
            '<a class="item-close" href="javascript:;">Close</a></p>' +
            '</div>' +
            '</li>';
 
        $("#nestable > .dd-list").append(item);
        $("#nestable").find('.dd-empty').remove();
        updateOutput();
    };

    function addCustomLink(){
        let label = $('#label').val();
        let url = $('#url').val();
        if ((url == "") || (label == "")) {
            $('#custom_link_error').text('Fields Rquired');
            $('#custom_link_error').fadeIn();       
        }
        else{
            $('#custom_link_error').fadeOut();            
            addLink(label, url);
        }

    }