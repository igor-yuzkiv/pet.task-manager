<?php

namespace App\Domains\User\Resources;

use App\Domains\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => (string) $this->id,
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
