<script type="text/javascript" src="http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/js/swfobject.js"></script>

<script type="text/javascript">
  /****************************************************
  AUTHOR:   Viocorp
  COMPANY:  Viocorp
  WEBSITE:  www.viocorp.com
  ****************************************************/
   function initSWFPlayer(media, w, h, live) {
        var flashvars = {};
        flashvars.currentSrc = media;
        flashvars.themeColour = "000000";
        flashvars.iconColour = "FFFFFF";
        flashvars.modules = "http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/ModuleOSMFPlayer.swf,http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/ModuleJsControls.swf,http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/ModuleSkin.swf";
        flashvars.controls = "PlayPause,Volume,####,Fullscreen";
        flashvars.hdEnabled = "false";
        flashvars.skinUrl = "http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/skin.swf";
        flashvars.autoPlay = 'true';
        flashvars.controlsY = 0;
        flashvars.invertedControlsOrigin = "true";
        flashvars.autoHide = "3";
        flashvars.debug = "false";
        flashvars.posterFrameDefault = "";
        flashvars.posterFrameEnabled = "false";
        flashvars.posterFrameCentered = "false";
        flashvars.posterFrameFitScreen = "false";
        flashvars.hdEnabled = "false";
        flashvars.progressReportInterval = "10";
        flashvars.volume = "0.85";

        var params = {};
        params.allowfullscreen = "true";
        params.allowscriptaccess = "always";http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/js/swfobject.js
        params.scale = "showall";
        params.bgcolor = "#000000";
        params.wmode = "transparent";
        var attributes = { id: "vioplayer" };
        swfobject.embedSWF("http://edge.telin.swiftserve.com/viocorp-sctv/vioplayer/liveplayer/Vioplayer.swf", "vioplayer", w, h, "10.0.0", "", flashvars, params, attributes, swfCallBack);
        //console.log("SWF");
    }

  function swfCallBack(e) {
      var iPhoneAgent = navigator.userAgent.match(/iPhone/i)
      var iPadAgent = navigator.userAgent.match(/iPad/i)
      var iPodAgent = navigator.userAgent.match(/iPhone/i)
      var AndroidAgent = navigator.userAgent.match(/Android/i)
      var WebOSAgent = navigator.userAgent.match(/webOS/i)
      var BlackBerryAgent = navigator.userAgent.match(/BlackBerry/i)
      var WindowsPhoneAgent = navigator.userAgent.match(/Windows Phone/i)
      var GalaxyTablets = navigator.userAgent.match(/(GT-P1000|GT-P1000R|GT-P1000M|SGH-T849|SHW-M180S)/i)
      var WindowsTablets = navigator.userAgent.match(/Tablet PC/i)

        if( AndroidAgent || WebOSAgent || BlackBerryAgent || WindowsPhoneAgent){
          url ="<?= $url_rtmp_mobile ?>"
          document.getElementById("vioplayer").setAttribute("src", url);
         }

        else if( iPhoneAgent || iPodAgent){
          url ="<?= $url_ios_mobile ?>";
          document.getElementById("vioplayer").setAttribute("src", url);
        }

        else if(iPadAgent){
          url ="<?= $url_ios_mobile ?>"
          document.getElementById("vioplayer").setAttribute("src", url);
         }

        else if(GalaxyTablets || WindowsTablets){
          url ="<?= $url_rtmp_mobile ?>";
          document.getElementById("vioplayer").setAttribute("src", url);
         }

        else{
          url ="<?= $url ?>";
          document.getElementById("vioplayer").setAttribute("src", url);
        }
      }
    initSWFPlayer('<?= urlencode($url) ?>','640','360','true');
</script>


<div id="player">
  <video id="vioplayer" src="" x-webkit-airplay="allow" controls="controls"></video>
</div>

