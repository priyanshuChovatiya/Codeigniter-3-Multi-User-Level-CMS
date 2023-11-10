<div class="container-xxl flex-grow-1 container-p-y pt-0">
    <h4 class="py-2 mb-2"><span class="text-muted fw-light">Payment / </span> <?= isset($data) ? 'Edit' : 'Add' ?> </h4>
    <!-- Sticky Actions -->
    <form action="<?= !isset($data) ? base_url('admin/manage_payment/add') : base_url('admin/manage_payment/update') ?>" class="browser-default-validation mb-3 needs-validation" novalidate id="userForm" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="text-primary">Payment Details</h5>
                            <div class="row g-4">
                                <input type="hidden" id="id" name="id" value="<?= isset($id) ? $id : '' ?>" class="form-control" />

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select id="user_id" name="user_id" required class="select2 form-select  phone-mask  required" data-lable='User type' required data-allow-clear="true">
                                            <option value="">Select User Name</option>
                                            <?php if (!empty($user)) { ?>
                                                <?php foreach ($user as $key => $value) { ?>
                                                    <option value="<?= $value['id'] ?>" <?= isset($data['user_id']) && $data['user_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?> <?php if(!empty($value['type'])){ echo '(' .$value['type'] .')';} ?> <?php if(!empty($value['job_type'])){ echo '(' .$value['job_type'] .')';} ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <label for="User Type">User type</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="amount" name="amount" value="<?= isset($data['amount']) ? $data['amount'] : '' ?>" required class="form-control required" placeholder="Enter amount" />
                                        <label for="amount">Amount</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="date" id="date" value="<?= isset($data['date']) ? $data['date'] : '' ?>" required class="form-control phone-mask required" />
                                        <label for="date"> Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <small class="text-light fw-medium d-block">type</small>
                                        <div class="form-check form-check-inline mt-2">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="Credit" <?php
                                                                                                                                        if (isset($data)){ echo ($data['type'] == "Credit") ? 'checked' : '' ?><?php } else { ?> checked <?php } ?> />
                                            <label class="form-check-label" for="inlineRadio1">Credit</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Debit" <?php if (isset($data)) { echo ($data['type'] == "Debit") ? 'checked' : '' ?><?php }  ?> />
                                            <label class="form-check-label" for="inlineRadio2">Debit</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="mt-5 m-1">
                                    <button type="submit" class="btn btn-primary d-flex send-msg-btn waves-effect waves-light submit">
                                        <span class="align-middle">Submit</span>
                                    </button>
                                </div>
                                <div class="mt-5">
                                    <button type="reset" class="btn btn-danger d-flex send-msg-btn waves-effect waves-light resetBtn">
                                        <span class="align-middle">Reset</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="text-primary">Payment Details Report</h5>
                        <div class="card-datatable table-responsive pt-0 m-2">
                            <table class="table table-bordered" id="PaymentTable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Action</th>
                                        <th>User Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>type</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="javascript">
    <script>
        $(document).ready(function() {
            var table = $('#PaymentTable').DataTable({
                fixedHeader: false,
                responsive: true,
                serverSide: true,
                showLoader: true,
                destroy: true,
                autoFill: true,
                searching: false,
                paging: true,
                processing: false,
                ajax: {
                    url: '<?= base_url('admin/manage_payment/getPaymentList'); ?>',
                    type: "post",
                    data: function(data) {
                        ShowBlockUi('#PaymentTable');
                    }
                },
                'columns': [{
                        data: 'id'
                    },
                    {
                        data: 'action'
                    },
                    {
                        data: 'user_name'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                ]
            });
        });
    </script>
</div>
