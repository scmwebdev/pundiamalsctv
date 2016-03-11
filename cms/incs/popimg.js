// popup image
function openPopImg(strFrm,strId,strMod){
    var newWind=window.open("/incs/popimg.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media liputanbola
function openPopMedia(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup headline liputan6
function openPopHeadlineL6(strFrm,strId,strId2,strMod){
    var newWind=window.open("/incs/popheadline-lip6.php?idFrm="+strFrm+"&idField="+strId+"&idField2="+strId2+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media suryacitra
function openPopMediaSC(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-sc.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media sctv
function openPopMediaSCTV(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-sctv.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media mtune
function openPopMediaMTUNE(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-mtune.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media musik
function openPopMediaMUSIK(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-musik.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// open File
function openFile(strFrm,strId,strMod){
    var newWind=window.open(strURL+"/incs/popfile.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod+"&s="+strS,"lookinpop","height=200,width=400,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
    // var newWind=window.open(strURL+"/incs/media.php?s="+strS,"lookinpop","height=400,width=600,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup player
function openPopPlayer(strFrm,strField,strMod,strSid,strTid,strCid){
    var newWind=window.open("/incs/popplayer.php?idFrm="+strFrm+"&idField="+strField+"&mod="+strMod+"&s_id="+strSid+"&t_id="+strTid+"&c_id="+strCid,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup tv program (suryacitra)
function openPopTVProgram(strFrm,strId,strMod){
    var newWind=window.open("/incs/poptvprogram.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media pundiamal
function openPopMediaPundiamal(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-pundiamal.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup finalis miss-cel 2009
function openPopFinalisMiscel(strFrm,strId,strMod){
    var newWind=window.open("/incs/popfinalis-miscel.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

function openPopMediaMiscel(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-miscel.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media liputan6 TV
function openPopMediaL6TV(c_id,strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-l6tv.php?kategori="+c_id+"&idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

function openPopVideoL6TV(c_id,strFrm,strId,strMod){
    var newWind=window.open("/incs/popvideo-l6tv.php?kategori="+c_id+"&idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// Popup untuk Video Yahoo
function openPopVidyahoo(c_id,strFrm,strId,strMod){
    var newWind=window.open("/incs/popvideo-l6tv.php?kategori="+c_id+"&idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media liputan6
function openPopMediaL6(strFrm,strId,strMod){
    var h = 520;
    var w = 800;
    var x = screen.width/2 - w/2;
    var y = screen.height/2 - h/2;
    var newWind=window.open("/incs/popmedia-lip6.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height="+h+",width="+w+",left="+x+",top="+y+",directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media liputan6
function openPopVideoL6(strFrm,strId,strMod){
    var newWind=window.open("/incs/popvideo-lip6.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup video inboxawards
function openPopVideoInboxawards(strFrm,strId,strMod){
    var newWind=window.open("/incs/popvideo-inboxawards.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup video inbox musik song
function openPopInboxMusikSong(strFrm,strId,strId2,strId3,strMod){
    var newWind=window.open("/incs/popvideo-musiksong.php?idFrm="+strFrm+"&idField="+strId+"&idField2="+strId2+"&idField3="+strId3+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup artist inboxawards
function openPopArtistInboxawards(strFrm,strId,strMod){
    var newWind=window.open("/incs/popartist-inboxawards.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup news for sctvawards
function openPopNewsSctvawards(strFrm,strTitle,strLink,strPath,strMod){
    var newWind=window.open("/incs/popnews-lip6.php?idFrm="+strFrm+"&idField="+strTitle+"&idField2="+strLink+"&idField3="+strPath+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup news Liputan Pilihan everything
function openPopNewsLiputanPilihan(strFrm,strId,strTitle,strMod){
    var newWind=window.open("/incs/popnews-liputanpilihan.php?idFrm="+strFrm+"&idField="+strId+"&idField2="+strTitle+"&mod="+strMod,"lookinpop","height=500,width=800,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup twitter liputan6
function openPopTwitterL6(strId,strTwitter,strMod){
    var newWind=window.open("/incs/twitter-oauth/poptwitter-lip6.php?id="+strId+"&twitter="+strTwitter+"&mod="+strMod,"lookinpop","height=300,width=600,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup media nexianwap
function openPopMediaNexianwap(strFrm,strId,strMod){
    var newWind=window.open("/incs/popmedia-nexianwap.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup member users of citizen6 (ID)
function openPopUsersC6(strFrm,strId,strMod){
    var newWind=window.open("/incs/popusers-citizen6.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=420,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup member users of citizen6 (e-mail)
function openPopUsersC6_email(strFrm,strId,strMod){
    var newWind=window.open("/incs/popusers-citizen6-email.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=400,width=700,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

function popupwindow(url, title, w, h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

// popup quotes people liputanChampions
function popupQuotesPeople(strFrm,strId,strName,strMod){
    var newWind=window.open("/incs/popup-quotes-people.php?idFrm="+strFrm+"&idField="+strId+"&idField2="+strName+"&mod="+strMod,"lookinpop","height=600,width=450,left=840,top=220,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}

// popup quotes news url for liputanChampions
function popupQuotesNewsUrl(strFrm,strId,strName,strMod){
    var newWind=window.open("/incs/popup-quotes-news.php?idFrm="+strFrm+"&idField="+strId+"&idField2="+strName+"&mod="+strMod,"lookinpop","height=300,width=650,left=840,top=220,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}