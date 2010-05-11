<div class="login">
<h2>Login</h2>
<p><?php echo $html->link(__('Register', true), array('controller' => 'users', 'action' => 'register')); ?></p>
<?php
    $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->end('Login');
?>
</div>