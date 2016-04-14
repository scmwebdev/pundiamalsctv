<?php
	if(isset($send)){
		echo "<p> Please Check Your Mail and click to validate registration </p>";
	} elseif(isset($validate)) {
		echo "<p> Congratulation, your twitter account is now active </p>";
	} else {
?>
 
<?php echo validation_errors(); ?>

<p>Input Email Address :</p>
<form name="frmTwitter" id="frmTwitter" action="<?php echo site_url('twitter/sendmail')?>" method="post">

	<table>
        <tr>
			<td>Email Address :</td>
			<td><input type="text" name="to" /></td>
		</tr>
		<tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="validate" /></td>
        </tr>
	</table>	
</form>


<?php
}
?>
