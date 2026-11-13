<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InquiryController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^\+?[0-9\s\-()]{7,30}$/'],
            'email' => ['required', 'email', 'max:190'],
            'service' => ['nullable', Rule::in(array_keys(Inquiry::SERVICES))],
            'message' => ['required', 'string', 'max:3000'],
            'locale' => ['nullable', 'in:en,ar'],
            // Honeypot: real visitors never see or fill this field.
            'website' => ['prohibited'],
        ]);

        Inquiry::create($data);

        return response()->json(['message' => 'Received'], 201);
    }
}
