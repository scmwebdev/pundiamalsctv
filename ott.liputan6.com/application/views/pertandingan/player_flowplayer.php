<script src="<?=base_url()?>assets/flowplayer/flowplayer-3.2.12.min.js"></script>

<div id="player" style="display:block;width:640px; height:390px;">
</div>
<video id="vioplayer" src="" x-webkit-airplay="allow" controls="controls" width="640" height="390"></video>

<script type="text/javascript">
  var iPhoneAgent = navigator.userAgent.match(/iPhone/i)
  var iPadAgent = navigator.userAgent.match(/iPad/i)
  var iPodAgent = navigator.userAgent.match(/iPhone/i)
  var AndroidAgent = navigator.userAgent.match(/Android/i)
  var WebOSAgent = navigator.userAgent.match(/webOS/i)
  var BlackBerryAgent = navigator.userAgent.match(/BlackBerry/i)
  var WindowsPhoneAgent = navigator.userAgent.match(/Windows Phone/i)
  var GalaxyTablets = navigator.userAgent.match(/(GT-P1000|GT-P1000R|GT-P1000M|SGH-T849|SHW-M180S)/i)
  var WindowsTablets = navigator.userAgent.match(/Tablet PC/i)

  $(document).ready(function() {
    if( AndroidAgent || WebOSAgent || BlackBerryAgent || WindowsPhoneAgent){
      url ="<?=$url_rtmp?>";
      document.getElementById("vioplayer").setAttribute("src", url);
      $('#player').hide();
     }

    else if( iPhoneAgent || iPodAgent){
      url ="<?=$url_ios?>";
      document.getElementById("vioplayer").setAttribute("src", url);
      $('#player').hide();
    }

    else if(iPadAgent){
      url ="<?=$url_ios?>"
      document.getElementById("vioplayer").setAttribute("src", url);
      $('#player').hide();
     }

    else if(GalaxyTablets || WindowsTablets){
      url ="<?=$url_rtmp?>";
      document.getElementById("vioplayer").setAttribute("src", url);
      $('#player').hide();
     }

    else{
/*
      flowplayer("player", "<?=base_url()?>assets/flowplayer/flowplayer-3.2.16.swf", {
          plugins: {
            f4m: {url: "<?=base_url()?>assets/flowplayer/flowplayer.f4m-3.2.9.swf" },
            httpstreaming: {url: "<?=base_url()?>assets/flowplayer/flowplayer.httpstreaming-3.2.10.swf" },
          },
          clip: {
            url: "<?=$url?>",
            urlResolvers: ['f4m'],
            provider: 'httpstreaming',

          }
      });
*/
      $('#vioplayer').hide();
      flowplayer("player", {
          src : "<?=base_url()?>assets/flowplayer/flowplayer-3.2.16.swf",
          wmode: 'transparent'
        }, {
        clip: {
            url         : "<?=$url?>",
            autoPlay    : true,
            autoBuffering: true,
            urlResolvers: ['f4m','bwcheck'],
            provider    : 'httpstreaming'
        },
        plugins: {
            f4m: {
                url: "<?=base_url()?>assets/flowplayer/flowplayer.f4m-3.2.9.swf"
            },
            httpstreaming: {
                url: "<?=base_url()?>assets/flowplayer/flowplayer.httpstreaming-3.2.10.swf"
            },
            controls: { url: "<?=base_url()?>assets/flowplayer/flowplayer.controls-tube-3.2.15.swf"},
            bwcheck: {
                url: '<?=base_url()?>assets/flowplayer/flowplayer.bwcheck-httpstreaming-3.2.12.swf',
                dynamic: true
            }
        },

      });

    }
  });

</script>
