<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Tests\TestCase;

class ApiWorkspaceTest extends TestCase
{

    /**
     * @test
     */
    public function a_user_should_be_authenticated_to_create_a_workspace()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authorization')->plainTextToken;

        $data = [
            'name' => 'Soapbox',
        ];

        $headers = [];

        $this->postJson(route('api.workspaces.store'), $data, $headers)->assertUnauthorized();
    }

    /**
     * @test
     */
    public function a_user_should_be_able_to_create_a_workspace()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authorization')->plainTextToken;

        $data = [
            'name' => 'Soapbox',
        ];

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        $this->successfulResponse()->assertJsonFragment(
            [
                'name' => 'Soapbox',
            ]
        );
    }

    /**
     * @test
     */
    public function a_workspace_name_should_be_unique()
    {
        Workspace::factory()->create(
            [
                'name' => 'Fish Box',
            ]
        );

        $user = User::factory()->create();
        $token = $user->createToken('authorization')->plainTextToken;

        $data = [
            'name' => 'Fish Box',
        ];

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        $this->postJson(route('api.workspaces.store'), $data, $headers)->assertJsonValidationErrors(
            [
                'name' => 'This workspace name has already been taken.',
            ]
        );
    }

    /**
     * @test
     */
    public function a_user_who_creates_a_workspace_should_be_the_creator()
    {
        $user = User::factory()->create();

        $this->successfulResponse($user)->assertJsonFragment(
            [
                'creator' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]
        );
    }

    /**
     * @test
     */
    public function a_user_should_be_able_to_see_all_workspaces_they_belong_to()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authorization')->plainTextToken;

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        Workspace::factory()->times(5)->create()->each(function ($workspace) use ($user) {
            $workspace->users()->syncWithoutDetaching($user);
        });

        $this->getJson(route('api.workspaces.index'), $headers)->assertJsonCount(5, 'data');
    }

    /**
     * @param null $user
     * @return \Illuminate\Testing\TestResponse
     */
    protected function successfulResponse($user = null)
    {
        $user = $user ?? User::factory()->create();
        $token = $user->createToken('authorization')->plainTextToken;

        $data = [
            'name' => 'Soapbox',
        ];

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        return $this->postJson(route('api.workspaces.store'), $data, $headers);
    }
}
