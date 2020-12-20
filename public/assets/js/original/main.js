var timeout, code = 1,
    url_data = {},
    path = window.location.pathname,
    array = path.split("/"),
    length = array.length,
    city = array[length - 2];

function set_suggestion_div_width(t) {
    $("#suggestion_div").css("width", t)
}

function city_suggestion(t, o) {
    var n = "";
    if ("No Result Found" == o) n += '<div><a href="javascript:void(0)" style="color:red">Sorry! We don\'t serve at your location currently.</a></div>';
    else
        for (var e = 0; e < o.length; e++) n = n + '<div><a href="/product/' + o[e].name + '/All Shop">' + o[e].name + "</a></div>";
    $("#" + t).html(n).show()
}

function logout_funct(t, o) {
    window.location.href = window.location.href
}

function suggestion_funct() {
    clearTimeout(timeout), timeout = setTimeout(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var t = $("#city_txtbox").val();
        "" != t && null != t || $("#suggestion_div").html("").show(), ajax_call("/search/city?q=" + t, "POST", "suggestion_div", "", "city_suggestion")
    }, 200)
}

function set_product_suggestion_div_width(t) {
    $(".product_suggestion_div").css("width", t)
}

function suggestion(t, o) {
    var n = "";
    if ("No Result Found" == o) n += '<div style="color:white;background-color:#ff6666;text-align: center;padding:10px 0px;">Sorry! We don\'t serve at your location currently.</div>';
    else if ("No Shop Found" == o) n += '<div style="color:white;background-color:#ff6666;text-align: center;padding:10px 0px;">Sorry! This shop not connected with us.<br/><span style="font-size:14px;font-weight: bold;"> Ask them to connect with us <br/>(Totally Free!)</span></div>';
    else {
        var e = window.location.href;
        e = e.substring(e.indexOf("?") + 1), url_data = JSON.parse('{"' + decodeURI(e.replace(/&/g, '","').replace(/=/g, '":"')) + '"}'), e = window.location.pathname + "?";
        for (var i = 0; i < o.length; i++) {
            var s = "";
            if ("shop_suggestion_box" == t) {
                url_data.shop = o[i].name;
                for (var a in url_data) s = s + a + "=" + url_data[a] + "&";
                s = s.substring(0, s.length - 1)
            } else "city_suggestion_box" == t && (e = "/product/" + o[i].name + "?", s = "shop=All Shop");
            n = n + '<li><a href="' + e + s + '">' + o[i].name + "</a></li>"
        }
    }
    $("." + t).html(n).show(), $("#" + t).html(n).show()
}

function product_suggestion(t, o) {
    var n = "",
        e = window.location.href;
    e = e.substring(e.indexOf("?") + 1), e = JSON.parse('{"' + decodeURI(e.replace(/&/g, '","').replace(/=/g, '":"')) + '"}');
    var i = window.location.pathname;
    delete e;
    var s = "/product/" + (i = i.split("/"))[2] + "/shirt?shop=" + e.shop;
    if ("No Product Found" == o) n += '<ul><li><a href="javascript:void(0)">Sorry,No Result Found</a></li></ul>';
    else {
        n = "<ul>";
        for (var a = 0; a < o.length; a++) n = n + '<li><a href="' + s + "&q=" + o[a].keyword + '">' + o[a].keyword + "</a></li>";
        n += "</ul>"
    }
    $("." + t).html(n).show()
}

function ajax_call(t, o, n, e, i) {
    $.ajax({
        type: o,
        url: t,
        dataType: "json",
        data: e,
        success: function(t) {
            "suggestion" == i ? suggestion(n, t) : "city_suggestion" == i ? city_suggestion(n, t) : "shop_load" == i ? shop_load(n, t) : "logout_funct" == i ? logout_funct(n, t) : "topproduct_load" == i ? topproduct_load(n, t) : "product_suggestion" == i && product_suggestion(n, t)
        },
        error: function(t, o, n) {
            '"User Already Login"' == t.responseText && (window.location.href = "/Auth/login")
        }
    })
}

function city_suggestion_funct(t) {
    clearTimeout(timeout), timeout = setTimeout(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var o = "";
        if (0 == t ? o = $("#city_search_txt").val() : 1 == t && (o = $("#mob_city_search_txt").val()), "" == o || null == o) {
            return $("#static_city_suggestion").show(), $("#static_city_suggestion ul div").html('<li><a href="/product/islampur?shop=All Shop">islampur</a></li>\n       <li><a href="/product/karad?shop=All Shop">karad</a></li>\n       <li><a href="/product/sangli?shop=All Shop">sangli</a></li>\n       <li><a href="/product/satara?shop=All Shop">satara</a></li>\n       <li><a href="/product/kolhapur?shop=All Shop">kolhapur</a></li>'), !0
        }
        ajax_call("/search/city?q=" + o, "POST", "city_suggestion_box", "", "suggestion")
    }, 200)
}

