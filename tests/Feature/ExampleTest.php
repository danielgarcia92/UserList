<?php

namespace Tests\Feature;

use App\User;
use App\Profession;
use function foo\func;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function indexUser()
    {
        $profession = factory(Profession::class)->create();

        factory(User::class)->create([
            'name' => 'Name Test',
            'profession_id' => $profession->id
        ]);

        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Name Test');
    }

    /** @test */
    public function indexUserEmptyUser()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    public function newUser()
    {
        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('Crear usuarios');
    }

    /** @test */
    public function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/users/999999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    public function showUsersDetails()
    {
        $profession = factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'name' => 'Name Test',
            'profession_id' => $profession->id
        ]);

        $this->get("/users/{$user->id}")
            ->assertStatus(200)
            ->assertSee('Name Test');
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        $this->post('users', [
                'name' => 'Name Test',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])->assertRedirect('users');

        $this->assertCredentials([
            'name' => 'Name Test',
            'email' => 'correo@correo.mx',
            'password' => 'password'
        ]);
    }

    /** @test */
    public function the_name_is_required()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users/new')
            ->post('users', [
                'name' => '',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    public function the_email_is_required()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users/new')
            ->post('users', [
                'name' => 'Name Test',
                'email' => '',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['email' => 'El campo correo es obligatorio']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    public function email_invalid()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users/new')
            ->post('users', [
                'name' => 'Name Test',
                'email' => 'email-not-valid',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors('email');

        $this->assertEquals(0, User::count());
    }

    /** @test */
    public function email_unique()
    {
        $profession = factory(Profession::class)->create();
        factory(User::class)->create([
            'email' => 'correo@correo.mx',
            'profession_id' => $profession->id,
        ]);

        $this->from('users/new')
            ->post('users', [
                'name' => 'Name Test',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors('email');

        $this->assertEquals(1, User::count());
    }

    /** @test */
    public function the_profession_id_is_required()
    {
        $this->from('users/new')
            ->post('users', [
                'name' => 'Name Test',
                'email' => 'correo@correo.mx',
                'profession_id' => '',
                'password' => 'password'
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors('profession_id');

        $this->assertEquals(0, User::count());
    }

    /** @test */
    public function the_password_is_required()
    {
        $profession = factory(Profession::class)->create();

        $this->from('users/new')
            ->post('users', [
                'name' => 'Name Test',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => ''
            ])
            ->assertRedirect('users/new')
            ->assertSessionHasErrors('password');

        $this->assertEquals(0, User::count());
    }

    /** @test */
    public function it_loads_the_edit_user_page()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->get("/users/{$user->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id == $user->id;
            });
    }

    /** @test */
    public function it_updates_a_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->put("users/{$user->id}", [
            'name' => 'Name it_updates_a_user',
            'email' => 'correo@correo.mx',
            'profession_id' => $profession->id,
            'password' => 'password'
        ])->assertRedirect(route('users.show', ['user' => $user]));

        $this->assertCredentials([
            'name' => 'Name it_updates_a_user',
            'email' => 'correo@correo.mx',
            'password' => 'password'
        ]);
    }

    /** @test */
    public function the_name_is_required_when_updating_a_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => '',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}/edit")
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('users', ['email' => 'correo@correo.mx']);
    }

    /** @test */
    public function the_email_is_required_when_updating_a_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name the_email_is_required',
                'email' => '',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}/edit")
            ->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('users', ['name' => 'Name the_email_is_required']);
    }

    /** @test */
    public function invalid_email_when_updating_a_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name invalid_email',
                'email' => 'email-non-valid',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}/edit")
            ->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('users', ['name' => 'Name invalid_email']);
    }

    /** @test */
    public function the_email_is_unique_when_updating_a_user()
    {

        $profession = factory(Profession::class)->create();
        factory(User::class)->create([
            'email' => 'existing_email@correo.mx',
            'profession_id' => $profession->id,
        ]);

        $user = factory(User::class)->create([
            'email' => 'replace_email@correo.mx',
            'profession_id' => $profession->id,
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name email_unique',
                'email' => 'existing_email@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}/edit")
            ->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('users', ['name' => 'Name email_unique']);
    }

    /** @test */
    public function the_profession_id_is_required_when_updating_a_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name the_profession_id_is_required',
                'email' => 'correo@correo.mx',
                'profession_id' => '',
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}/edit")
            ->assertSessionHasErrors('profession_id');

        $this->assertDatabaseMissing('users', ['email' => 'correo@correo.mx']);
    }

    /** @test */
    public function the_password_is_optional_when_updating_a_user()
    {
        $oldPassword = 'CONTRASEÑA ANTERIOR';
        $profession = factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'profession_id' => $profession->id,
            'password' => bcrypt($oldPassword)
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name the_password_is_optional',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => ''
            ])
            ->assertRedirect("users/{$user->id}");

        $this->assertCredentials([
            'name' => 'Name the_password_is_optional',
            'email' => 'correo@correo.mx',
            'password' => $oldPassword
        ]);
    }

    /** @test */
    public function the_email_is_optional_when_updating_a_user()
    {
        $profession = factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'email' => 'correo@correo.mx',
            'profession_id' => $profession->id
        ]);

        $this->from("users/{$user->id}/edit")
            ->put("users/{$user->id}", [
                'name' => 'Name the_email_is_optional',
                'email' => 'correo@correo.mx',
                'profession_id' => $profession->id,
                'password' => 'password'
            ])
            ->assertRedirect("users/{$user->id}");  //users.show

        $this->assertDatabaseHas('users', [
            'name' => 'Name the_email_is_optional',
            'email' => 'correo@correo.mx'
        ]);
    }

    /** @test */
    public function it_deletes_user()
    {
        $profession = factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'profession_id' => $profession->id
        ]);

        $this->delete("users/$user->id")
            ->assertRedirect('users');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
