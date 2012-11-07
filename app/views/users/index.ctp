<h1>Iniciar Sesión</h1>
<?php
echo $this->Form->create('User',array('action'=>'login'));
echo $this->Form->input('name',array('label'=>'Nombre de usuario:'));
echo $this->Form->input('password',array('label'=>'Contraseña:'));
echo $this->Form->end('Login');
?>
