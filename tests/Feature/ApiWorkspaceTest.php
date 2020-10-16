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
        $token = $user->new_authorization_token;

        $data = [
            'name' => 'Soapbox',
        ];

        $this->postJson(route('api.workspaces.store'), $data, [])->assertUnauthorized();
    }

    /**
     * @test
     */
    public function a_user_should_be_able_to_create_a_workspace()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $data = [
            'name' => 'Soapbox',
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
        $token = $user->new_authorization_token;

        $data = [
            'name' => 'Fish Box',
        ];

        $this->postJson(route('api.workspaces.store'), $data, $this->headers($token))->assertJsonValidationErrors(
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
        $token = $user->new_authorization_token;


        Workspace::factory()->times(5)->create()->each(
            function ($workspace) use ($user) {
                $workspace->users()->syncWithoutDetaching($user);
            }
        );

        $this->getJson(route('api.workspaces.index'), $this->headers($token))->assertJsonCount(5, 'data');
    }

    /**
     * @test
     */
    public function a_user_should_be_able_to_set_their_current_workspace()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $this->assertNull($user->current_workspace);

        $workspace = Workspace::factory()->create();
        $workspace->users()->syncWithoutDetaching($user);


        $this->postJson(
            route('api.workspaces.set_current', ['id' => $workspace->id]),
            [],
            $this->headers($token)
        )->assertOk();

        $this->assertEquals($user->fresh()->current_workspace->id, $workspace->id);
    }

    /**
     * @param null $user
     * @return \Illuminate\Testing\TestResponse
     */
    protected function successfulResponse($user = null)
    {
        $user = $user ?? User::factory()->create();
        $token = $user->new_authorization_token;

        $data = [
            'name' => 'Soapbox',
        ];


        return $this->postJson(route('api.workspaces.store'), $data, $this->headers($token));
    }
}
