<!-- <script src="<?= base_url() ?>assets/vendor/libs/jquery/jquery.js"></script> -->


<script src="<?= base_url() ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?= base_url() ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/hammer/hammer.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/i18n/i18n.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="<?= base_url() ?>assets/vendor/js/menu.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/swiper/swiper.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="<?= base_url() ?>assets/js/dashboards-analytics.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<!-- <script src="<?= base_url() ?>assets/js/form-validation.js"></script> -->
<script src="<?= base_url() ?>assets/js/forms-selects.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/select2/select2.js"></script>

<script src="<?= base_url() ?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/block-ui/block-ui.js"></script>
<!-- <script src="<?= base_url() ?>assets/js/custom/AjaxHandler.js"></script> -->
<script src="<?= base_url() ?>assets/js/custom/common.js"></script>

<?php if ($flash = $this->session->Flashdata('flash')): ?>
<script>
$(document).ready(function() {
    <?php $class = $flash['success'] == 0 ? "error" : "success"; ?>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: '<?= $class ?>',
        title: `<?= $flash['message'] ?>`
    });
});
</script>
<?php endif; ?>
