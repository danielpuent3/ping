<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ResolvesCurrentWorkspace
{
    /**
     * @param User $user
     * @param null $workspaceName
     * @return Model|void
     */
    public function resolveCurrentWorkspace(User $user, $workspaceName = null)
    {
        if (!$workspaceName) {
            return;
        }

        $workspace = $user->workspaces()->firstWhere(
            [
                'name' => $workspaceName,
            ]
        );

        return $user->setWorkspace($workspace);
    }
}
