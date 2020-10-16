<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{

    /**
     * @test
     */
    public function a_user_should_be_able_to_register()
    {
        $data = $this->params();

        $response = $this->postJson(route('api.auth.register'), $data);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function an_email_should_be_unique()
    {
        $user = User::factory()->create();
        $existingEmail = $user->email;

        $data = $this->params();
        $data['email'] = $existingEmail;

        $this->postJson(route('api.auth.register'), $data)->assertJsonValidationErrors(
            [
                'email' => 'The email has already been taken.',
            ]
        );
    }

    /**
     * @test
     */
    public function an_email_must_be_valid()
    {
        $data = $this->params();
        $data['email'] = 'applesauce.com';

        $this->postJson(route('api.auth.register'), $data)->assertJsonValidationErrors(
            [
                'email' => 'The email must be a valid email address.',
            ]
        );
    }

    /**
     * @test
     */
    public function a_password_confirmation_must_match_password()
    {
        $data = $this->params();
        $data['password_confirmation'] = 'applesauce';

        $this->postJson(route('api.auth.register'), $data)->assertJsonValidationErrors(
            [
                'password' => 'The password confirmation does not match.',
            ]
        );
    }

    /**
     * @test
     */
    public function a_password_should_contain_uppercase_characters()
    {
        $data = $this->params();
        $data['password'] = 'aaaaaaa0';

        $this->postJson(route('api.auth.register'), $data)->assertJsonValidationErrors(
            [
                'password' => 'The password must be at least 8 characters and contain at least one uppercase character and one number.',
            ]
        );
    }

    /**
     * @test
     */
    public function a_password_should_contain_numeric_characters()
    {
        $data = $this->params();
        $data['password'] = 'aaaaaaaA';

        $this->postJson(route('api.auth.register'), $data)->assertJsonValidationErrors(
            [
                'password' => 'The password must be at least 8 characters and contain at least one uppercase character and one number.',
            ]
        );
    }

    protected function params(): array
    {
        $password = $this->faker->password(8) . 'A' . '1';
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password, //8 char min, Numeric and Uppercase
            'password_confirmation' => $password, //8 char min, Numeric and Uppercase
        ];
    }
}