function shop_suggestion_funct(t) {
    clearTimeout(timeout), timeout = setTimeout(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var o = "";
        if (0 == t ? o = $("#shop_search_txt").val() : 1 == t && (o = $("#mob_shop_search_txt").val()), "" == o || null == o) {
            var n = window.location.href;
            n = n.substring(n.indexOf("?") + 1), n = JSON.parse('{"' + decodeURI(n.replace(/&/g, '","').replace(/=/g, '":"')) + '"}');
            for (var e = ["All Shop", "Lavanya NX", "Tarangan Collection", "Shree Dhuleshwar Collection", "Exceptional Mens Wear", "Dress Code", "Mix And Match"], i = window.location.pathname, s = "", a = 0; a < e.length; a++) {
                n.shop = e[a];
                var r = i + "?";
                for (var c in n) r = r + c + "=" + n[c] + "&";
                r = r.substring(0, r.length - 1), s = 0 == a ? s + '<li><a href="' + r + '" style="border-bottom:1px solid #424242"><center>All Shop</center></a></li>' : s + '<li><a href="' + r + '">' + e[a] + "</a></li>"
            }
            return $(".shop_suggestion_box").html(s), !0
        }
        ajax_call(n = "/search/shop?city=" + (e = (i = window.location.pathname).split("/")[2]) + "&shop=" + o, "POST", "shop_suggestion_box", "", "suggestion")
    }, 200)
}

function topproduct_load(t, o) {
    var n = "";
    (0 == o.length || o.length <= 5) && $("#show_more_product_div").hide();
    for (var e = 0; e < o.length; e++) {
        for (var i = "", s = 0; s < o[e].size.length; s++) i = i + o[e].size[s].size + ",";
        n = n + '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero white">\n                    <a href="/product/' + o[e].name + "/" + o[e].id + '/buy" class="decoration_none">\n                        <div class="row img_l_container hover ">\n                            <div class="col-xs-4 col-sm-12 col-md-12" >\n                                <div class="small_inner_container min-height">\n\n                                    <img src="https://n4.sdlcdn.com/imgs/e/v/g/230x258/Puma-Red-Round-T-Shirt-SDL836814966-1-6f3ff.jpeg" alt="samsung-galaxy-y" class="list-img vertical_center img-fluid"/>\n\n                                </div>\n                            </div>\n                            <div class="col-xs-8 col-sm-12 col-md-12">\n                                <div class="inner_container p_title text18 text-black lineclampin">\n                                    ' + o[e].name + '\n                                </div>\n                                <div class="inner_container text18 font-bold text-black">\n                                    Size :\n' + i + '                                </div>\n                                <div class="inner_container text18 font-bold text-black">\n                                    <b>Rs. ' + o[e].selling_price + '/-</b>\n                                </div>\n                                <div class="inner_container font-bold text18 lineclampin">\n                                    Store : ' + o[e].shop_name + "\n                                </div>\n\n                            </div>\n                        </div>\n                    </a>\n                </div>"
    }
    $("#load_more_product").append(n)
}

function shop_load(t, o) {
    console.log('hello world');
    var n = window.location.pathname.split("/");
    n = n[2];
    var e = "";
    (0 == o.length || o.length < 16) && ($("#loading_sign").hide(), $("#load_more_btn").hide());
    for (var i = 0; i < o.length; i++) {
        e = e + '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero white">\n                <a href="/shop/' + n + "/available-category?shop=" + o[i].name + '" class="decoration_none">\n                    <div class="row img_l_container hover ">\n                        <div class="col-xs-4 col-sm-12 col-md-12" >\n                            <div class="small_inner_container min-height">\n\n                                <img src="' + o[i].image + '" alt="' + o[i].name + '" class="list-img vertical_center img-fluid"/>\n\n                            </div>\n                        </div>\n                        <div class="col-xs-8 col-sm-12 col-md-12">\n                            <div class="inner_container p_title text18 text-black">\n                                <span class="lineclampin" style="width:80% !important;font-weight: bold">' + o[i].name + '</span> <button type="button" class="btn btn-info btn-xs" style="position:absolute;margin-top:-22px;right:5px;">4.6 &nbsp;<span class="glyphicon glyphicon-star"></span></button>\n                            </div>\n                            <div class="inner_container text18 font-bold text-black lineclampin">\n                                Addr : ' + o[i].address + '\n                            </div>\n                                                      <div class="inner_container font-bold text18 lineclampin" style="text-align: center;">\n                                Shop Now >>\n                            </div>\n\n                        </div>\n                    </div>\n                </a>\n            </div>'
    }
    $("#load_more_shop").append(e)
}

