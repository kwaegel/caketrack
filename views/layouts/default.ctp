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
	<?php
		echo $html->script('jquery-1.6.1.min');
		echo $html->script('jquery-ui-1.8.13.min');

		echo $html->meta('icon');

		// Print global css files
		echo $html->css('cakeTrack-screen');
		echo $html->css('menu');
		echo $html->css('autocomplete');
		echo $html->css('smoothness/jquery-ui-1.8.13');
		
		// get controller set css files
		if(isset($CSS)){
			echo $html->css($CSS);
		} 

		echo $scripts_for_layout;
	?>
</head>
<style>
	.ui-autocomplete-loading { background: white url('img/spinner.gif') right center no-repeat; }
</style>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $html->link('CakeTrack: an inventory tracking system', '/'); ?></h1>
			<span class="logout">
				Welcome <? 
					if(isset($user['User']['username']))
					{
						echo $user['User']['username'];
						echo ' (', $html->link('Logout', array('controller' => 'users', 'action' => 'logout')), ')';
					}
					else
					{
						echo 'Guest (',$html->link('Login', array('controller' => 'users', 'action' => 'login')), ')';
					}
					?>
			</span>
		</div>
		
		<div id="menu">
			<p>Menu</p>
			<ul>
				<li><?php echo $html->link('Equipment Records', array('controller' => 'equipment_records', 'action' => 'index')); ?></li>
				<li><?php echo $html->link('Members', array('controller' => 'members', 'action' => 'index')); ?></li>
				<li><?php echo $html->link('Equipment Types', array('controller' => 'equipment_types', 'action' => 'index')); ?></li>
				<li><?php echo $html->link('Status Types', array('controller' => 'status_types', 'action' => 'index')); ?></li>
				<li><?php echo $html->link('Logs', array('controller' => 'logs', 'action' => 'index')); ?></li>
				<li>
				<p class="searchHeading">Search:</p>
				<?php
					// Open the form
					echo $form->create(false, array('id'=>'search', 'url'=>array('controller' => 'search', 'action'=>'results')));
					
					// Create a text field
					echo $form->text('searchbox', array(
						'label'=>'Search:', 
						'type'=>'get',
						'id'=>'autocomplete'
						)
					);
					
					echo $this->Form->submit("Search");
					
					// Show loading icon
					echo '<div id="loading" style="display: none; ">' . $html->image("spinner.gif") . '</div>';
					
					// Close the form
					echo $form->end();
					?>
				</li>
			</ul>
			<div id="searchBox">
				
			</div>
		</div>
		
		<div id="content">
			<?php echo $this->Html->image('loadingSnake.gif', array('id' => 'busy-indicator')); ?>

			<?php
				// show flash messages
				echo $session->flash();
				echo $session->flash('auth');
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
		echo $this->element('sql_dump');
		
		echo $js->writeBuffer(); // Write cached scripts
	?>
	<script>
	$(function() {
		$( "#autocomplete" ).autocomplete({
			source: "<?= $session->base ?>/search/autocomplete",
			minLength: 2,
			// The select function submits the form if enter is pressed on one of the menu items
			select: function(event, ui) {
				if(ui.item){
					$("#autocomplete").val(ui.item.value);
					$('#search').submit();
				}
			}
		});
	});
	</script>
</body>
</html>