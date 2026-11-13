<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));
        $filter = $request->query('filter');
        $service = $request->query('service');
        $service = array_key_exists((string) $service, Inquiry::SERVICES) ? $service : null;

        $inquiries = Inquiry::query()
            ->when($filter === 'unread', fn ($q) => $q->unread())
            ->when($service, fn ($q) => $q->where('service', $service))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
            'search' => $search,
            'filter' => $filter,
            'service' => $service,
            'services' => Inquiry::SERVICES,
            'stats' => [
                'total' => Inquiry::count(),
                'unread' => Inquiry::unread()->count(),
                'today' => Inquiry::whereDate('created_at', today())->count(),
            ],
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        $inquiry->markAsRead();

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('status', 'تم حذف الطلب.');
    }
}
