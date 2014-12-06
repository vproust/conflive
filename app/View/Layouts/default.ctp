<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="fr" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Valentin Proust"/>
	<?php echo $this->Html->charset(); ?>
	<title>Conférences du forum atlantique
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('modernizr');
		echo $this->Html->css('normalize');
		echo $this->Html->css('foundation');
		echo $this->Html->css('app');
	?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<!--	<nav class="top-bar" data-topbar role="navigation">
		  <ul class="title-area">
		    <li class="name">
		      <h1><a href="#">Conférences du forum atlantique</a></h1>
		    </li>
		    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		  </ul>
		
		  <section class="top-bar-section">
		    <ul class="right">
		      <li class="active"><a href="#">Voir les questions</a></li>
		       <li><a href="#">Poser une question</a></li>
		    </ul>
		  </section>
		</nav> 
	-->
			<div id="header">
			</div>
			<div class="row">
				<?php echo $this->Session->flash(); ?>
			</div>
				<?php echo $this->fetch('content'); ?>
			<div id="footer">
			
			</div>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<?php
			echo $this->Html->script('foundation.min');
		?>
		<script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
</body>
</html>
