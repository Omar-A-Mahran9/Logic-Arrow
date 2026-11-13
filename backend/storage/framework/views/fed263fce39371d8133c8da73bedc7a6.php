<?php $__env->startSection('title', $inquiry->name); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .back { display: inline-block; margin-bottom: 16px; font-size: 14px; }
    .detail { padding: 32px; }
    .meta { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px 24px; margin-bottom: 24px; }
    .meta dt { font-size: 13px; color: var(--muted); }
    .meta dd { margin: 0; font-weight: 500; }
    .message { white-space: pre-wrap; background: var(--surface); border-radius: 12px; padding: 20px; margin-bottom: 24px; }
    .actions { display: flex; flex-wrap: wrap; gap: 12px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <a class="back" href="<?php echo e(route('admin.inquiries.index')); ?>">→ العودة إلى الطلبات</a>

    <div class="card detail">
        <h1><?php echo e($inquiry->name); ?></h1>

        <dl class="meta">
            <div><dt>الجهة</dt><dd><?php echo e($inquiry->company ?: '—'); ?></dd></div>
            <div><dt>الخدمة المطلوبة</dt><dd><?php echo e($inquiry->serviceLabel() ?? '—'); ?></dd></div>
            <div><dt>الهاتف</dt><dd><a class="ltr" href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $inquiry->phone)); ?>"><?php echo e($inquiry->phone); ?></a></dd></div>
            <div><dt>البريد الإلكتروني</dt><dd><a class="ltr" href="mailto:<?php echo e($inquiry->email); ?>"><?php echo e($inquiry->email); ?></a></dd></div>
            <div><dt>تاريخ الإرسال</dt><dd><?php echo e($inquiry->created_at->format('Y-m-d H:i')); ?></dd></div>
            <div><dt>لغة الموقع</dt><dd><?php echo e($inquiry->locale === 'ar' ? 'العربية' : ($inquiry->locale === 'en' ? 'English' : '—')); ?></dd></div>
        </dl>

        <div class="message"><?php echo e($inquiry->message); ?></div>

        <div class="actions">
            <a class="btn btn-primary" href="mailto:<?php echo e($inquiry->email); ?>">الرد بالبريد</a>
            <a class="btn btn-outline" href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $inquiry->phone)); ?>">اتصال</a>
            <form method="POST" action="<?php echo e(route('admin.inquiries.destroy', $inquiry)); ?>" onsubmit="return confirm('حذف هذا الطلب نهائيًا؟')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger" type="submit">حذف</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/omar_a_mahran/Desktop/Darwish_&_Co/logic-arrow-website/backend/resources/views/admin/inquiries/show.blade.php ENDPATH**/ ?>