/* -- variable -- */
var timeout;
/* -- End of Data variable -- */
/* --  Function Call -- */
function set_suggestion_div_width(width){
    $('#suggestion_div').css('width',width);
}
function ajax_call(url,type,load,data,funct){
    $.ajax({
        type: type,
        url: url,
        dataType: 'json',
        data: data,
        success: function (response) {
            if (funct == 'city_suggestion') {
                city_suggestion(load, response);
            }
            else if(funct == 'logout_funct')
            {
                logout_funct(load,response);
            }
        },
        error: function (request, status, error) {
            if(request.responseText == "\"User Already Login\"")
            {
                window.location.href = '/Auth/login';
            }
        }
    });
}

function city_suggestion(load,response){
    var view = '';

    if(response == "No Result Found")
    {
        view = view + '<div><a href="javascript:void(0)" style="color:red">Sorry! We don\'t serve at your location currently.</a></div>';
    }
    else {
        for (var i = 0; i < response.length; i++) {
            view = view + '<div><a href="/product/'+ response[i].name +'?shop=All Shop">' + response[i].name + '</a></div>';
        }
    }
    $('#' + load).html(view).show();
}

function suggestion_funct() {
    clearTimeout(timeout);
    timeout = setTimeout(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        var input = $('#city_txtbox').val();
        if(input == "" || input == null)
        {
            $('#suggestion_div').html('').show();
        }
        var url = '/search/city?q=' + input;
        ajax_call(url,'POST','suggestion_div','','city_suggestion');

    },200);
}

function logout_funct(load,response)
{
    window.location.href = window.location.href;    //redirect to same page
}

/* -- End Of Function Call -- */
$(document).ready(function () {
    var width = $('#city_txt').width();
    set_suggestion_div_width(width);

    $('#city_txtbox').focusin(function(){
        $('#suggestion_div').show();
    });

    $('.btn_logout_user').click(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('link[rel="shortcut icon"]').attr('href','/assets/img/loader.gif');
        ajax_call('/logout','POST','','','logout_funct');
    });

    $('#city_txtbox').focusout(function(){
        if($('#suggestion_div div a').html() == "Sorry! We don't serve at your location currently.")
        {
            $('#suggestion_div').html('');
        }
        setTimeout(function () {
            $('#suggestion_div').hide();
        },500);
    });

    $('#city_txtbox').keydown(function(){
        suggestion_funct();
    });

    $('#clear_btn').click(function () {
        $('#city_txtbox').val('');
    });

    $('#city_form').submit(function (e) {
        var input = $('#city_txtbox').val();
        if($('#suggestion_div div').children().length == 1 && $('#suggestion_div div a').html() != 'Sorry! We don\'t serve at your location currently.')
        {
            window.location.href = $('#suggestion_div div a').attr('href');
        }
        e.preventDefault();
    });

    $(window).resize(function(){
        setTimeout(function () {
            var width = $('#city_txt').width();
            set_suggestion_div_width(width);
        },1000);
    });

});