function product_suggestion_funct(t) {
    clearTimeout(timeout), timeout = setTimeout(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var o = "";
        0 == t ? o = $("#product_search_txt").val() : 1 == t && (o = $("#mob_product_search_txt").val());
        var n = window.location.pathname,
            e = n.split("/")[2];
        n = (n = window.location.href).substring(n.indexOf("?") + 1);
        var i = "/search/product?city=" + e + "&shop=" + JSON.parse('{"' + decodeURI(n.replace(/&/g, '","').replace(/=/g, '":"')) + '"}').shop + "&q=" + o;
        0 == t ? ajax_call(i, "POST", "product_suggestion_div", "", "product_suggestion") : 1 == t && ajax_call(i, "POST", "mob_product_suggestion_div", "", "product_suggestion")
    }, 200)
} - 1 == (path = window.location.href).indexOf("?") ? url_data.shop = "all shop" : (path = path.substring(path.indexOf("?") + 1), url_data = JSON.parse('{"' + decodeURI(path.replace(/&/g, '","').replace(/=/g, '":"')) + '"}')), $(document).ready(function() {
    set_suggestion_div_width($("#city_txt").width()), set_product_suggestion_div_width(parseInt($("#product_search_txt").width()) + 10), $("#city_search_txt").keydown(function() {
        city_suggestion_funct(0)
    }), $("#mob_city_search_txt").keydown(function() {
        $("#static_city_suggestion").hide(), $(".suggestion_div").show(), city_suggestion_funct(1)
    }), $("#shop_search_txt").keydown(function() {
        shop_suggestion_funct(0)
    }), $("#mob_shop_search_txt").keyup(function() {
        $("#static_shop_suggestion").hide(), $(".suggestion_div").show(), shop_suggestion_funct(1)
    }), $("#mob_shop_search_txt").focus(function() {
        var t = window.location.pathname.split("/")[2];
        $(this).attr("placeholder", "Start Searching Shop @ " + t)
    }), $("#product_search_txt").keydown(function() {
        product_suggestion_funct(0)
    }), $("#mob_product_search_txt").keydown(function() {
        product_suggestion_funct(1)
    }), $("#search_product_form").submit(function(t) {
        var o = window.location.href;
        o = o.substring(o.indexOf("?") + 1), o = JSON.parse('{"' + decodeURI(o.replace(/&/g, '","').replace(/=/g, '":"')) + '"}');
        var n = window.location.pathname;
        delete o;
        var e = "/product/" + (n = n.split("/"))[2] + "/shirts?shop=" + o.shop + "&q=" + $("#product_search_txt").val();
        window.location.href = e, t.preventDefault()
    }), $(".js_clear_btn").click(function() {
        $(this).hide(), $(".js_gender_category").show()
    }), $("#mob_product_search_txt").focus(function() {
        $(".js_gender_category").hide(), $(".js_clear_btn").show();
        var t = window.location.pathname.split("/"),
            o = t[2];
        t = (t = window.location.href).substring(t.indexOf("?") + 1), "all shop" != (t = JSON.parse('{"' + decodeURI(t.replace(/&/g, '","').replace(/=/g, '":"')) + '"}')).shop.toLowerCase() && (o = t.shop + "," + o), $(this).attr("placeholder", "Start Searching Product @ " + o)
    }), $("#city_selector_form").submit(function(t) {
        1 == $(".city_suggestion_box li").children().length && "Sorry! We don't serve at your location currently." != $(".city_suggestion_box div").html() && (window.location.href = $(".city_suggestion_box li a").attr("href")), t.preventDefault()
    }), $("#mob_city_selector_form").submit(function(t) {
        1 == $(".city_suggestion_box li").children().length && "Sorry! We don't serve at your location currently." != $(".city_suggestion_box div").html() && (window.location.href = $(".city_suggestion_box li a").attr("href")), t.preventDefault()
    }), $("#shop_search_form").submit(function(t) {
        1 == $("#shop_suggestion_box li").children().length && 'Sorry! This shop not connected with us.<br/><span style="font-size:14px;font-weight: bold;"> Ask them to connect with us <br/>(Totally Free!)' != $("#shop_suggestion_box div").html() && (window.location.href = $("#shop_suggestion_box li a").attr("href")), t.preventDefault()
    }), $("#filter_form").change(function() {
        console.log("change in filter")
    }), $(window).resize(function() {
        setTimeout(function() {
            set_product_suggestion_div_width(parseInt($("#product_search_txt").width()) + 10)
        }, 500)
    }), $("#city_txtbox").focusin(function() {
        $("#suggestion_div").show()
    }), $("#city_txtbox").focusout(function() {
        "Sorry! We don't serve at your location currently." == $("#suggestion_div div a").html() && $("#suggestion_div").html(""), setTimeout(function() {
            $("#suggestion_div").hide()
        }, 500)
    }), $("#city_txtbox").keydown(function() {
        suggestion_funct()
    }), $("#clear_btn").click(function() {
        $("#city_txtbox").val("")
    }), $("#city_form").submit(function(t) {
        $("#city_txtbox").val();
        1 == $("#suggestion_div div").children().length && "Sorry! We don't serve at your location currently." != $("#suggestion_div div a").html() && (window.location.href = "/shop/" + $("#suggestion_div div a").html() + "/All Shop"), t.preventDefault()
    }), $(".btn_logout_user").click(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        }), ajax_call("/logout", "POST", "", "", "logout_funct")
    }), $(window).resize(function() {
        setTimeout(function() {
            set_suggestion_div_width($("#city_txt").width())
        }, 1e3)
    })
});