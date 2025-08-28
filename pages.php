<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صفحاتك المرتبطة</title>
    <style>
        body { font-family: Tahoma, Arial; background: #fff; text-align: center; }
        .page-box { border: 1px solid #eee; display: inline-block; margin: 15px; padding: 20px; border-radius: 10px; background: #f9f9f9; }
        .page-box img { width: 60px; border-radius: 50%; }
        .btn { display: inline-block; background: #218838; color: #fff; padding: 12px 30px; border-radius: 6px; margin: 15px; text-decoration: none; font-size: 16px; }
        .btn2 { background: #007bff; }
    </style>
</head>
<body>
    <h2 style="color: #1273de">صفحاتك المرتبطة</h2>
    <a href="<?=site_url('auth/login')?>" class="btn">ربط صفحات جديدة</a>
    <a href="<?=site_url('reels/upload')?>" class="btn btn2">انتقل لرفع الريلز</a>
    <hr>
    <?php if (empty($pages)): ?>
        <div style="margin-top:40px;font-size:19px;color:#c00">لا توجد صفحات مرتبطة حتى الآن.</div>
    <?php else: ?>
        <?php foreach($pages as $page): ?>
            <div class="page-box">
                <img src="<?=htmlspecialchars($page['page_picture'])?>" alt="">
                <h4><?=htmlspecialchars($page['page_name'])?></h4>
                <small>معرف الصفحة: <?=htmlspecialchars($page['fb_page_id'])?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>