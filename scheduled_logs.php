<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>سجل محاولات النشر</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body style="background:#f5f7fa;">
<div class="container" style="margin-top:35px;max-width:950px;">
    <a href="<?= base_url('reels/list') ?>" class="btn btn-secondary mb-3">رجوع</a>
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">معلومات الريل المجدول #<?= htmlspecialchars($scheduled['id']) ?></div>
        <div class="card-body">
            <p>
                <strong>الوصف:</strong> <?= nl2br(htmlspecialchars($scheduled['description'])) ?><br>
                <strong>موعد النشر:</strong> <?= htmlspecialchars($scheduled['scheduled_time']) ?><br>
                <strong>الحالة:</strong>
                <?php if($scheduled['status']=='pending'): ?>
                    <span class="badge bg-warning text-dark">بالانتظار</span>
                <?php elseif($scheduled['status']=='uploaded'): ?>
                    <span class="badge bg-success">تم النشر</span>
                <?php else: ?>
                    <span class="badge bg-danger">فشل</span>
                <?php endif; ?><br>
                <strong>آخر خطأ:</strong> <?= $scheduled['last_error'] ? htmlspecialchars($scheduled['last_error']) : '-' ?><br>
                <strong>الرد/معرف الفيديو:</strong> <?= $scheduled['fb_response'] ? htmlspecialchars($scheduled['fb_response']) : '-' ?>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light"><strong>سجل المحاولات</strong></div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم المحاولة</th>
                        <th>الحالة</th>
                        <th>الرسالة</th>
                        <th>التوقيت</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($logs)): ?>
                    <tr><td colspan="5" class="text-center text-muted">لا يوجد محاولات بعد.</td></tr>
                <?php else: ?>
                    <?php foreach($logs as $i=>$log): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($log['attempt_number']) ?></td>
                            <td>
                                <?php if($log['status']=='success'): ?>
                                    <span class="badge bg-success">نجاح</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">فشل</span>
                                <?php endif; ?>
                            </td>
                            <td style="white-space:pre-wrap;max-width:450px;"><?= htmlspecialchars($log['message']) ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>