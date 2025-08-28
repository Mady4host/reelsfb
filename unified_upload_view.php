<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع المحتوى - Facebook & Instagram</title>
    
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        
        * {
            font-family: 'Cairo', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .platform-selector {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .platform-btn {
            padding: 15px 40px;
            border: 3px solid #e0e0e0;
            background: white;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .platform-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .platform-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-color: transparent;
        }
        
        .platform-btn i {
            font-size: 24px;
        }
        
        .content-type-tabs {
            border-bottom: 3px solid #f0f0f0;
            margin-bottom: 30px;
        }
        
        .content-type-tabs .nav-link {
            color: #666;
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            position: relative;
            transition: all 0.3s;
        }
        
        .content-type-tabs .nav-link.active {
            color: #667eea;
            background: none;
        }
        
        .content-type-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        
        .upload-zone {
            border: 3px dashed #e0e0e0;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #fafafa;
        }
        
        .upload-zone:hover {
            border-color: #667eea;
            background: #f5f3ff;
        }
        
        .upload-zone.dragover {
            border-color: #764ba2;
            background: #f0ebff;
        }
        
        .upload-zone i {
            font-size: 60px;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .media-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }
        
        .media-item {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .media-item img,
        .media-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .media-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,255,255,0.9);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .media-item .remove-btn:hover {
            background: #ff4444;
            color: white;
        }
        
        .comment-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .comment-box .remove-comment {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
        }
        
        .add-comment-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .add-comment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .schedule-options {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-top: 20px;
        }
        
        .schedule-type-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .schedule-type-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }
        
        .schedule-type-btn.active {
            border-color: #667eea;
            background: #f5f3ff;
            color: #667eea;
        }
        
        .recurring-options {
            display: none;
            margin-top: 20px;
        }
        
        .recurring-options.show {
            display: block;
        }
        
        .time-slot {
            display: inline-block;
            padding: 5px 15px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            margin: 5px;
            position: relative;
        }
        
        .time-slot .remove {
            margin-left: 10px;
            cursor: pointer;
        }
        
        .accounts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .account-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .account-card:hover {
            border-color: #667eea;
            background: #fafafa;
        }
        
        .account-card.selected {
            border-color: #667eea;
            background: #f5f3ff;
        }
        
        .account-card img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        
        .publish-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 30px;
        }
        
        .publish-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        
        .publish-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .progress-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .progress-overlay.show {
            display: flex;
        }
        
        .progress-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            min-width: 300px;
        }
        
        .progress-bar-container {
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px 0;
        }
        
        .progress-bar-fill {
            height: 10px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s;
        }
        
        @media (max-width: 768px) {
            .platform-selector {
                flex-direction: column;
            }
            
            .schedule-type-selector {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <h1 class="text-center mb-4">
                <i class="fas fa-cloud-upload-alt"></i> رفع المحتوى
            </h1>
            
            <!-- اختيار المنصة -->
            <div class="platform-selector">
                <button class="platform-btn active" data-platform="facebook">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </button>
                <button class="platform-btn" data-platform="instagram">
                    <i class="fab fa-instagram"></i>
                    Instagram
                </button>
                <button class="platform-btn" data-platform="both">
                    <i class="fas fa-share-alt"></i>
                    كلاهما
                </button>
            </div>
            
            <!-- تبويبات نوع المحتوى -->
            <ul class="nav nav-tabs content-type-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#reels-tab">
                        <i class="fas fa-video"></i> ريلز
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#stories-tab">
                        <i class="fas fa-clock"></i> ستوري
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#posts-tab">
                        <i class="fas fa-image"></i> منشورات
                    </a>
                </li>
            </ul>
            
            <!-- محتوى التبويبات -->
            <div class="tab-content">
                <!-- تبويب الريلز -->
                <div class="tab-pane fade show active" id="reels-tab">
                    <div class="upload-zone" id="reels-upload-zone">
                        <i class="fas fa-video"></i>
                        <h4>اسحب الفيديوهات هنا أو انقر للاختيار</h4>
                        <p>يمكنك رفع عدة فيديوهات دفعة واحدة</p>
                        <input type="file" id="reels-input" accept="video/*" multiple hidden>
                    </div>
                    <div class="media-preview" id="reels-preview"></div>
                </div>
                
                <!-- تبويب الستوري -->
                <div class="tab-pane fade" id="stories-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ستوري صور</h5>
                            <div class="upload-zone" id="story-photo-zone">
                                <i class="fas fa-images"></i>
                                <h4>اسحب الصور هنا</h4>
                                <input type="file" id="story-photo-input" accept="image/*" multiple hidden>
                            </div>
                            <div class="media-preview" id="story-photo-preview"></div>
                        </div>
                        <div class="col-md-6">
                            <h5>ستوري فيديو</h5>
                            <div class="upload-zone" id="story-video-zone">
                                <i class="fas fa-video"></i>
                                <h4>اسحب الفيديوهات هنا</h4>
                                <input type="file" id="story-video-input" accept="video/*" multiple hidden>
                            </div>
                            <div class="media-preview" id="story-video-preview"></div>
                        </div>
                    </div>
                </div>
                
                <!-- تبويب المنشورات -->
                <div class="tab-pane fade" id="posts-tab">
                    <div class="upload-zone" id="posts-upload-zone">
                        <i class="fas fa-photo-video"></i>
                        <h4>اسحب الصور أو الفيديوهات هنا</h4>
                        <p>يمكنك رفع صور وفيديوهات متعددة للمنشور الواحد</p>
                        <input type="file" id="posts-input" accept="image/*,video/*" multiple hidden>
                    </div>
                    <div class="media-preview" id="posts-preview"></div>
                    
                    <!-- محتوى المنشور -->
                    <div class="mt-4">
                        <label class="form-label">نص المنشور</label>
                        <textarea class="form-control" id="post-content" rows="4" placeholder="اكتب محتوى المنشور هنا..."></textarea>
                    </div>
                </div>
            </div>
            
            <!-- الوصف والهاشتاجات -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <label class="form-label">الوصف / Caption</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="أضف وصف للمحتوى..."></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الهاشتاجات</label>
                    <textarea class="form-control" id="hashtags" rows="3" placeholder="#hashtag1 #hashtag2"></textarea>
                </div>
            </div>
            
            <!-- التعليقات -->
            <div class="mt-4">
                <h5>التعليقات المجدولة</h5>
                <div id="comments-container"></div>
                <button class="add-comment-btn" onclick="addComment()">
                    <i class="fas fa-plus"></i> إضافة تعليق
                </button>
            </div>
            
            <!-- اختيار الصفحات/الحسابات -->
            <div class="mt-4">
                <h5>اختر الصفحات/الحسابات</h5>
                <div class="accounts-grid" id="accounts-grid">
                    <!-- سيتم ملؤها ديناميكياً -->
                </div>
            </div>
            
            <!-- خيارات الجدولة -->
            <div class="schedule-options">
                <h5>خيارات النشر</h5>
                <div class="schedule-type-selector">
                    <button class="schedule-type-btn active" data-type="now">
                        <i class="fas fa-paper-plane"></i> نشر فوري
                    </button>
                    <button class="schedule-type-btn" data-type="once">
                        <i class="fas fa-calendar"></i> جدولة مرة واحدة
                    </button>
                    <button class="schedule-type-btn" data-type="recurring">
                        <i class="fas fa-sync"></i> جدولة متكررة
                    </button>
                </div>
                
                <!-- خيارات الجدولة الفردية -->
                <div id="once-schedule" style="display:none;">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">التاريخ</label>
                            <input type="date" class="form-control" id="schedule-date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوقت</label>
                            <input type="time" class="form-control" id="schedule-time">
                        </div>
                    </div>
                </div>
                
                <!-- خيارات الجدولة المتكررة -->
                <div id="recurring-schedule" class="recurring-options">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">نوع التكرار</label>
                            <select class="form-select" id="recurring-type">
                                <option value="daily">يومي</option>
                                <option value="weekly">أسبوعي</option>
                                <option value="monthly">شهري</option>
                                <option value="quarterly">كل 3 شهور</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">تاريخ البداية</label>
                            <input type="date" class="form-control" id="recurring-start">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">تاريخ النهاية</label>
                            <input type="date" class="form-control" id="recurring-end">
                        </div>
                    </div>
                    
                    <!-- أيام الأسبوع للجدولة الأسبوعية -->
                    <div id="weekly-days" class="mt-3" style="display:none;">
                        <label class="form-label">اختر أيام الأسبوع</label>
                        <div class="btn-group" role="group">
                            <input type="checkbox" class="btn-check" id="day-0" value="0">
                            <label class="btn btn-outline-primary" for="day-0">الأحد</label>
                            
                            <input type="checkbox" class="btn-check" id="day-1" value="1">
                            <label class="btn btn-outline-primary" for="day-1">الإثنين</label>
                            
                            <input type="checkbox" class="btn-check" id="day-2" value="2">
                            <label class="btn btn-outline-primary" for="day-2">الثلاثاء</label>
                            
                            <input type="checkbox" class="btn-check" id="day-3" value="3">
                            <label class="btn btn-outline-primary" for="day-3">الأربعاء</label>
                            
                            <input type="checkbox" class="btn-check" id="day-4" value="4">
                            <label class="btn btn-outline-primary" for="day-4">الخميس</label>
                            
                            <input type="checkbox" class="btn-check" id="day-5" value="5">
                            <label class="btn btn-outline-primary" for="day-5">الجمعة</label>
                            
                            <input type="checkbox" class="btn-check" id="day-6" value="6">
                            <label class="btn btn-outline-primary" for="day-6">السبت</label>
                        </div>
                    </div>
                    
                    <!-- أوقات النشر -->
                    <div class="mt-3">
                        <label class="form-label">أوقات النشر</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="time-slot-input">
                            <button class="btn btn-primary" onclick="addTimeSlot()">إضافة وقت</button>
                        </div>
                        <div id="time-slots" class="mt-2"></div>
                    </div>
                </div>
            </div>
            
            <!-- زر النشر -->
            <button class="publish-btn" id="publish-btn">
                <i class="fas fa-rocket"></i> نشر المحتوى
            </button>
        </div>
    </div>
    
    <!-- شاشة التقدم -->
    <div class="progress-overlay" id="progress-overlay">
        <div class="progress-content">
            <h4>جاري رفع المحتوى...</h4>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" id="progress-bar" style="width: 0%"></div>
            </div>
            <p id="progress-text">0%</p>
            <p id="progress-status">جاري التحضير...</p>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // متغيرات عامة
        let selectedPlatform = 'facebook';
        let selectedContentType = 'reels';
        let selectedFiles = [];
        let selectedAccounts = [];
        let comments = [];
        let timeSlots = [];
        let scheduleType = 'now';
        
        // البيانات من الخادم
        const facebookPages = <?php echo json_encode($facebook_pages ?? []); ?>;
        const instagramAccounts = <?php echo json_encode($instagram_accounts ?? []); ?>;
        
        // تهيئة الصفحة
        $(document).ready(function() {
            initializePlatformSelector();
            initializeContentTypeTabs();
            initializeUploadZones();
            initializeScheduleOptions();
            loadAccounts();
        });
        
        // اختيار المنصة
        function initializePlatformSelector() {
            $('.platform-btn').click(function() {
                $('.platform-btn').removeClass('active');
                $(this).addClass('active');
                selectedPlatform = $(this).data('platform');
                loadAccounts();
                updateUIForPlatform();
            });
        }
        
        // تبويبات نوع المحتوى
        function initializeContentTypeTabs() {
            $('.content-type-tabs .nav-link').click(function() {
                selectedContentType = $(this).attr('href').replace('#', '').replace('-tab', '');
                resetMediaPreviews();
            });
        }
        
        // مناطق الرفع
        function initializeUploadZones() {
            // الريلز
            setupUploadZone('reels-upload-zone', 'reels-input', 'reels-preview', 'video');
            
            // ستوري الصور
            setupUploadZone('story-photo-zone', 'story-photo-input', 'story-photo-preview', 'image');
            
            // ستوري الفيديو
            setupUploadZone('story-video-zone', 'story-video-input', 'story-video-preview', 'video');
            
            // المنشورات
            setupUploadZone('posts-upload-zone', 'posts-input', 'posts-preview', 'both');
        }
        
        // إعداد منطقة رفع
        function setupUploadZone(zoneId, inputId, previewId, fileType) {
            const zone = document.getElementById(zoneId);
            const input = document.getElementById(inputId);
            
            if (!zone || !input) return;
            
            // النقر لفتح مربع الحوار
            zone.addEventListener('click', () => input.click());
            
            // السحب والإفلات
            zone.addEventListener('dragover', (e) => {
                e.preventDefault();
                zone.classList.add('dragover');
            });
            
            zone.addEventListener('dragleave', () => {
                zone.classList.remove('dragover');
            });
            
            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                zone.classList.remove('dragover');
                handleFiles(e.dataTransfer.files, previewId, fileType);
            });
            
            // اختيار الملفات
            input.addEventListener('change', (e) => {
                handleFiles(e.target.files, previewId, fileType);
            });
        }
        
        // معالجة الملفات
        function handleFiles(files, previewId, fileType) {
            const preview = document.getElementById(previewId);
            if (!preview) return;
            
            Array.from(files).forEach(file => {
                // التحقق من نوع الملف
                const isImage = file.type.startsWith('image/');
                const isVideo = file.type.startsWith('video/');
                
                if (fileType === 'image' && !isImage) return;
                if (fileType === 'video' && !isVideo) return;
                if (fileType === 'both' && !isImage && !isVideo) return;
                
                selectedFiles.push(file);
                
                // إنشاء المعاينة
                const mediaItem = document.createElement('div');
                mediaItem.className = 'media-item';
                
                if (isImage) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    mediaItem.appendChild(img);
                } else if (isVideo) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.controls = true;
                    mediaItem.appendChild(video);
                }
                
                // زر الحذف
                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-btn';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                removeBtn.onclick = () => {
                    mediaItem.remove();
                    selectedFiles = selectedFiles.filter(f => f !== file);
                };
                mediaItem.appendChild(removeBtn);
                
                preview.appendChild(mediaItem);
            });
        }
        
        // تحميل الحسابات
