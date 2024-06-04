<div class="container-fluid">
    <h1 class="dash-title">Trang chủ / Gói dịch vụ / Sửa</h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title"> Thông tin gói dịch vụ </div>
                </div>
                <div class="card-body ">
                    <form action="admin/purchase/update" method="post">
                        <input name="id" value="<?= $purchase['id'] ?>" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tên gói</label>
                                <input value="<?= $purchase['name'] ?>" name="name" type="text" class="form-control" placeholder="Nhập tên gói" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Giá bán</label>
                                <input value="<?= $purchase['price'] ?>" name="price" type="text" class="form-control" placeholder="Nhập giá bán" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Số lượng mail</label>
                                <input value="<?= $purchase['email_address'] ?>" name="email_address" type="text" class="form-control" placeholder="Nhập số lượng mail" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Dung lượng</label>
                                <input value="<?= $purchase['storage'] ?>" name="storage" type="text" class="form-control" placeholder="Nhập dung lượng" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Số lượng database</label>
                                <input value="<?= $purchase['databases'] ?>" name="databases" type="text" class="form-control" placeholder="Nhập số lượng database" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Số lượng domains</label>
                                <input value="<?= $purchase['domains'] ?>" name="domains" type="text" class="form-control" placeholder="Nhập số lượng domains" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-secondary">Nhập lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>