function FBLoginCheck(a) {
    if (a.authResponse) {
        var b = a.authResponse.userID;
        var c = a.authResponse.accessToken;
        $.post("/fbconnect/check", {uid: b, token: c}, function (a) {            
            location.reload();
        });
    } else {
        $.post("/fbconnect/check", {uid: '', token: ''}, function (a) {
            location.reload();
        });
    }
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '160621007401976',
        channelUrl: "/fbchannel.php",
        status: true,
        cookie: true,
        xfbml: true,
        oauth: true
    });
    FB.getLoginStatus(function (a) {
        //FBLoginCheck(a)
    });
    FB.Canvas.setAutoGrow()
};

(function (a, b, c) {
    var d, e = a.getElementsByTagName(b)[0];
    if (a.getElementById(c)) return;
    d = a.createElement(b);
    d.id = c;
    d.async = true;
    d.src = "//connect.facebook.net/en_US/all.js";
    e.parentNode.insertBefore(d, e)
})(document, "script", "facebook-jssdk");

function login_fb() {
    FB.login(function (a) {
        FBLoginCheck(a)
    }, {
        scope: "email,publish_actions,publish_stream,read_stream,read_friendlists,user_birthday,user_likes,user_online_presence,user_actions.news,user_actions.video"
    })
}