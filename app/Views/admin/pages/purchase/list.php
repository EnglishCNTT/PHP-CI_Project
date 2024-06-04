<div class="container-fluid">
    <h1 class="dash-title">Trang chủ / Gói dịch vụ</h1>
    <div class="row">
        <div class="col-lg-12">
            <?= view('messages/message'); ?>
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="easion-card-title">Danh sách gói dịch vụ</div>
                </div>
                <div class="card-body ">
                    <table id="datatable" class="cell-border">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tên gói</th>
                                <th scope="col">Giá bán</th>
                                <th scope="col">Số lượng email</th>
                                <th scope="col">Dung lượng nhớ</th>
                                <th scope="col">Số lượng database</th>
                                <th scope="col">Số lượng domains</th>
                                <th scope="col">Hỗ trợ</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchases as $purchase) : ?>
                                <tr>
                                    <td><?= $purchase['id'] ?></td>
                                    <td><?= $purchase['name'] ?></td>
                                    <td><?= $purchase['price'] ?></td>
                                    <td><?= $purchase['email_address'] ?></td>
                                    <td><?= $purchase['storage'] ?></td>
                                    <td><?= $purchase['databases'] ?></td>
                                    <td><?= $purchase['domains'] ?></td>
                                    <td><?= $purchase['support'] ?></td>
                                    <td class="text-center">
                                        <a href="admin/purchase/edit/<?= $purchase['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a data-url="admin/purchase/delete/<?= $purchase['id'] ?>" class="btn btn-danger btn-del-confirm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>