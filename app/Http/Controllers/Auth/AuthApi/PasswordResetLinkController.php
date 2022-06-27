<?php

namespace App\Http\Controllers\Auth\AuthApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthApi\PasswordLinkRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     */
    public function store(PasswordLinkRequest $request): JsonResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return $this->okResponse(trans($status));
    }
}
