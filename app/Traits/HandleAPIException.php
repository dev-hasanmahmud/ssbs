<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

trait HandleAPIException
{
    use ApiResponse;

    /**
     * Handle exceptions and optionally wrap in DB transaction.
     *
     * @param callable $callback
     * @param bool $useTransaction
     * @return JsonResponse
     */
    protected function handleExceptions(callable $callback, bool $useTransaction = false): JsonResponse
    {
        try {
            if ($useTransaction) {
                return DB::transaction(function () use ($callback) {
                    return $callback();
                });
            }

            return $callback();
        } catch (ModelNotFoundException $e) {
            Log::warning('Model not found', [
                'message'     => $e->getMessage(),
                'url'         => request()->fullUrl(),
                'user_id'     => auth()->check() ? auth()->id() : null,
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);

            return $this->error('Model not found', 404);
        } catch (Throwable $e) {
            Log::error('Unhandled exception', [
                'message'     => $e->getMessage(),
                'url'         => request()->fullUrl(),
                'input'       => request()->all(),
                'user_id'     => auth()->check() ? auth()->id() : null,
                'ip'          => request()->ip(),
                'user_agent'  => request()->userAgent(),
                'trace'       => $e->getTraceAsString(),
            ]);

            return $this->error('Something went wrong. Please try again later.', 500);
        }
    }
}
