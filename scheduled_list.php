<div class="main-content">
    <div class="container">
        <h2 class="page-title">الريلز المجدولة</h2>
        <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('msg'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('msg_success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('msg_success'); ?></div>
        <?php endif; ?>

        <div class="card shadow-sm p-3">
            <table class="table table-bordered table-striped align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الفيديو</th>
                        <th>الوصف</th>
                        <th>وقت النشر</th>
                        <th>الحالة</th>
                        <th>رد فيسبوك</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($scheduled_reels)): ?>
                        <?php foreach ($scheduled_reels as $i => $reel): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <a href="<?= base_url($reel->video_path) ?>" target="_blank" class="btn btn-sm btn-outline-primary">مشاهدة</a>
                                </td>
                                <td><?= htmlspecialchars($reel->description) ?></td>
                                <td><?= date('Y-m-d H:i', strtotime($reel->scheduled_time)) ?></td>
                                <td>
                                    <?php if ($reel->status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">بانتظار الرفع</span>
                                    <?php elseif ($reel->status == 'uploaded'): ?>
                                        <span class="badge bg-success">تم النشر</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">فشل النشر</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($reel->fb_response) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">لا يوجد ريلز مجدولة.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="<?= site_url('reels/schedule_reel') ?>" class="btn btn-primary mt-3">جدولة ريل جديد</a>
    </div>
</div>