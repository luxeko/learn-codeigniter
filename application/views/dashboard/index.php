<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast show <?php if ($this->session->flashdata('success_login')) { ?>
    <?php echo 'show' ?>
<?php } ?>" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto text-primary">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <i class="bi bi-check-circle-fill text-success me-1"></i>
            Đăng nhập thành công
        </div>
    </div>
</div>
<div class="container mt-3">
    <h3>Dashboard</h3>
</div>

<script>
    const btn_close = document.getElementsByClassName('btn-close')[0];
    const liveToast = document.getElementById('liveToast');
    btn_close.addEventListener('click', () => {
        liveToast.classList.remove("show");
    })
    setTimeout(() => {
        liveToast.classList.remove("show");
    }, 8000)
</script>