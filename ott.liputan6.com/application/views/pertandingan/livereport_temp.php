<!-- s: LIVE REPORT -->
<span class="title">LAPORAN PERTANDINGAN</span>
<div class="box-report" align="right">
  <div class="styled-select-2-temp">
    <select class="tandinglains" >
      <?php
        foreach ($listMatchLive as $key => $match) {
        if($match['match_id'] == $uri_match_id){
            $isSelected = 'selected="selected"';
        }else{
            $isSelected = '';
        }
      ?>
        <option value='<?php echo $match['match_id'] ?>' <?php echo $isSelected; ?> ><?php echo $match['team_A_name'] .' VS '. $match['team_B_name'] ?> </option>
      <?php } ?>
    </select>
  </div>
  <div id='resultBox'></div>
</div>
<!-- e: LIVE REPORT -->
<script type="text/javascript">
var comboChange = function(){
    var matchId = $('.tandinglains').val();
    console.debug("combo changed, this is the value", matchId);
    ajaxProcess(matchId);
};

$(document).ready(function() {
    comboChange();
    setInterval(comboChange, 60000);
    $('.tandinglains').change(comboChange);
});

var ajaxProcess = function(matchId){
    var dataString  = 'match_id=' + matchId;
    var ajaxURL     = '/cli/getEvent';

    $.ajax({
        type: "POST",
        url : ajaxURL,
        data: dataString,
        success: function(data){
            $('#resultBox').html(data);
        }
    });
}
</script>

