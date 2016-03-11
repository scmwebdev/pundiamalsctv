<?php

// Modified by WinX , Jan 2008
	
	function print_nav_schedule($m="list", $master="no") {
    GLOBAL $s, $p, $src, $ttlpage, $arrDay, $arrmonth, $arrYear, $srcDay, $srcMonth, $srcYear, $srcAll, $sesAccess, $txtDate1, $txtDate2, $txtDate3, $arrBulan;
    if ($_POST[srcDay]){$srcDay = $_POST[srcDay];}elseif($_REQUEST[tgl]){$srcDay = date("d ",($_REQUEST["tgl"]));}else { $srcDay = date("j"); }
    if ($_POST[srcMonth]){$srcMonth = $_POST[srcMonth];}elseif($_REQUEST[tgl]){$srcMonth = date("m ",($_REQUEST["tgl"]));}else{ $srcMonth = date("n"); }
    if ($_POST[srcYear]){$srcYear = $_POST[srcYear];}elseif($_REQUEST[tgl]){$srcYear = date("Y ",($_REQUEST["tgl"]));}else { $srcYear = date("Y"); }
	
    #if (!$srcDay) { $srcDay = $txtDate1; }
    #if (!$srcMonth) { $srcMonth = $txtDate2; }
    #if (!$srcYear) { $srcYear = $txtDate3; }
    
                                    
    print_combo("srcDay", $arrDay, $srcDay);
    print_combo("srcMonth", $arrBulan, $srcMonth);
    print_combo("srcYear", $arrYear, $srcYear);
    //print "
    //  <input type=\"submit\" value=\"Cari\" class=\"button\">";
	}
	
	function cek_empty_dir($dir) {
    if ($handle = opendir($dir)) {
        while (false !== ($filename = readdir($handle))) { $files[] = $filename; }
    }
    closedir($handle);
    if (sizeof($files) == 2) { return true; } else { return false; }
	}
	
	function get_ext_file($name) {
    $tmp = explode(".", $name);
    return strtolower($tmp[sizeof($tmp)-1]);
	}
	
	function print_combo($name, $data, $id=0, $edit="Y", $event="") {
    ($edit == "N") ? $strEdit = "DISABLED style=\"background-color: #EEEEEE;\" " : $strEdit = "";
    if ($event) { $strEvent = "onChange = \"$event\" "; }
    print "
    <select class=\"select\" id=\"$name\" name=\"$name\" $strEdit $strEvent>";
    if (is_array($data)) {
        for ($i=0;$i<sizeof($data);$i++) {
            $key = key($data);
            ($id == $key) ? $valSelected = "selected" : $valSelected = "";
            print "
        <option value=\"$key\" $valSelected>$data[$key]</option>";
            next($data);
        }
    }
    print "
    </select>";
	}


?>

<?php
print "

<script Language=\"javascript\">

function openwindow(url) {
	window.open(url,\"myRemote\",\"height=300,width=600,top=5,left=5,scrollbars=1,resizable=1,status=1\");
}
function jump(URL) {
	window.location = URL;
}

</script>";


?>

<?php
function print_nav($btn="all") {
    GLOBAL $s, $m, $p, $src, $ttlpage, $sesAccess, $txtDate1, $txtDate2, $txtDate3, $srcDay, $srcMonth, $srcYear;
    print "
                    <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
                        <tr>
                            <td class=\"nav\">
                                <table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
                                    <tr>
                                        <td class=\"navItem\" align=\"left\">";
    if ($btn == "all" && get_user_access($sesAccess, $s."->Add")) {
        print "
                                            <input type=\"button\" value=\"Tambah\" class=\"button\" onClick=\"jump('?s=$s&m=add&srcDay=$srcDay&srcMonth=$srcMonth&srcYear=$srcYear&txtDate1=$txtDate1&txtDate2=$txtDate2&txtDate3=$txtDate3');\">";
    }
    if ($btn == "all" && get_user_access($sesAccess, $s."->Delete")) {
        print "
                                            <input type=\"button\" value=\"Hapus\" class=\"button\" onClick=\"if (confirm('Anda yakin ???')) { fdata.action='?s=$s&m=del&src=$src&srcDay=$srcDay&srcMonth=$srcMonth&srcYear=$srcYear&txtDate1=$txtDate1&txtDate2=$txtDate2&txtDate3=$txtDate3&p=$p';fdata.submit(); }\">";
    }
    if ($btn == "pop") {
        print "
		                <script language=\"JavaScript\">
                        <!--
                            function pushdata(f) {
                                var index = \"\";
                                if (f.txtRadio.length >= 0) {
                                    for (i=0;i<f.txtRadio.length;i++) {
                                        if (f.txtRadio[i].checked == true) {
                                            index = i;
                                            if (f.return1.value) {
                                                var winObj1 = eval('window.opener.'+f.return1.value);
                                                winObj1.value = data1[f.txtRadio[index].value];
                                            }
                                            if (f.return2.value) {
                                                var winObj2 = eval('window.opener.'+f.return2.value);
                                                winObj2.value = data2[f.txtRadio[index].value];
                                            }
                                            if (f.return3.value) {
                                                var winObj3 = eval('window.opener.'+f.return3.value);
                                                winObj3.value = data3[f.txtRadio[index].value];
                                            }
                                            if (f.return4.value) {
                                                var winObj4 = eval('window.opener.'+f.return4.value);
                                                winObj4.value = data4[f.txtRadio[index].value];
                                            }
                                            window.close();
                                        }
                                    }
                                } else {
                                    if (f.txtRadio.status == true) {
                                        if (f.return1.value) {
                                            var winObj1 = eval('window.opener.'+f.return1.value);
                                            winObj1.value = data1[f.txtRadio.value];
                                        }
                                        if (f.return2.value) {
                                            var winObj2 = eval('window.opener.'+f.return2.value);
                                            winObj2.value = data2[f.txtRadio.value];
                                        }
                                        if (f.return3.value) {
                                            var winObj3 = eval('window.opener.'+df.return3.value);
                                            winObj3.value = data3[f.txtRadio.value];
                                        }
                                        if (f.return4.value) {
                                            var winObj4 = eval('window.opener.'+f.return4.value);
                                            winObj4.value = data4[f.txtRadio.value];
                                        }
                                        window.close();
                                    }
                                }
                            }
                        -->
                        </script>
                                            <input type=\"button\" value=\"Pilih\" class=\"button\" onClick=\"pushdata(document.myForm);\">";
    }
    
}
?>