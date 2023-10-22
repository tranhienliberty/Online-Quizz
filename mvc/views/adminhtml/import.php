<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sinh viên
                    <small>Nhập file</small>
                </h1>

                <?php require_once "./mvc/views/adminhtml/alert_message.php" ?>

                <form action="?url=import/store" method="POST" enctype="multipart/form-data" style="margin-bottom:1rem;">
                    <input type="file" name="uploadFile" />
                    <button type="submit"
                            class="btn btn-primary"
                            style="margin-top: 10px;">
                            Nhúng file
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