function loadAccounts() {
    const grid = document.getElementById('accounts-grid');
    grid.innerHTML = '';
    
    let accounts = [];
    
    if (selectedPlatform === 'facebook' || selectedPlatform === 'both') {
        // استخدم البيانات الصحيحة من PHP
        accounts = facebookPages.map(page => ({
            id: page.fb_page_id || page.page_id,  // مهم جداً
            name: page.page_name,
            image: page._img || page.page_picture,
            platform: 'facebook',
            raw_data: page  // احتفظ بكل البيانات
        }));
    }
    
    accounts.forEach(account => {
        const card = document.createElement('div');
        card.className = 'account-card';
        card.innerHTML = `
            <img src="${account.image}" alt="${account.name}">
            <div>
                <div>${account.name}</div>
                <small class="text-muted">${account.platform}</small>
            </div>
        `;
        
        card.onclick = () => {
            card.classList.toggle('selected');
            if (card.classList.contains('selected')) {
                selectedAccounts.push(account);
            } else {
                selectedAccounts = selectedAccounts.filter(a => a.id !== account.id);
            }
        };
        
        grid.appendChild(card);
    });
}
        
        // إضافة تعليق
        function addComment() {
            const container = document.getElementById('comments-container');
            const commentBox = document.createElement('div');
            commentBox.className = 'comment-box';
            
            const commentId = Date.now();
            
            commentBox.innerHTML = `
                <button class="remove-comment" onclick="removeComment(${commentId})">
                    <i class="fas fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="نص التعليق..." id="comment-text-${commentId}">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" placeholder="التأخير بالدقائق" id="comment-delay-${commentId}" value="0">
                    </div>
                </div>
            `;
            
            container.appendChild(commentBox);
            
            comments.push({
                id: commentId,
                element: commentBox
            });
        }
        
        // حذف تعليق
        function removeComment(commentId) {
            comments = comments.filter(c => {
                if (c.id === commentId) {
                    c.element.remove();
                    return false;
                }
                return true;
            });
        }
        
        // خيارات الجدولة
        function initializeScheduleOptions() {
            $('.schedule-type-btn').click(function() {
                $('.schedule-type-btn').removeClass('active');
                $(this).addClass('active');
                scheduleType = $(this).data('type');
                
                $('#once-schedule').hide();
                $('#recurring-schedule').removeClass('show');
                
                if (scheduleType === 'once') {
                    $('#once-schedule').show();
                } else if (scheduleType === 'recurring') {
                    $('#recurring-schedule').addClass('show');
                }
            });
            
            // نوع التكرار
            $('#recurring-type').change(function() {
                const type = $(this).val();
                $('#weekly-days').toggle(type === 'weekly');
            });
        }
        
        // إضافة وقت للجدولة
        function addTimeSlot() {
            const input = document.getElementById('time-slot-input');
            const time = input.value;
            
            if (!time) return;
            
            const container = document.getElementById('time-slots');
            const slot = document.createElement('span');
            slot.className = 'time-slot';
            slot.innerHTML = `
                ${time}
                <span class="remove" onclick="removeTimeSlot(this, '${time}')">×</span>
            `;
            
            container.appendChild(slot);
            timeSlots.push(time);
            input.value = '';
        }
        
        // حذف وقت
        function removeTimeSlot(element, time) {
            element.parentElement.remove();
            timeSlots = timeSlots.filter(t => t !== time);
        }
        
        // تحديث واجهة المستخدم حسب المنصة
        function updateUIForPlatform() {
            // يمكن إضافة تخصيصات إضافية هنا
        }
        
        // إعادة تعيين المعاينات
        function resetMediaPreviews() {
            selectedFiles = [];
            $('.media-preview').empty();
        }
        
        // النشر
