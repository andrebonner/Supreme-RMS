<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>PHP/MySQL File Repository</title>
		<meta http-equiv="content-type"
				content="text/html; charset=utf-8" />
				<link href="../css/main.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<table class="layout"  >
	<tr>
		<td colspan="2" height="20%">
			<h1> SVL Customer Service Management System </h1>
		</td>
		</tr>
	<tr>
	<td valign="top" width="20%">
	
	<?php 
	if (userHasRole('Content Administrator'))
{
	include '../ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include '../sa_menu.html.php';

}
?>
</td>
	<td width="80%">
		<h2>PHP/MySQL File Repository</h2>

		<form action="" method="post" enctype="multipart/form-data">
			<div>
				<label for="upload">Upload File:
				<input type="file" id="upload" name="upload"/></label>
			</div>
			<div>
				<label for="desc">File Description:
				<input type="text" id="desc" name="desc"
						maxlength="255"/></label>
			</div>
			<div>
				<input type="hidden" name="action" value="upload"/>
				<input type="submit" value="Upload"/>
			</div>
		</form>

		<?php if (count($files) > 0): ?>

		<p>The following files are stored in the database:</p>

		<table>
			<thead>
				<tr>
					<th>File name</th>
					<th>Type</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($files as $f): ?>
				<tr valign="top">
					<td>
						<a href="?action=view&amp;id=<?php htmlout($f['id']); ?>"
								><?php htmlout($f['filename']); ?></a>
					</td>
					<td><?php htmlout($f['mimetype']); ?></td>
					<td><?php htmlout($f['description']); ?></td>
					<td>
						<form action="" method="get">
							<div>
								<input type="hidden" name="action" value="download"/>
								<input type="hidden" name="id" value="<?php htmlout($f['id']); ?>"/>
								<input type="submit" value="Download"/>
							</div>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<div>
								<input type="hidden" name="action" value="delete"/>
								<input type="hidden" name="id" value="<?php htmlout($f['id']); ?>"/>
								<input type="submit" value="Delete"/>
							</div>
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php endif; ?>
	</td>
</tr>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
