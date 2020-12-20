/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(c){function e(a,b){this.element=c(a);this.lastValues={};c.isArray(b)||(b=[b||{}]);b.length||b.push({});this.optionList=b;var d=this.element.css("transform")||"";this.defaultZIndex=this.element.css("z-index")||100;"auto"==this.defaultZIndex?this.defaultZIndex=100:"0"==this.defaultZIndex&&"none"!=d&&(this.defaultZIndex=100);this.updateOptions();this.lastY=this.offsetY=0;this.stick=f.None;this.spacer=c("<div />");this.spacer[0].id=a.id;this.spacer[0].className=a.className;this.spacer[0].style.cssText=
    a.style.cssText;this.spacer.addClass("jquery-stickit-spacer");this.spacer[0].style.cssText+=";visibility: hidden !important;display: none !important";this.spacer.insertAfter(this.element);"static"==this.element.parent().css("position")&&this.element.parent().css("position","relative");this.origWillChange=this.element.css("will-change");"auto"==this.origWillChange&&this.element.css("will-change","transform");"none"==d?this.element.css("transform","translateZ(0)"):-1==d.indexOf("matrix3d")&&this.element.css("transform",
    this.element.css("transform")+" translateZ(0)");this.bound();this.precalculate();this.store()}function m(){n=window.innerHeight||document.documentElement.clientHeight;k=window.innerWidth||document.documentElement.clientWidth;l()}function l(){g=!0;c(":jquery-stickit").each(function(){c(this).data("jquery-stickit").refresh()});setTimeout(function(){g=!1})}function p(){g=!0;c(":jquery-stickit").each(function(){c(this).data("jquery-stickit").locate()});setTimeout(function(){g=!1})}function u(){var a=
    !!(document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement);c(":jquery-stickit").each(function(){c(this).data("jquery-stickit").enableWillChange(!a)})}function v(a){g||l()}var q=-1!=navigator.userAgent.indexOf("MSIE 7.0"),r=q?-2:0,w=void 0!==window.MutationObserver,h=window.StickScope={Parent:0,Document:1},f={None:0,Fixed:1,Absolute:2},t=!1,g=!1;c.expr[":"]["jquery-stickit"]=function(a){return!!c(a).data("jquery-stickit")};e.prototype.trigger=
    function(a){var b="on"+a.charAt(0).toUpperCase()+a.slice(1);this.options[b]&&this.options[b].call(this.element);this.element.trigger("stickit:"+a)};e.prototype.isActive=function(a){return(void 0===a.screenMinWidth||k>=a.screenMinWidth)&&(void 0===a.screenMaxWidth||k<=a.screenMaxWidth)};e.prototype.updateCss=function(a){this.element.hasClass(this.options.className)&&a.className!=this.options.className&&this.element.removeClass(this.options.className).addClass(a.className);var b={};this.stick==f.Absolute?
    this.options.extraHeight!=a.extraHeight&&(b.bottom=-this.options.extraHeight+"px"):this.options.top!=a.top&&(b.top=a.top+this.offsetY+"px");this.options.zIndex!=a.zIndex&&(b.zIndex=this.getZIndex(a));this.element.css(b)};e.prototype.updateOptions=function(){var a=this.getActiveOptionsKey();if(this.activeKey!=a){this.activeKey=a;var b=this.getActiveOptions();this.options&&(a?this.stick!=f.None&&(b.scope==this.options.scope?this.updateCss(b):(this.reset(),setTimeout(this.locate.bind(this)))):this.reset());
    this.options=b;this.zIndex=this.getZIndex(b)}};e.prototype.getZIndex=function(a){return void 0===a.zIndex?this.defaultZIndex:a.zIndex};e.prototype.getActiveOptionsKey=function(){for(var a=[],b=0;b<this.optionList.length;++b)this.isActive(this.optionList[b])&&a.push(b);return a.join("_")};e.prototype.getActiveOptions=function(){for(var a={},b=0;b<this.optionList.length;++b){var d=this.optionList[b];this.isActive(d)&&c.extend(a,d)}a.scope=a.scope||h.Parent;a.className=a.className||"stick";a.top=a.top||
    0;a.extraHeight=a.extraHeight||0;void 0===a.overflowScrolling&&(a.overflowScrolling=!0);return a};e.prototype.store=function(){var a=this.element[0];this.origStyle={width:a.style.width,position:a.style.position,left:a.style.left,top:a.style.top,bottom:a.style.bottom,zIndex:a.style.zIndex}};e.prototype.restore=function(){this.element.css(this.origStyle)};e.prototype.bound=function(){var a=this.element;if(q||"border-box"!=a.css("box-sizing"))this.extraWidth=0;else{var b=parseFloat(a.css("border-left-width"))||
    0,d=parseFloat(a.css("border-right-width"))||0,c=parseFloat(a.css("padding-left"))||0,e=parseFloat(a.css("padding-right"))||0;this.extraWidth=b+d+c+e}this.margin={top:parseFloat(a.css("margin-top"))||0,bottom:parseFloat(a.css("margin-bottom"))||0,left:parseFloat(a.css("margin-left"))||0,right:parseFloat(a.css("margin-right"))||0};this.parent={border:{bottom:parseFloat(a.parent().css("border-bottom-width"))||0}}};e.prototype.precalculate=function(){this.baseTop=this.margin.top+this.options.top;this.basePadding=
    this.baseTop+this.margin.bottom;this.baseParentOffset=this.options.extraHeight-this.parent.border.bottom;this.offsetHeight=this.options.overflowScrolling?Math.max(this.element.outerHeight(!1)+this.basePadding-n,0):0;this.minOffsetHeight=-this.offsetHeight};e.prototype.reset=function(){this.stick==f.Absolute?(this.trigger("unend"),this.trigger("unstick")):this.stick==f.Fixed&&this.trigger("unstick");this.stick=f.None;this.spacer.css("width",this.origStyle.width);this.spacer[0].style.cssText+=";display: none !important";
    this.restore();this.element.removeClass(this.options.className)};e.prototype.setAbsolute=function(a){this.stick==f.None&&(this.element.addClass(this.options.className),this.trigger("stick"));this.trigger("end");this.stick=f.Absolute;this.element.css({width:this.element.width()+this.extraWidth+"px",position:"absolute",top:this.origStyle.top,left:a+"px",bottom:-this.options.extraHeight+"px","z-index":this.zIndex})};e.prototype.setFixed=function(a,b,d){this.stick==f.None?(this.element.addClass(this.options.className),
    this.trigger("stick")):this.trigger("unend");this.options.overflowScrolling||(d=0);this.stick=f.Fixed;this.lastY=b;this.offsetY=d;this.element.css({width:this.element.width()+this.extraWidth+"px",position:"fixed",top:this.options.top+d+"px",left:a+"px",bottom:this.origStyle.bottom,"z-index":this.zIndex})};e.prototype.updateScroll=function(a){if(0!=this.offsetHeight&&this.options.overflowScrolling){var b=Math.max(this.offsetY+a-this.lastY,this.minOffsetHeight);b=Math.min(b,0);this.lastY=a;this.offsetY!=
b&&(this.offsetY=b,this.element.css("top",this.options.top+this.offsetY+"px"))}};e.prototype.isHeigher=function(){return this.options.scope==h.Parent&&this.element.parent().height()<=this.element.outerHeight(!1)+this.margin.bottom};e.prototype.locate=function(){if(this.activeKey){var a=this.element,b=this.spacer;switch(this.stick){case f.Fixed:var d=b[0].getBoundingClientRect();var c=d.top-this.baseTop;0<=c||this.isHeigher()?this.reset():this.options.scope==h.Parent?(d=a.parent()[0].getBoundingClientRect(),
    d.bottom+this.baseParentOffset+this.offsetHeight<=a.outerHeight(!1)+this.basePadding?this.setAbsolute(this.spacer.position().left):this.updateScroll(d.bottom)):this.updateScroll(d.bottom);break;case f.Absolute:d=b[0].getBoundingClientRect();c=d.top-this.baseTop;var e=d.left-this.margin.left;0<=c||this.isHeigher()?this.reset():(d=a.parent()[0].getBoundingClientRect(),d.bottom+this.baseParentOffset+this.offsetHeight>a.outerHeight(!1)+this.basePadding&&this.setFixed(e+r,d.bottom,-this.offsetHeight));
    break;default:d=a[0].getBoundingClientRect(),c=d.top-this.baseTop,0<=c||this.isHeigher()||(c=a.parent()[0].getBoundingClientRect(),b.height(a.height()),b.show(),e=d.left-this.margin.left,this.options.scope==h.Document?this.setFixed(e,d.bottom,0):c.bottom+this.baseParentOffset+this.offsetHeight<=a.outerHeight(!1)+this.basePadding?this.setAbsolute(this.element.position().left):this.setFixed(e+r,d.bottom,0),b.width()||b.width(a.width()))}}};e.prototype.refresh=function(){this.updateOptions();this.bound();
    this.precalculate();if(this.stick!=f.None){var a=this.element,b=this.spacer;this.lastValues.width!=b.width()&&a.width(this.lastValues.width=b.width());this.lastValues.height!=a.height()&&b.height(this.lastValues.height=a.height());this.stick==f.Fixed&&(b=this.spacer[0].getBoundingClientRect().left-this.margin.left,this.lastValues.left!=b+"px"&&a.css("left",this.lastValues.left=b+"px"))}this.locate()};e.prototype.destroy=function(){this.reset();this.spacer.remove();this.element.removeData("jquery-stickit")};
    e.prototype.enableWillChange=function(a){"auto"==this.origWillChange&&this.element.css("will-change",a?"transform":this.origWillChange)};var n,k,x=["destroy","refresh"];c.fn.stickit=function(a,b){if("string"==typeof a){if(-1!=c.inArray(a,x)){var d=arguments;this.each(function(){var b=c(this).data("jquery-stickit");b&&b[a].apply(b,Array.prototype.slice.call(d,1))})}}else t||(t=!0,m(),c(document).ready(function(){c(window).bind("resize",m).bind("scroll",p);c(document.body).bind("animationend webkitAnimationEnd oAnimationEnd transitionend webkitTransitionEnd oTransitionEnd",
        p);c(document).bind("webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange",u)}),w&&(new MutationObserver(v)).observe(document,{attributes:!0,childList:!0,characterData:!0,subtree:!0})),b=c.isArray(a)?a:Array.prototype.slice.call(arguments,0),this.each(function(){var a=new e(this,b);c(this).data("jquery-stickit",a);a.locate()});return this};c.stickit={refresh:l}})(jQuery);
