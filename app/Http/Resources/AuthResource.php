<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public $status;
    public $user;
    public $token;

    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $user
     * @param  mixed $token
     * @return void
     */
    public function __construct($status, $user, $token)
    {
        // parent::__construct($user);
        $this->user = $user;
        $this->status  = $status;
        $this->token = $token;
    }

    /**
     * Transform the token into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'user'      => $this->user,
            'token'     => $this->token
        ];
    }
}
