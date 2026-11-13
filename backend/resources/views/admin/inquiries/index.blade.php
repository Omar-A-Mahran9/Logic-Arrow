@extends('layouts.app')

@section('title', 'طلبات مكالمات التعارف')

@push('styles')
<style>
    .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
    .stat { padding: 20px 24px; }
    .stat .label { color: var(--muted); font-size: 14px; }
    .stat .value { font-size: 32px; font-weight: 700; color: var(--navy); line-height: 1.3; }
    .stat.accent .value { color: var(--blue); }
    .toolbar { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; padding: 16px; border-bottom: 1px solid var(--panel); }
    .toolbar input { flex: 1 1 240px; width: auto; }
    .toolbar select { width: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: start; padding: 12px 16px; border-bottom: 1px solid var(--panel); vertical-align: top; font-size: 15px; }
    th { font-size: 13px; color: var(--muted); font-weight: 500; background: var(--surface); }
    tr.unread td { background: #f0f6fe; }
    tr.unread .name { font-weight: 700; }
    .dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: var(--blue); margin-inline-end: 6px; }
    .msg { color: var(--muted); max-width: 340px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .date { white-space: nowrap; color: var(--muted); font-size: 13px; }
    .empty { padding: 48px 16px; text-align: center; color: var(--muted); }
    .pager { display: flex; justify-content: space-between; align-items: center; padding: 16px; font-size: 14px; color: var(--muted); }
    .pager .links { display: flex; gap: 8px; }
    .table-wrap { overflow-x: auto; }
    .tag { display: inline-block; padding: 2px 10px; border-radius: 6px; background: var(--panel); color: var(--navy); font-size: 13px; white-space: nowrap; }
    tr.row-link { cursor: pointer; }
    tr.row-link:hover td { background: var(--panel); }
    td.action { text-align: end; white-space: nowrap; }
    .btn-sm { padding: 2px 12px; font-size: 14px; }
    @media (max-width: 720px) {
        .stats { grid-template-columns: 1fr; }
        .hide-sm { display: none; }
    }
</style>
@endpush

@section('content')
    <h1>طلبات مكالمات التعارف</h1>

    <div class="stats">
        <div class="card stat"><div class="label">إجمالي الطلبات</div><div class="value">{{ $stats['total'] }}</div></div>
        <div class="card stat accent"><div class="label">غير مقروءة</div><div class="value">{{ $stats['unread'] }}</div></div>
        <div class="card stat"><div class="label">اليوم</div><div class="value">{{ $stats['today'] }}</div></div>
    </div>

    <div class="card">
        <form class="toolbar" method="GET" action="{{ route('admin.inquiries.index') }}">
            <input type="search" name="q" value="{{ $search }}" placeholder="ابحث بالاسم أو الجهة أو البريد أو الهاتف أو نص الطلب">
            <select name="filter">
                <option value="">الكل</option>
                <option value="unread" @selected($filter === 'unread')>غير المقروءة فقط</option>
            </select>
            <select name="service">
                <option value="">كل الخدمات</option>
                @foreach ($services as $key => $label)
                    <option value="{{ $key }}" @selected($service === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">بحث</button>
            @if ($search !== '' || $filter || $service)
                <a class="btn btn-outline" href="{{ route('admin.inquiries.index') }}">مسح</a>
            @endif
        </form>

        @if ($inquiries->isEmpty())
            <div class="empty">لا توجد طلبات.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th class="hide-sm">الجهة</th>
                        <th>الهاتف</th>
                        <th class="hide-sm">البريد الإلكتروني</th>
                        <th class="hide-sm">الخدمة</th>
                        <th>التاريخ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($inquiries as $inquiry)
                        <tr class="row-link {{ $inquiry->read_at ? '' : 'unread' }}" data-href="{{ route('admin.inquiries.show', $inquiry) }}">
                            <td class="name">
                                @unless ($inquiry->read_at)<span class="dot" title="غير مقروء"></span>@endunless
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a>
                            </td>
                            <td class="hide-sm">{{ $inquiry->company ?: '—' }}</td>
                            <td><span class="ltr">{{ $inquiry->phone }}</span></td>
                            <td class="hide-sm"><span class="ltr">{{ $inquiry->email }}</span></td>
                            <td class="hide-sm">@if ($inquiry->service)<span class="tag">{{ $inquiry->serviceLabel() }}</span>@else — @endif</td>
                            <td class="date">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                            <td class="action"><a class="btn btn-outline btn-sm" href="{{ route('admin.inquiries.show', $inquiry) }}">عرض التفاصيل</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if ($inquiries->hasPages())
                <div class="pager">
                    <span>صفحة {{ $inquiries->currentPage() }} من {{ $inquiries->lastPage() }}</span>
                    <span class="links">
                        @if ($inquiries->previousPageUrl())<a class="btn btn-outline" href="{{ $inquiries->previousPageUrl() }}">السابق</a>@endif
                        @if ($inquiries->nextPageUrl())<a class="btn btn-outline" href="{{ $inquiries->nextPageUrl() }}">التالي</a>@endif
                    </span>
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('tr.row-link').forEach(function (row) {
        row.addEventListener('click', function (e) {
            if (e.target.closest('a, button')) return;
            window.location = row.dataset.href;
        });
    });
</script>
@endpush
