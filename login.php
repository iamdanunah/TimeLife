<?php
session_start();
include_once 'sys/db_connect.php';

$title = 'Login';
include_once 'head.php';

include_once 'sys/register_login.php';

if ($message)
{
	echo '<div class="message">';
	echo ''.htmlspecialchars($message).'';
	echo '</div>';
}


echo '<div class="form_conteiner_reg-auth_fc_ra">';

echo '<div class="fc_ra-buttons_reg_auth">';

echo '<a id="loginBtn">';
echo '<div class="fc_ra-button fc_ra-button_auth active">';
echo 'Login';
echo '</div>';
echo '</a>';

echo '<a id="registerBtn">';
echo '<div class="fc_ra-button fc_ra-button_reg">';
echo 'Register';
echo '</div>';
echo '</a>';

echo '</div>';//echo '<div class="fc_ra-buttons_reg_auth">';

echo '<div class="form-container">';

echo '<div class="form" id="loginForm">';
echo '<form method="POST">';
echo '<input type="email" name="login_email" placeholder="Email" required>';
echo '<input type="password" name="login_password" placeholder="Password" required>';
echo '<button type="submit" name="login" class="toggle-RA">';
echo 'LogIn';
echo '</button>';
echo '</form>';
echo '</div>';//echo '<div class="form" id="loginForm">';


echo '<div class="form" id="registerForm">';
echo '<form method="POST">';
echo '<input type="email" name="register_email" placeholder="Email" required>';
echo '<input type="password" name="register_password" placeholder="Password" required>';
echo '<button type="submit" name="register" class="toggle-RA">';
echo 'Registration';
echo '</button>';
echo '</form>';
echo '</div>';//echo '<div class="form" id="registerForm">';

echo '</div>';//echo '<div class="form-container">';

echo '</div>';//echo '<div class="form_conteiner_reg-auth_fc_ra">';


echo '<div style="
	text-align: center;
	margin-top: 200px;">
TimeLife v 1.0.1
</div>';

include_once 'foot.php';
?>
<!-- Переключення між формами реєстрації і авторизації... 
     Це має бути тільки тут, для того що б не викликатись
	 постійно, а тільки тоді коли проходить реєстрація     -->
<script src="js/register_login.js"></script>
<!---->
