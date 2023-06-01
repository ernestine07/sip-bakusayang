<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Aset;
use App\Models\Cart;
use App\Models\User;
use App\Models\menu;

class Iterasi3Test extends TestCase
{
    use WithoutMiddleware;
// use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_input_stok_barang()
    {
        // $dataaset = User::where('role_id', '5')->first();
        // // $menu = Aset::where('menu_id', 1)->first();
        // dd($dataaset);
        // $response = $this->actingAs($dataaset)
        //                  ->post(route('Aset.store'), [
        //                 'nama_barang'=>'Gula',
        //                 'stok'=>'2',
        //                 'tanggal'=>'2023-03-10 00:00:00',
        //                  ]);

        // $response->assertStatus(201);
    
        // // $response = $this->post(route('Aset.store'), $response);

        $user = Auth::user('role_id','5');
        // dd($user);
        $response = $this->actingAs($user)
                         ->post(route('Aset.store'), [
                            'nama_barang'=>'sirup',
                            'stok'=>'5',
                            'tanggal'=>'2023-03-10 00:00:00'
                         ]);

        // $datauser = User::where('role_id', '5')->first();  
        // $dataaset = Aset::create();
        // $response = $this->actingAs($dataaset)
        //                  ->post(route('Aset.store'), [
        //                     'nama_barang'=>'sirup',
        //                     'stok'=>'5',
        //                     'tanggal'=>'2023-03-10 00:00:00'
        //                  ]);

        $response->assertStatus(200);
    }

    // public function test_ubah_stok_barang() 
    // {
    //     $user = User::where('role_id', '1')->first();
    //     $response = $this->actingAs($user)
    //                      ->put(route('Aset.update', 1), [
    //                         'nama_barang'=>'caramel',
    //                         'stok'=>'8',
    //                         'tanggal'=>'2023-03-10 00:00:00'
    //                      ]);
    //     $response->assertStatus(302);
    // }

    // public function test_lihat_stok_barang()
    // {
    //     $user = User::where('role_id', '1')->first();

    //     $response = $this->actingAs($user)->get(route('Aset.index'));
    //     $response->assertStatus(200);
    // }

    // public function test_order()
    // {

    //     $response = $this->get(route('Customer.menu'));

    //     $response->assertStatus(302);
    // }
}
