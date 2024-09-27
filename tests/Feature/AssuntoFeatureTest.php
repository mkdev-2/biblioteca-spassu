<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_assunto_pode_ser_criado_via_formulario()
    {
        $data = ['Descricao' => 'Assunto via POST'];

        $response = $this->post('/assuntos', $data);

        $this->assertDatabaseHas('assuntos', ['Descricao' => 'Assunto via POST']);
        $response->assertRedirect('/assuntos');
    }

    /** @test */
    public function assunto_nao_e_criado_com_dados_invalidos()
    {
        $data = ['Descricao' => ''];

        $response = $this->post('/assuntos', $data);

        $response->assertSessionHasErrors(['Descricao']);
    }
}