$('#publish-btn').click(async function() {
    if (!validateForm()) return;
    
    showProgress();
    
    try {
        // بناء FormData بالشكل الصحيح للفورم القديم
        const finalFormData = new FormData();
        
        // 1. الملفات - مثل الفورم القديم تماماً
        selectedFiles.forEach((file, index) => {
            // هنا الفرق المهم - نضيف الملفات كـ array
            finalFormData.append('video_files[]', file);
        });
        
        // 2. الصفحات
        selectedAccounts.forEach((account, index) => {
            finalFormData.append('fb_page_ids[]', account.id || account.fb_page_id || account.page_id);
        });
        
        // 3. الوصف والهاشتاجات
        finalFormData.append('description', $('#description').val() || '');
        finalFormData.append('selected_hashtags', $('#hashtags').val() || '');
        
        // 4. نوع المحتوى
        if (selectedContentType === 'stories') {
            finalFormData.append('media_type', 'story_video');
        } else {
            finalFormData.append('media_type', 'reel');
        }
        
        // 5. التعليقات (إن وجدت)
        comments.forEach((c, index) => {
            const text = $(`#comment-text-${c.id}`).val();
            const delay = $(`#comment-delay-${c.id}`).val() || '0';
            if (text) {
                finalFormData.append(`comments[0][${index}][text]`, text);
                finalFormData.append(`comments[0][${index}][schedule]`, '');
            }
        });
        
        // 6. الجدولة
        if (scheduleType === 'once') {
            const date = $('#schedule-date').val();
            const time = $('#schedule-time').val();
            if (date && time) {
                finalFormData.append('schedule_times[0]', `${date}T${time}`);
            }
        } else {
            finalFormData.append('schedule_times[0]', '');
        }
        
        // 7. المنطقة الزمنية
        finalFormData.append('tz_offset_minutes', new Date().getTimezoneOffset() * -1);
        finalFormData.append('tz_name', Intl.DateTimeFormat().resolvedOptions().timeZone);
        
        // إرسال الطلب
        $.ajax({
            url: '<?php echo base_url(); ?>reels/process_upload',
            method: 'POST',
            data: finalFormData,
            processData: false,
            contentType: false,
            success: function(response) {
                hideProgress();
                
                // التعامل مع الرد
                if (response && response.length > 0) {
                    let hasSuccess = false;
                    let messages = [];
                    
                    response.forEach(msg => {
                        if (msg.type === 'success') hasSuccess = true;
                        messages.push(msg.msg);
                    });
                    
                    if (hasSuccess) {
                        alert('تم النشر بنجاح!\n' + messages.join('\n'));
                        window.location.href = '<?php echo base_url(); ?>reels/list';
                    } else {
                        alert('فشل النشر:\n' + messages.join('\n'));
                    }
                } else {
                    alert('رد غير متوقع من الخادم');
                }
            },
            error: function(xhr, status, error) {
                hideProgress();
                console.error('Ajax error:', error);
                alert('خطأ في الاتصال: ' + error);
            }
        });
        
    } catch (error) {
        hideProgress();
        console.error('Error:', error);
        alert('حدث خطأ: ' + error.message);
    }
});
        
        // التحقق من النموذج
        function validateForm() {
            if (selectedFiles.length === 0) {
                Swal.fire('تنبيه', 'الرجاء اختيار ملفات للرفع', 'warning');
                return false;
            }
            
            if (selectedAccounts.length === 0) {
                Swal.fire('تنبيه', 'الرجاء اختيار حساب واحد على الأقل', 'warning');
                return false;
            }
            
            if (scheduleType === 'once' && (!$('#schedule-date').val() || !$('#schedule-time').val())) {
                Swal.fire('تنبيه', 'الرجاء تحديد تاريخ ووقت الجدولة', 'warning');
                return false;
            }
            
            if (scheduleType === 'recurring' && timeSlots.length === 0) {
                Swal.fire('تنبيه', 'الرجاء إضافة وقت واحد على الأقل للجدولة المتكررة', 'warning');
                return false;
            }
            
            return true;
        }
        
        // تحضير بيانات النموذج
