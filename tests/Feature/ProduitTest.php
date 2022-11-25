<?php

namespace Tests\Feature;

use App\Models\Produit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProduitTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function show_all_produit()
    {
        Produit::factory()->create();

        $response = $this->json('GET', route('path.index'));

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to view Response */
        //print_r($response->json());
    }

    /** @test */
    public function create_produit()
    {
        $response = $this->json('POST', route('path.store'), [
            'title' => 'Dummy title',
            'stock' => 1
        ]);

        $response->assertStatus(200);

        $this->assertEquals('Dummy title',$response->json()['data']['title']);

        /* Uncomment to show Response */
        //print_r($response->json());
    }

    /** @test */
    public function show_specific_produit()
    {
        $this->json('POST', route('path.store'), [
            'title' => 'Dummy title',
            'stock' => 1
        ]);

        $produit = Produit::all()->first();

        $response = $this->json('GET', route('path.show',$produit->id));

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to show Response */
        //print_r($response->json());
    }

    /** @test */
    public function update_produit()
    {
        $this->json('POST', route('path.store'), [
            'title' => 'Dummy title',
            'stock' => 1
        ]);

        $produit = Produit::all()->first();

        $response = $this->json('PUT', route('path.show',$produit->id),['title' => 'Dummy updated title']);

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to show Response */
        //print_r($response->json());
    }

    /** @test */
    public function delete_produit()
    {
        $this->json('POST', route('path.store'), [
            'title'       => 'Dummy title',
            'stock' => 1
        ]);

        $produit = Produit::all()->first();
        if ($produit != null) {
            $response = $this->json('DELETE', route('path.destroy', $produit->id));
        }

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to show Response */
        //print_r($response->json());
    }
}