/* end of data members */
/* --  Filter function -- */

var page = 1;

function getUrl()
{
    var url = getFullUrl();
    delete url.gender;
    delete url.category;
    delete url.sort;
    return url;
}

function getFullUrl()
{
    var url = window.location.href;
    url = url.substring(url.indexOf('?')+1);
    url =  JSON.parse('{"' + decodeURI(url.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
    return url;
}

function changeUrl(url)
{
    history.pushState(null,null,url);
}

function removeFilter(key,value)
{
    var url = getUrl();
    var full_url = getFullUrl();
    key = key.toLowerCase();
    value = value.toLowerCase();
    url[key] = url[key].toLowerCase();
    full_url[key] = full_url[key].toLowerCase();

    if(url[key] == undefined || url[key] == null || url[key] == '')
    {
        return false;
    }

    var value_array = url[key].split(' and ');
    value_array = $(value_array).not([value]).get();
    console.log('-----------');
    console.log(value_array);
    console.log('-----------');
    if(key == 'shop')
    {
        full_url[key] = 'All Shop';
    }
    else
    {
        if(value_array.length == 0)
        {
            delete full_url[key];
        }
        else
        {
            var new_url = '';

            for(var i=0;i < value_array.length;i++)
            {
                new_url = new_url + value_array[i] + ' and ';
            }
            new_url = new_url.substring(0,new_url.length - 5);

            full_url[key] = new_url;
        }
    }

    var url = '';
    for(var key in full_url)
    {
        url = url + key + '=' + full_url[key] + '&';
    }
    url = url.substring(0,url.length - 1);
    url = window.location.pathname + '?' + url;
    return url;

}

function addFilter(key,value)
{
    key = key.toLowerCase();
    var url = getUrl();
    var full_url = getFullUrl();
    if(key == 'shop')
    {
        console.log('in shop');
        full_url[key] = value;
    }
    else {
        if (url[key] == undefined || url[key] == null || url[key] == '') {
            //new key filter
            full_url[key] = value;
        }
        else {
            console.log('in else');
            //already key filter there
            var parm_filter = url[key].split(' and ');
            if (parm_filter.length == 3) {
                alert('Can\'t Add More Than 3 ' + key + ' Filter');
                return false;
            }
            var flag = 0;
            for (var i = 0; i < parm_filter.length; i++) {
                if (parm_filter[i] == value) {
                    flag = 1;
                }
            }

            if (flag == 0) {
                parm_filter.push(value);
            }
            var new_url = '';
            for (var i = 0; i < parm_filter.length; i++) {
                new_url = new_url + parm_filter[i] + ' and ';
            }
            new_url = new_url.substring(0, new_url.length - 5);
            full_url[key] = new_url;
        }
    }
    var url = '';
    for(var key in full_url)
    {
        url = url + key + '=' + full_url[key] + '&';
    }
    url = url.substring(0,url.length - 1);
    url = window.location.pathname + '?' + url;
    return url;
}

function unchecked_all_checkbox()
{
    $('.filter-input').prop('checked',false);
}

function checked_checkbox()
{
    var parm = getUrl();
    var view = '';
    for(var key in parm)
    {
        if(key == 'shop')
        {
            var array_value = parm[key].split('*');
        }
        else{
            var array_value = parm[key].split(' and ');
        }


        for(var i=0;i < array_value.length;i++)
        {
            console.log('array value : ' + array_value[i]);
            array_value[i] = array_value[i].toLowerCase();
            key = key.toLowerCase();
            $('.filter-input[name="' + key +'" i][value="'+ array_value[i] +'" i]').prop("checked",true);
            if(array_value[i] != 'all shop')
            {
                if($('.filter-input[name="' + key +'" i][value="'+ array_value[i] +'" i]').prop("checked") == true || key == 'shop'){
                    view = view + '<button data-name="'+ key +'" data-value="'+ array_value[i] +'" style="outline: none" class="fil_button filter_result_btn"><span>'+ key +': ' + array_value[i].toUpperCase() + '</span></button><br>';
                }
            }
        }

    }
    fill_filter_result(view);
}

function checked_checkbox_funct(key,value)
{
    addFilter(key,value);
    unchecked_all_checkbox();
    checked_checkbox();
}

function unchecked_checkbox_funct(key,value)
{
    removeFilter(key,value);
    unchecked_all_checkbox();
    checked_checkbox();
}

function selectsort()
{
    var url = getFullUrl();
    if(url.sort == undefined || url.sort == null || url.sort == '')
    {
        return false;
    }
    $('.product_sort').val(url.sort);
    return true;
}

function clear_filter()
{
    unchecked_all_checkbox();
    var path = window.location.pathname;
    var url = getFullUrl();
    if(url.sort == undefined)
    {
        url.sort = 'ltoh';
    }
    var new_url = '?shop=' + url.shop + '&category=' + url.category + '&gender=' + url.gender + '&sort=' + url.sort;
    new_url = path + new_url;
    changeUrl(new_url);
    //change url after that
}

function ajax_call1(url,type,load,data,funct){
    $.ajax({
        type: type,
        url: url,
        dataType: 'json',
        data: data,
        success: function (response) {
            showProduct(load,response);
            $('#loading_sign').hide();
        },
        error: function (request, status, error) {
            $('#load_more_product_btn').hide();
            $('#loading_sign').html('');
        }
    });
}

function fill_filter_result(result)
{
    $('.product_filter_result').html(result);
}

function getProduct(load,url)
{
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (response) {
            showProduct(load,response);
        },
        error: function (request, status, error) {
            if(load == 'more_product_div')
            {
                alert('Error loading more product');
            }
            else{
                var url = window.location.pathname.split('/');
                url = decodeURIComponent(url[url.length - 1]);
                var data = {
                    'error' : 'No '+ url +' Found'
                }
                loaderror(data);
            }

        }
    });
}


