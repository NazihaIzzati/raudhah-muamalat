<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    /**
     * Test the registration page loads correctly.
     */
    public function test_registration_page_loads_correctly()
    {
        $response = $this->get('/register');
        
        $response->assertStatus(200);
        $response->assertSee('Register');
        $response->assertSee('Name');
        $response->assertSee('E-Mail Address');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
    }
    
    /**
     * Test a user can register with valid credentials.
     */
    public function test_user_can_register_with_valid_credentials()
    {
        $email = $this->faker->safeEmail();
        
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => 'on',
        ]);
        
        $response->assertRedirect('/dashboard');
        
        // Check if the user was created in the database
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => $email,
        ]);
        
        // Check if the user is authenticated after registration
        $this->assertAuthenticated();
    }
    
    /**
     * Test registration form validation for required fields.
     */
    public function test_registration_requires_all_fields()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);
        
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
    
    /**
     * Test registration validation for email format.
     */
    public function test_registration_requires_valid_email()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'not-an-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        
        $response->assertSessionHasErrors('email');
    }
    
    /**
     * Test registration validation for password confirmation.
     */
    public function test_registration_requires_password_confirmation()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ]);
        
        $response->assertSessionHasErrors('password');
    }
    
    /**
     * Test registration validation for password minimum length.
     */
    public function test_registration_requires_password_minimum_length()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $this->faker->safeEmail(),
            'password' => 'pass',
            'password_confirmation' => 'pass',
        ]);
        
        $response->assertSessionHasErrors('password');
    }
    
    /**
     * Test registration validation for unique email.
     */
    public function test_registration_requires_unique_email()
    {
        // Create a user with a specific email
        $existingUser = User::factory()->create([
            'email' => 'existing@example.com',
        ]);
        
        // Try to register with the same email
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        
        $response->assertSessionHasErrors('email');
    }
    
    /**
     * Test registration requires terms acceptance.
     */
    public function test_registration_requires_terms_acceptance()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            // terms checkbox is missing
        ]);
        
        $response->assertSessionHasErrors('terms');
    }
}
