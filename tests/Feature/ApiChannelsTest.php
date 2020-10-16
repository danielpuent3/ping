<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\User;
use App\Models\Workspace;
use Tests\TestCase;

class ApiChannelsTest extends TestCase
{

    /**
     * @test
     */
    public function a_user_should_be_able_to_create_a_channel_for_their_current_workspace()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $workspace = Workspace::factory()->create();

        $workspace->users()->syncWithoutDetaching($user);

        $user->setWorkspace($workspace);

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];

        $this->postJson(route('api.channels.store'), $data, $this->headers($token))->assertCreated();
    }

    /**
     * @test
     */
    public function a_channel_name_should_be_unique_to_the_workspace()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $workspace = Workspace::factory()->create();

        $workspace->users()->syncWithoutDetaching($user);

        $user->setWorkspace($workspace);

        Channel::factory()->create(
            [
                'workspace_id' => $workspace->id,
                'name' => 'Engineering',
            ]
        );

        $data = [
            'name' => 'Engineering',
            'description' => $this->faker->text,
        ];

        $this->postJson(route('api.channels.store'), $data, $this->headers($token))->assertJsonValidationErrors(
            [
                'name' => 'The name has already been taken.',
            ]
        );
    }

    /**
     * @test
     */
    public function a_channel_name_should_not_be_unique_across_workspaces()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $workspace = Workspace::factory()->create();

        $workspace->users()->syncWithoutDetaching($user);

        // create channel "engineering" for workspace 1
        Channel::factory()->create(
            [
                'workspace_id' => $workspace->id,
                'name' => 'Engineering',
            ]
        );

        $workspace2 = Workspace::factory()->create();
        $workspace2->users()->syncWithoutDetaching($user);
        $user->setWorkspace($workspace2);

        // workspace 2 should also be able to have an engineering channel
        $data = [
            'name' => 'Engineering',
            'description' => $this->faker->text,
        ];

        $this->postJson(route('api.channels.store'), $data, $this->headers($token))->assertCreated();
    }

    /**
     * @test
     */
    public function a_description_should_be_able_to_store_emoji()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $workspace = Workspace::factory()->create();

        $workspace->users()->syncWithoutDetaching($user);

        $user->setWorkspace($workspace);

        $data = [
            'name' => $this->faker->name,
            'description' => "🏈 FFL",
        ];

        $this->postJson(route('api.channels.store'), $data, $this->headers($token))
            ->assertCreated()
            ->assertJsonFragment(
                [
                    'description' => "🏈 FFL",
                ]
            );
    }

    /**
     * @test
     */
    public function a_user_should_be_able_to_see_all_channels_it_belongs_to_within_a_workspace()
    {
        $user = User::factory()->create();
        $token = $user->new_authorization_token;

        $workspace = Workspace::factory()->create();

        $workspace->users()->syncWithoutDetaching($user);

        $user->setWorkspace($workspace);

        // add user to 5 channels in group
        Channel::factory()->times(5)->create(
            [
                'workspace_id' => $workspace->id,
            ]
        )->each(
            function ($channel) use ($user) {
                $channel->users()->syncWithoutDetaching($user);
            }
        );

        // create other channels user is not in
        Channel::factory()->times(5)->create(
            [
                'workspace_id' => $workspace->id,
            ]
        );

        $this->getJson(route('api.channels.index'), $this->headers($token))->assertOk()->assertJsonCount(5, 'data');
    }
}