function showSizes(response)
{
    response = response.result;
    console.log(response);
    var view = '';
    for(var i=0;i < response.length;i++)
    {
        view = view + '<div class="checkbox">\n' +
            '                                <label class="container"><input type="checkbox" class="filter-input" name="size" value="'+ response[i].name.toLowerCase() +'">&nbsp\n' +
            '                                    <span class="checkmark"></span>\n' +
            '                                    '+ response[i].name +'</label>\n' +
            '                            </div>';
    }
    $('.js_size_filter').html(view);
    checked_checkbox();
    $.stickit.refresh();
}

function loadsizes(data)
{
    var url = '/product/sizes/json';
    $.ajax({
        type: 'get',
        url: url,
        data : data,
        dataType: 'json',
        success: function (response) {
            showSizes(response);
        },
        error: function (request, status, error) {
            $('.js_sizes_filter').hide();
        }
    });
}

function loaderror(data)
{
    var url = '/error/500';
    $.ajax({
        type: 'get',
        url: url,
        data : data,
        success: function (response) {
            show_Product_Error(response);
        },
        error: function (request, status, error) {
            window.location.href = '/error/500?error=';
        }
    });
}


function showProduct(load,response)
{
    response = response.result;
    var city = window.location.pathname.split('/');
    city = city[2];
    var url = getFullUrl();
    var view = '';
    if(response.length == 0 || response.length != 16)
    {
        $('#load_more_product_btn').hide();
    }
    for(var i=0;i < response.length;i++)
    {
        var size = '';
        var a = parseInt(response[i].selling_price);
        var discount = (a * 100)/parseInt(response[i].mrp_price);
        var wishlistClass = response[i].wishlistflag;
        if(wishlistClass == 0) {
            wishlistClass = 'out_wishlist';
        }
        else{
            wishlistClass = 'in_wishlist';
        }
        delete a;
        discount = parseInt(100 - discount);

        view = view +
            '                           <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero">' +
            '                        <div data-w_flag="'+ response[i].wishlistflag +'" data-id="'+ response[i].id +'" class="wishlist_btn" style="cursor: pointer">' +
            '                                    <span class="glyphicon glyphicon-heart ' + wishlistClass +'" style="font-size: 22px"></span>\n' +
            '                                </div>' +
            '                                <a target="_blank" href="/product/'+ city + '/' + response[i].name +'/'+ response[i].id +'/buy?shop='+ url.shop +'" class="decoration_none">\n' +
            '                                    <div class="row img_l_container hover">\n' +
            '                                        <div class="col-xs-4 col-sm-12 col-md-12">\n' +
            '                                            <div class="small_inner_container min-height ">\n' +
            '\n' +
            '                                                <img src="'+ response[i].image[0] +'" alt="samsung-galaxy-y" class="list-img vertical_center img-fluid"/>\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                        <div class="col-xs-8 col-sm-12 col-md-12">\n' +
            '                                            <div class="inner_container p_title text18 text-black lineclampin">\n' +
            '                                                '+ response[i].name +'\n' +
            '                                            </div>\n' +
            '                                            <div class="inner_container text18 font-bold text-black">\n' +
            '                                                <b>Rs. '+ response[i].selling_price +'/-</b> &nbsp <small style="color:green"><del style="color:gray !important;">'+ response[i].mrp_price +'</del> &nbsp '+ discount +'% off</small>\n' +
            '                                            </div>\n' +
            '                                            <div class="inner_container font-bold text18 mr_3 lineclampin">\n' +
            '                                                Store : ' + response[i].shop_name + '\n' +
            '                                            </div>\n' +
            '\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </a>\n' +
            '                            </div></div>';
    }
    if(load == 'more_product_div')
    {
        $('.' + load).append(view);
    }
    else
    {
        $('#' + load).html(view);
    }
    $('.js_filter_loading').hide();
    unchecked_all_checkbox();
    checked_checkbox();
    selectsort();
    $.stickit.refresh();
}
function show_Product_Error1() {

}
function show_Product_Error(error)
{
    $('#product_body_div').html(error);
    $('.js_filter_loading').hide();
    unchecked_all_checkbox();
    checked_checkbox();
    selectsort();
}



