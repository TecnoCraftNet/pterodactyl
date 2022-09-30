<?php

namespace Pterodactyl\Http\Requests\Api\Client\Servers\Files;

use Pterodactyl\Contracts\Http\ClientPermissionsRequest;
use Pterodactyl\Models\Permission;
use Pterodactyl\Models\Server;
use Pterodactyl\Http\Requests\Api\Client\ClientApiRequest;

class DownloadFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    /**
     * Ensure that the user making this request has permission to download files
     * from this server.
     */
    public function authorize(): bool
    {
        return $this->user()->can(Permission::ACTION_FILE_SFTP, $this->parameter('server', Server::class));
    }

    public function permission(): string
    {
        return Permission::ACTION_FILE_SFTP;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|string',
        ];
    }
}