function prepareFormData() {
    const formData = new FormData();
    
    // 1. الملفات - بنفس الشكل اللي الـ backend متوقعه
    if (selectedContentType === 'reels' || selectedContentType === 'stories') {
        selectedFiles.forEach((file, index) => {
            formData.append(`video_files[name][${index}]`, file.name);
            formData.append(`video_files[type][${index}]`, file.type);
            formData.append(`video_files[size][${index}]`, file.size);
        });
        // الملفات الفعلية
        selectedFiles.forEach((file, index) => {
            formData.append(`video_files_${index}`, file);
        });
        // ثم نحول الأسماء في PHP
    } else {
        // للمنشورات العادية
        selectedFiles.forEach((file, index) => {
            formData.append(`media[${index}]`, file);
        });
    }
    
    // 2. الصفحات - مثل الفورم القديم تماماً
    selectedAccounts.forEach((account, index) => {
        formData.append(`fb_page_ids[${index}]`, account.id || account.fb_page_id);
    });
    
    // 3. البيانات الأساسية - مثل القديم
    formData.append('media_type', selectedContentType === 'stories' ? 'story_video' : 'reel');
    formData.append('description', document.getElementById('description').value || '');
    formData.append('selected_hashtags', document.getElementById('hashtags').value || '');
    
    // 4. التعليقات
    const commentsData = [];
    comments.forEach(c => {
        const text = document.getElementById(`comment-text-${c.id}`)?.value;
        const delay = document.getElementById(`comment-delay-${c.id}`)?.value;
        if (text) {
            commentsData.push({ text, schedule: delay || '0' });
        }
    });
    
    if (commentsData.length > 0) {
        commentsData.forEach((comment, i) => {
            formData.append(`comments[0][${i}][text]`, comment.text);
            formData.append(`comments[0][${i}][schedule]`, comment.schedule);
        });
    }
    
    // 5. الجدولة
    formData.append('tz_offset_minutes', new Date().getTimezoneOffset() * -1);
    formData.append('tz_name', Intl.DateTimeFormat().resolvedOptions().timeZone);
    
    if (scheduleType === 'once') {
        const date = document.getElementById('schedule-date').value;
        const time = document.getElementById('schedule-time').value;
        if (date && time) {
            formData.append(`schedule_times[0]`, `${date}T${time}`);
        }
    } else if (scheduleType === 'now') {
        formData.append(`schedule_times[0]`, '');
    }
    
    return formData;
}
        
        // عرض التقدم
        function showProgress() {
            $('#progress-overlay').addClass('show');
            $('#progress-bar').css('width', '0%');
            $('#progress-text').text('0%');
            $('#progress-status').text('جاري التحضير...');
        }
        
        // تحديث التقدم
        function updateProgress(percent) {
            $('#progress-bar').css('width', percent + '%');
            $('#progress-text').text(Math.round(percent) + '%');
            
            if (percent < 30) {
                $('#progress-status').text('جاري رفع الملفات...');
            } else if (percent < 60) {
                $('#progress-status').text('جاري معالجة المحتوى...');
            } else if (percent < 90) {
                $('#progress-status').text('جاري النشر على المنصات...');
            } else {
                $('#progress-status').text('يكاد ينتهي...');
            }
        }
        
        // إخفاء التقدم
        function hideProgress() {
            $('#progress-overlay').removeClass('show');
        }
    </script>
</body>
</html>