function generate_json_url()
{
    var path = window.location.pathname;
    path = path + '/json';
    var url = getFullUrl();
    url.page = page;
    var new_url = '?';
    for(var key in url)
    {
        new_url = new_url + key + '=' + url[key] + '&';
    }
    new_url = new_url.substring(0,new_url.length - 1);
    path = path + new_url;
    return path;
}

function AutoScrollTop()
{
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
}

function getAllShop() {
    var path = window.location.pathname;
    var url = getFullUrl();
    var sort = '';
    if(url.sort != undefined || url.sort != null || url.sort != '')
    {
        sort = '&sort=' + url.sort;
    }
    var new_url = '?shop=All Shop' + '&category=' + url.category + '&gender=' + url.gender + sort;
    new_url = path + new_url;
    changeUrl(new_url);
}


$(document).ready(function(){
    var time = 0;
    var view = '<div class="js_filter_loading loading_product_div"></div>';
    $('#mobile_filter_js').html(view + $('#pc_product_filter').html());
    $('.product_filter_row').stickit({
        top:100
    });

    checked_checkbox();
    selectsort();

    var url_parm = getFullUrl();
    var url_path = window.location.pathname;
    url_path = url_path.split('/');

    var size_data = {
        'sub_category' : decodeURIComponent(url_path[url_path.length - 1]),
        'category'  : url_parm.category,
        'gender'    : url_parm.gender
    }
    if(url_parm.q == undefined || url_parm.q == null){
        loadsizes(size_data);
    }
    else
    {
        $('.js_sizes_filter').hide();
    }

    $(document).on('change','.shop_name_search',function () {
        console.log('shop search type');
        $('.js_search_shop_result').html('searching shop...');
        var shop_name = $(this).val();
        if (shop_name.trim() == "") {
            var html = '';
            html = html + '<div class="checkbox">\n' +
                '           <label class="container"><input type="checkbox" class="filter-input" name="shop" value="dress code">&nbsp\n' +
                '               <span class="checkmark"></span>Dress code\n' +
                '           </label>\n' +
                '       </div>'
            $('.js_search_shop_result').html(html);
            return false;
        }
        var city = window.location.pathname.split('/');
        city = city[2];
        var data = {
            'city': city,
            'shop': shop_name
        }
        $.ajax({
            type: 'post',
            url: '/search/shop',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log('response' + response);
                if (response == "No Shop Found") {
                    $('.js_search_shop_result').html('Sorry! This shop not connected with us.Ask them to connect with us (Totally Free!)');
                    return false;
                }
                var html = '';
                for (var i = 0; i < response.length; i++) {
                    html = html + '<div class="checkbox">\n' +
                        '           <label class="container"><input type="checkbox" class="filter-input" name="shop" value="' + response[i].name + '">&nbsp\n' +
                        '               <span class="checkmark"></span>\n' + response[i].name +
                        '           </label>\n' +
                        '       </div>';
                }
                $('.js_search_shop_result').html(html);
            },
            error: function (request, status, error) {
                $('.js_search_shop_result').html('failed to load shop');
            }
        });
        html = '';
    });



    $(document).on('change','.filter-input',function(){
        page = 1;
        AutoScrollTop();
        var key = $(this).attr('name');
        var value = $(this).attr('value');
        var url = '';
        if ($(this).is(':checked')){
            url = addFilter(key,value);
            if(url)
            {
                changeUrl(url);
                var path = generate_json_url();
                $('.js_filter_loading').show();
                getProduct('product_body_div',path);
                return true;
            }
            $(this).prop("checked",false);

        }
        else{
            url = removeFilter(key,value);
            if(url)
            {
                changeUrl(url);
            }
            var path = generate_json_url();
            $('.js_filter_loading').show();
            getProduct('product_body_div',path);
        }
    });
    $(document).on('change','.product_sort',function(){
        page = 1;
        AutoScrollTop();
        var url = getFullUrl();
        url['sort'] = $(this).val();
        var path = window.location.pathname;
        var new_url = '?';
        for(var key in url)
        {
            new_url = new_url + key + '=' + url[key] + '&';
        }
        new_url = new_url.substring(0,new_url.length - 1);
        new_url = path + new_url;
        changeUrl(new_url);
        var path = generate_json_url();
        $('.js_filter_loading').show();
        getProduct('product_body_div',path);

    });

    $(document).on('click','.product_sort_click',function(){
        page = 1;
        AutoScrollTop();
        var url = getFullUrl();
        url['sort'] = $(this).attr('data-value');
        var path = window.location.pathname;
        var new_url = '?';
        for(var key in url)
        {
            new_url = new_url + key + '=' + url[key] + '&';
        }
        new_url = new_url.substring(0,new_url.length - 1);
        new_url = path + new_url;
        changeUrl(new_url);
        var path = generate_json_url();
        $('.js_filter_loading').show();
        getProduct('product_body_div',path);
    });
    $(document).on('click','.clear_all_filter',function(){
        page =1;
        clear_filter();
        var path = generate_json_url();
        $('.js_filter_loading').show();
        getProduct('product_body_div',path);
        AutoScrollTop();
    });

    $(document).on('click','.js_all_shop_btn',function(){
        page = 1;
        getAllShop();
        var path = generate_json_url();
        $('.js_filter_loading').show();
        getProduct('product_body_div',path);
        AutoScrollTop();
    });

    $(document).on('click','.filter_result_btn',function(){
        page =1;
        AutoScrollTop();
        var name = $(this).attr('data-name');
        var value = $(this).attr('data-value');
        var url = removeFilter(name,value);
        changeUrl(url);
        var path = generate_json_url();
        $('.js_filter_loading').show();
        getProduct('product_body_div',path);
    });

    $('.js_scroll_top').click(function(){
        AutoScrollTop();
    });

    $('#load_more_product_btn').click(function(){
        $('#loading_sign').show();
        page++;
        var path = window.location.pathname;
        var url = getFullUrl();
        path = path + '/json?shop='+ url.shop +'&gender='+ url.gender +'&category='+ url.category +'&page=' + page;
        url = getUrl();
        var flag = 0;
        for(var key in url)
        {
            flag = 1;
            path = path + '&' + key + '=' + url[key] + '&';
        }
        if(flag == 1)
            path = path.substring(0,path.length - 1);
        ajax_call1(path,'get','more_product_div','','showProduct');
    });


});


/* --  End of filter function -- */
