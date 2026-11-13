@extends('layouts.app')

@section('title', $inquiry->name)

@push('styles')
<style>
    .back { display: inline-block; margin-bottom: 16px; font-size: 14px; }
    .detail { padding: 32px; }
    .meta { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px 24px; margin-bottom: 24px; }
    .meta dt { font-size: 13px; color: var(--muted); }
    .meta dd { margin: 0; font-weight: 500; }
    .message { white-space: pre-wrap; background: var(--surface); border-radius: 12px; padding: 20px; margin-bottom: 24px; }
    .actions { display: flex; flex-wrap: wrap; gap: 12px; }
</style>
@endpush

@section('content')
    <a class="back" href="{{ route('admin.inquiries.index') }}">→ العودة إلى الطلبات</a>

    <div class="card detail">
        <h1>{{ $inquiry->name }}</h1>

        <dl class="meta">
            <div><dt>الجهة</dt><dd>{{ $inquiry->company ?: '—' }}</dd></div>
            <div><dt>الخدمة المطلوبة</dt><dd>{{ $inquiry->serviceLabel() ?? '—' }}</dd></div>
            <div><dt>الهاتف</dt><dd><a class="ltr" href="tel:{{ preg_replace('/[^0-9+]/', '', $inquiry->phone) }}">{{ $inquiry->phone }}</a></dd></div>
            <div><dt>البريد الإلكتروني</dt><dd><a class="ltr" href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></dd></div>
            <div><dt>تاريخ الإرسال</dt><dd>{{ $inquiry->created_at->format('Y-m-d H:i') }}</dd></div>
            <div><dt>لغة الموقع</dt><dd>{{ $inquiry->locale === 'ar' ? 'العربية' : ($inquiry->locale === 'en' ? 'English' : '—') }}</dd></div>
        </dl>

        <div class="message">{{ $inquiry->message }}</div>

        <div class="actions">
            <a class="btn btn-primary" href="mailto:{{ $inquiry->email }}">الرد بالبريد</a>
            <a class="btn btn-outline" href="tel:{{ preg_replace('/[^0-9+]/', '', $inquiry->phone) }}">اتصال</a>
            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('حذف هذا الطلب نهائيًا؟')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">حذف</button>
            </form>
        </div>
    </div>
@endsection
