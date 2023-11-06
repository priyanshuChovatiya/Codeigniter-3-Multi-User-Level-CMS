<div class="container-xxl flex-grow-1 container-p-y pt-0">
    <h4 class="py-2 mb-2"><span class="text-muted fw-light"><?= $user_type ?> / </span> Change Password </h4>
    <!-- Change Password -->
    <div class="card mb-4">
        <h5 class="card-header">Change Password</h5>
        <div class="card-body">
            <form class="browser-default-validation mb-3 needs-validation" id="formAccountSettings" method="POST" novalidate id="userForm" action="<?= base_url('change_password/password'); ?>">
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control required" type="password" name="old_password" id="old_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <label for="currentPassword">Current Password</label>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6 form-password-toggle">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control required" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <label for="newPassword">New Password</label>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6 form-password-toggle">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control required" type="password" name="confirm_password" id="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <label for="confirmPassword">Confirm New Password</label>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-3">
                        <label class="form-check">
                            <input class="form-check-input pass-show" type="checkbox">
                            <span class="form-check-label">Show password</span>
                        </label>
                    </div>
                </div>
                </ul>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2  send-msg-btn waves-effect waves-light submit">Save changes</button>
                    <button type="reset" class="btn btn-outline-secondary  send-msg-btn waves-effect waves-light resetBtn">Cancel</button>
                </div>
            </form>

        </div>
    </div>
    <!--/ Change Password -->

    <script>
        $(document).ready(function() {
            $('.pass-show').change(function() {
                var op = $('#old_password');
                var np = $('#new_password');
                var cp = $('#confirm_password');
                (op.attr('type') == 'password') ? op.attr('type', 'text'): op.attr('type', 'password');
                (np.attr('type') == 'password') ? np.attr('type', 'text'): np.attr('type', 'password');
                (cp.attr('type') == 'password') ? cp.attr('type', 'text'): cp.attr('type', 'password');
            })
        })
    </script>
    <?php if ($alert = $this->session->flashdata('flash')) { ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: false,
            })
            Toast.fire({
                icon: '<?= $alert['class'] ?>',
                title: '<?= $alert['message'] ?>'
            })
        </script>
    <?php } ?>