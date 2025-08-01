<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test the login page loads correctly.
     */
    public function test_login_page_loads_correctly()
    {
        $response = $this->get('/login');
        
        $response->assertStatus(200);
        $response->assertSee('Sign in');
        $response->assertSee('E-Mail Address');
        $response->assertSee('Password');
    }
    
    /**
     * Test a user can login with correct credentials.
     */
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }
    
    /**
     * Test a user cannot login with incorrect email.
     */
    public function test_user_cannot_login_with_incorrect_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'password',
        ]);
        
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    
    /**
     * Test a user cannot login with incorrect password.
     */
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);
        
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    
    /**
     * Test login form validation.
     */
    public function test_login_form_validation()
    {
        // Test with empty fields
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);
        
        $response->assertSessionHasErrors(['email', 'password']);
        
        // Test with invalid email format
        $response = $this->post('/login', [
            'email' => 'not-an-email',
            'password' => 'password',
        ]);
        
        $response->assertSessionHasErrors('email');
    }
    
    /**
     * Test remember me functionality.
     */
    public function test_remember_me_functionality()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
            'remember' => 'on',
        ]);
        
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        
        // Check for the remember_web cookie
        $this->assertNotNull($this->app['cookie']->queued('remember_web'));
    }
    
    /**
     * Test user can logout after login.
     */
    public function test_user_can_logout_after_login()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        $this->assertAuthenticated();
        
        $response = $this->post('/logout');
        
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
