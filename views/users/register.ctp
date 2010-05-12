<div class="register">
<h2>Register a new user</h2>
<?php
    $session->flash('auth');
    echo $form->create('User', array('action' => 'register'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('confirm_password', array('type' => 'password'));
    echo $form->end('Register');
?>
</div>