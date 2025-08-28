<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تعديل ريل مجدول</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body style="background:#f5f7fa;">
<div class="container" style="max-width:650px;margin-top:40px;">
    <a href="<?= base_url('reels/list') ?>" class="btn btn-secondary mb-3">رجوع</a>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">تعديل الريل المجدول #<?= htmlspecialchars($scheduled['id']) ?></div>
        <div class="card-body">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('msg') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('msg_success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('msg_success') ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data" action="<?= base_url('reels/update_scheduled') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($scheduled['id']) ?>">
                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($scheduled['description']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">وقت الجدولة</label>
                    <input type="datetime-local" name="scheduled_time" class="form-control"
                        value="<?= date('Y-m-d\TH:i', strtotime($scheduled['scheduled_time'])) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">استبدال الفيديو (اختياري)</label>
                    <input type="file" name="reel_video" class="form-control" accept="video/*">
                </div>
                <button class="btn btn-primary">حفظ</button>
                <a href="<?= base_url('reels/delete_scheduled/'.$scheduled['id']) ?>"
                   onclick="return confirm('حذف الجدولة؟');"
                   class="btn btn-danger">حذف</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>