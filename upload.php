<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>رفع الريلز</title>
    <style>
        body { font-family: Tahoma, Arial; background: #fff; text-align: center; }
        .form-box { border: 1px solid #eee; display: inline-block; margin: 30px auto; padding: 30px; border-radius: 10px; background: #f9f9f9; }
        .btn { display: inline-block; background: #218838; color: #fff; padding: 12px 30px; border-radius: 6px; margin: 10px; text-decoration: none; font-size: 16px; }
        #upload-progress { width: 80%; margin: 10px auto; height: 18px; background: #eee; border-radius: 9px; overflow: hidden; display: none; }
        #upload-progress > div { height: 100%; width: 0; background: #28a745; transition: width .2s; }
    </style>
</head>
<body>
    <h2 style="color: #1273de">رفع فيديو ريلز جديد</h2>
    <a href="<?=site_url('reels/pages')?>" class="btn">الرجوع للصفحات المرتبطة</a>
    <div class="form-box">
        <!-- ملاحظة: تم توجيه الفورم إلى process_upload (وظيفة موجودة داخل الكنترولر) -->
        <form id="reel-upload-form" action="<?=site_url('reels/process_upload')?>" method="post" enctype="multipart/form-data">
            <div>
                <label>اختر الصفحة:</label>
                <select name="fb_page_id" required>
                    <?php foreach($pages as $page): ?>
                        <option value="<?=htmlspecialchars($page['fb_page_id'])?>"><?=htmlspecialchars($page['page_name'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="margin:10px 0">
                <label>ملف الفيديو:</label>
                <!-- نترك اسم الحقل video_file كما هو لكن السكربت سيستخدمه لرفع chunked عند الحاجة -->
                <input type="file" id="video_file" name="video_file" accept="video/*" required>
            </div>
            <div>
                <label>الوصف (اختياري):</label>
                <textarea id="caption" name="caption" rows="3" style="width:80%"></textarea>
            </div>

            <!-- hidden token compatibility: إذا كان CI مفعل CSRF سيتم توليد input تلقائياً من الـ framework -->
            <?php if (function_exists('form_hidden') && isset($this->security)) : ?>
                <!-- لو كان هناك توكن CSRF فسوف يظهر هنا تلقائياً -->
                <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()) ?>
            <?php endif; ?>

            <div id="upload-progress"><div></div></div>

            <div>
                <button type="submit" id="submit-btn" class="btn">رفع الريلز</button>
            </div>
        </form>

        <p style="font-size:12px;color:#666">ملاحظة: قمنا بتفعيل رفع مقسّم (chunked) تلقائياً للملفات الكبيرة لتجنب أخطاء 500. للملفات الصغيرة سيتم إرسالها بالطريقة التقليدية.</p>
    </div>

<script>
// Chunked uploader (inline) - لا يعتمد على مكتبات خارجية
(function(){
  const form = document.getElementById('reel-upload-form');
  const fileInput = document.getElementById('video_file');
  const submitBtn = document.getElementById('submit-btn');
  const progressBar = document.querySelector('#upload-progress');
  const progressInner = progressBar.querySelector('div');

  // ضبط عتبة استخدام chunked (بالبايت) - يمكنك تغييرها
  const CHUNK_THRESHOLD = 10 * 1024 * 1024; // 10MB
  const CHUNK_SIZE = 5 * 1024 * 1024; // 5MB

  // احصل توكن CSRF إن وُجد داخل الفورم
  function getCsrf() {
    const inputs = form.querySelectorAll('input[type="hidden"]');
    const csrf = {};
    for(const i of inputs){
      if(i.name && i.value && i.name.toLowerCase().indexOf('csrf')!==-1){
        csrf.name = i.name; csrf.value = i.value;
        break;
      }
    }
    return csrf;
  }

  async function uploadFileInChunks(file, uploadId, extraFields, onProgress) {
    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
    let current = 0;
    const csrf = getCsrf();

    while(current < totalChunks){
      const start = current * CHUNK_SIZE;
      const end = Math.min(start + CHUNK_SIZE, file.size);
      const blob = file.slice(start, end);
      const fd = new FormData();
      fd.append('upload_id', uploadId);
      fd.append('chunk_index', current);
      fd.append('total_chunks', totalChunks);
      fd.append('filename', file.name);
      if(extraFields){
        for(const k in extraFields) if(extraFields[k]!==undefined) fd.append(k, extraFields[k]);
      }
      fd.append('file', blob, file.name);
      if(csrf.name) fd.append(csrf.name, csrf.value);

      try {
        const res = await fetch('<?=site_url('reels/upload_chunk')?>', {
          method: 'POST',
          credentials: 'same-origin',
          body: fd
        });
        if(!res.ok) throw res;
        const json = await res.json();
        if(json.error) throw new Error(json.error);
        current++;
        if(onProgress) onProgress(current/totalChunks);
        // small delay if needed
        await new Promise(r => setTimeout(r, 100));
        if(current === totalChunks){
          // return the file relative path from server
          return json.file || null;
        }
      } catch(err) {
        console.error('chunk upload error', err);
        throw err;
      }
    }
    return null;
  }

  function showProgress(p){
    progressBar.style.display = p>=0 ? 'block' : 'none';
    progressInner.style.width = Math.round((p||0)*100) + '%';
  }

  form.addEventListener('submit', async function(ev){
    // منع الإرسال الافتراضي لإدارة chunked
    ev.preventDefault();

    const file = fileInput.files[0];
    if(!file){
      alert('اختر ملف فيديو');
      return;
    }

    // لو الملف صغير نرسل بالفورم التقليدي (دون تغيير باقي المنطق)
    if(file.size <= CHUNK_THRESHOLD){
      // استخدم الفورم الأصلي لإرسال الملف
      form.submit();
      return;
    }

    // تعطيل الزر أثناء الرفع
    submitBtn.disabled = true;
    showProgress(0);

    const uploadId = Date.now() + '_' + Math.random().toString(36).substr(2,9);
    const extra = {
      // سنرسل الحقول الأساسية اللازمة لإنشاء السجل لاحقًا
      fb_page_id: form.querySelector('select[name="fb_page_id"]').value,
      caption: document.getElementById('caption').value
    };

    try {
      const prePath = await uploadFileInChunks(file, uploadId, extra, (p)=>{
        showProgress(p);
      });

      if(!prePath){
        throw new Error('No file path returned from server');
      }

      // الآن ننادى نهاية الإجراء لإدخال السجل في DB (finalize_preuploaded)
      const fd2 = new FormData();
      fd2.append('preuploaded_path', prePath);
      fd2.append('fb_page_id', extra.fb_page_id);
      fd2.append('caption', extra.caption || '');
      const csrf = getCsrf();
      if(csrf.name) fd2.append(csrf.name, csrf.value);

      const res2 = await fetch('<?=site_url('reels/finalize_preuploaded')?>', {
        method: 'POST',
        credentials: 'same-origin',
        body: fd2
      });
      if(!res2.ok) throw res2;
      const j2 = await res2.json();
      if(j2.error){
        throw new Error(j2.error);
      }

      alert('تم رفع الملف وجدولته بنجاح.');
      // إعادة توجيه لصفحة القائمة
      window.location.href = '<?=site_url('reels/list')?>';
    } catch(err){
      console.error(err);
      alert('فشل الرفع: ' + (err.message || 'network'));
      showProgress(-1);
    } finally {
      submitBtn.disabled = false;
    }
  });
})();
</script>
</body>
</html>