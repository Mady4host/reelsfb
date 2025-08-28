<div class="main-content">
    <div class="container">
        <h2 class="page-title">جدولة ريل جديد</h2>
        <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('msg'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('msg_success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('msg_success'); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('reels/schedule') ?>" method="post" enctype="multipart/form-data" class="card p-4 mb-4 shadow-sm" style="max-width:500px;">
            <div class="mb-3">
                <label for="reel_video" class="form-label">فيديو الريل</label>
                <input type="file" name="reel_video" class="form-control" accept="video/*" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea name="description" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label for="scheduled_time" class="form-label">وقت النشر</label>
                <input type="datetime-local" name="scheduled_time" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success px-4">جدولة الريل</button>
            <a href="<?= site_url('reels/scheduled_list') ?>" class="btn btn-outline-secondary ms-2">عرض الريلز المجدولة</a>
        </form>
    </div>
</div>