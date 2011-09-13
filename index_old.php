<?php
	include_once('wiki.php');
	if(isset($_POST['submit']) && isset($_GET['edit'])){
		auth();
		edit_page($_POST['content']);
	}elseif(isset($_GET['edit'])){
		auth();
		$edit = edit_page();
	}elseif(isset($_POST['submit']) && $_GET['sidebar'] === 'edit'){
		auth();
		edit_sidebar($_POST['content']);
	}elseif($_GET['sidebar'] === 'edit'){
		auth();
		$edit = edit_sidebar();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $title;?> - <?php echo title($_GET['page']);?></title>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>stylesheets/style.css" />
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrapper">
	<div id="menu">
		<?php echo sidebar();?>
	</div>
	<div id="doc">
	<?php if(isset($edit)):?>
		<h1>Edit <?php echo title($_GET['page']);?></h1>
		<form action="" method="post" id="edit">
			<textarea name="content"><?php echo $edit;?></textarea><br />
			<input type="submit" name="submit" value="Edit Page" />
		</form>
	<?php else:?>
		<?php echo content();?>
	<?php endif;?>
	</div>
	<div id="toc">
		<?php echo pages();?>
	</div>
	<footer>
		<p>Copyright &copy; <?php echo date('Y', time());?> <?php echo $copyright;?></p>
		<a href="?edit">Edit Page</a> | <a href="?sidebar=edit">Edit Sidebar</a>
	</footer>
</div>
</body>
</html>