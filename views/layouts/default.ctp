<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('CakeTrack: an inventory tracking system: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php echo $html->script(array('prototype')); ?>
	<?php
		echo $html->meta('icon');

		// get global css files
		echo $html->css('cake.generic');
		echo $html->css('menu');
		
		// get controller set css files
		if(isset($CSS)){
			echo $html->css($CSS);
		} 

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="spinner" style="display: none; float: left;">
			<?php echo $html->image('loadingSnake.gif'); ?>
		</div>
	
		<div id="header">
			<h1><?php echo $html->link(__('CakeTrack: an inventory tracking system', true), '/'); ?></h1>
		</div>
		
		<div id="menu">
			<p>Menu</p>
			<ul>
				<li><?php echo $html->link(__('Equipment Records', true), array('controller' => 'equipment_records', 'action' => 'index')); ?></li>
				<li><?php echo $html->link(__('Members', true), array('controller' => 'members', 'action' => 'index')); ?></li>
				<li><?php echo $html->link(__('Equipment Types', true), array('controller' => 'equipment_types', 'action' => 'index')); ?></li>
				<li><?php echo $html->link(__('Status Types', true), array('controller' => 'status_types', 'action' => 'index')); ?></li>
				<li><?php echo $html->link(__('Logs', true), array('controller' => 'logs', 'action' => 'index')); ?></li>
				<li><?php echo $html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout')); ?></li>
			</ul>
		</div>
		
		<div id="content">

			<?php
				$session->flash();
				$session->flash('auth');
			?>

			<?php echo $content_for_layout; ?>

		</div>
		
		<div id="footer">
			<?php
				echo $html->image(
					'cake.power.gif', 
					array (
						"alt" => "CakePHP: the rapid development php framework",
						'url' => 'http://www.cakephp.org/'
					)
				);
			?>
		</div>
		
	</div>
	<?php
		if (isset($cakeDebug)) {
			echo "Debug dump \n";
			$debug->dump($cakeDebug);
		}
	?>
</body>
</html>