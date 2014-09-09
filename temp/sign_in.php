<?php

$value_user_id = "";
$value_password1 = "";
$value_email1 = "";
$value_user_id2 = "";

if(isset($_GET['error'])){
	$user_name_error = "User ID or Password was incorrect!";
}

?>
<script>function getEl(el){return document.all?document.all[el]:document.getElementById(el);}</script>
<script>function set_tip(new_tip, key) { getEl('dialog_tip').innerHTML = new_tip; }function reset_tip(key) { getEl('dialog_tip').innerHTML = "<p>Fill in all the required fields on this form.<br /><br /></p><p>Move your mouse over the lightbulb icons to show a helpful tip and some additional information.<br /><br /></p><p><font color=#cc0000>*</font> = required field</p>"; }</script>

<form method="post" name="signin" action="">
<div style="margin: 0 0px 10px 0;">
<h1>Login to your league locker account</h1>
</div>
<div class="gradient" style="width:98%;">
<div class="moduletitles">
<div class="titleholder">
<h3>Login</h3>
</div>
</div>

<div style="float:left;">
<table width="100%" border="0">
    <tr>
        <td width="120" align="right"><span class="required">*&nbsp;</span><font class="formdefLabel"><b> User ID:</b></font></td>
        <td>&nbsp;</td>
        <td width="200"><input <?php if ($color_it_red_id == 1){ echo "style=\"color:#F00\"";} ?> class="formdef" type="text" name="sign_in_data::user_id3" value="<?php echo $value_user_id; ?>"   id='userid' size="30" maxlength="20"></td>
        <td><a href='javascript:set_tip("<p>Your ID identifies you so we can personalize your experience.<br />Your ID must begin with a letter and be  4 to 20 characters long. It can contain only letters, numbers, dashes and underscores, except it must start with a letter and you can not have dashes or underscores next to each other.</p>", "")' onmouseover='javascript:set_tip("<p>Your ID identifies you so we can personalize your experience.<br />Your ID must begin with a letter and be  4 to 20 characters long. It can contain only letters, numbers, dashes and underscores, except it must start with a letter and you can not have dashes or underscores next to each other.</p>", "")' onmouseout='javascript:reset_tip("")'><img src="../images/help-icon.gif" width="19" height="21" alt="Help" border="0" /></a></td>
        <td width="289" align="left"><font size="1" class="formdefLabelError"><?php echo $user_name_error; ?></font></td>
    </tr>
    <tr>
        <td width="120" align="right"><span class="required">*&nbsp;</span><font class="formdefLabel"><b>Password:</b></font></td>
        <td>&nbsp;</td>
        <td width="200"><input <?php if ($color_it_red_pw == 1){ echo "style=\"color:#F00\"";} ?> class="formdef" type="password" name="sign_in_data::user_pw" value="<?php echo $value_password1; ?>"  id='password' size="30" maxlength="12"></td>
        <td><a href='javascript:set_tip("<p>Must be 4 to 12 characters.</p>", "")' onmouseover='javascript:set_tip("<p>Must be 4 to 12 characters.</p>", "")' onmouseout='javascript:reset_tip("")'><img src="../images/help-icon.gif" width="19" height="21" alt="Help" border="0" /></a></td>
        <td width="289" align="left"><font size="1" class="formdefLabelError"></font></td>
    </tr>
</table>
</div>
</div>
<div style="clear:left;"></div>
<div style="float:left;">
<input type=submit name=login value='Login'>
</div>

                                                  

</form>