<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="<?= base_url() ?>assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>
        <?= $page_title ?>
    </title>
    <meta name="description" content="" />
    <meta name="baseurl" content="<?= base_url(); ?>" />
    <?php $this->load->view('layouts/css') ?>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php require_once "sidebar.php"; ?>
            <div>
                <div class="content-wrapper">
                    <?php $this->load->view($page_name); ?>
                    <?php $this->load->view('layouts/footer') ?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>
    <?php $this->load->view('layouts/js') ?>
	<div class="append-javascript">
	</div>
	<script>
		$(document).ready(function () {
			$('.javascript').html('')
			var js = $('.javascript').html();
			$('.append-javascript').append(js);
			$('.javascript').html('')
		});
	</script>
</body>

</html>
