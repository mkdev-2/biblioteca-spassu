<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutorFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_autor_pode_ser_criado_via_formulario()
    {
        $data = ['Nome' => 'Autor via POST'];

        $response = $this->post('/autores', $data);

        $this->assertDatabaseHas('autores', ['Nome' => 'Autor via POST']);
        $response->assertRedirect('/autores');
    }

    /** @test */
    public function autor_nao_e_criado_com_dados_invalidos()
    {
        $data = ['Nome' => ''];

        $response = $this->post('/autores', $data);

        $response->assertSessionHasErrors(['Nome']);
    }
}