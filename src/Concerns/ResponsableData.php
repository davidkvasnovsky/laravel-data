<?php

namespace Spatie\LaravelData\Concerns;

use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Support\TransformationType;

trait ResponsableData
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        if ($request->has('include')) {
            $this->include(...explode(',', $request->get('include')));
        }

        if ($request->has('exclude')) {
            $this->exclude(...explode(',', $request->get('exclude')));
        }

        $data = $this instanceof DataCollection
            ? $this->transform(TransformationType::request(), 'data')
            : $this->transform(TransformationType::request());

        return new JsonResponse($data);
    }

    public function allowedRequestIncludes(): ?array
    {
        return null;
    }

    public function allowedRequestExcludes(): ?array
    {
        return null;
    }
}
