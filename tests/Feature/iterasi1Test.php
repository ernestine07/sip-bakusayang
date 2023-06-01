<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use App\Models\menu;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Iterasi1Test extends TestCase
{
    use WithoutMiddleware;
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Authlogin()
    {
        $user = User::where('role_id','1')->first();
        $response = $this->post(route('auth.login'), [
            'username' => $user->username,
            'password' => 'admin'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('Dashboard.index'));

        // $response->assertStatus(302);    
    }

    // public function test_tambah_menu() 
    // {
        
    //     $user = User::where('role_id', '1')->first(); 
    //     Auth::login($user);
    //     // $user1 = factory($user)->make(); 
    //     // dd($user);  
    //     $menu = factory(menu::class)->make();
    //     Storage::fake('local');
    //     $fotoproduk = UploadedFile::fake()->create('fotoproduk.png');

    //     $response = $this->actingAs($menu)
    //                      ->post(route('menu'), [
    //                         'nama_menu'=>'Kopi Susu',
    //                         'kategori_id'=>'1',
    //                         'harga'=>'18000',
    //                         'foto_produk'=>$fotoproduk
    //                      ]);
        
    //                     //  dd($response);
    //     $response->assertStatus(302);
    // }    
    
    public function test_lihat_menu()
    {
        $user = User::where('role_id', '1')->first();

        $response = $this->actingAs($user)->get(route('menu.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_menu() 
    {
        $user = User::where('role_id', '1')->first();

        Storage::fake('local');
        $fotoproduk = UploadedFile::fake()->create('fotoproduk2.png');

        $response = $this->actingAs($user)
                         ->put(route('menu.update', 1), [
                            'nama_menu'=>'Kopi Aren',
                            'kategori_id'=>'1',
                            'harga'=>'18000',
                            'foto_produk'=>$fotoproduk
                         ]);
        $response->assertStatus(302);
    }

    public function test_hapus_menu()
    {
        $user = User::where('role_id', '1')->first();

        $response = $this->actingAs($user)->delete(route('menu.destroy',1));
        $response->assertStatus(302);
    }

    public function test_register()
    {
        $user = User::create([
                'name'=>'ernest',
                'username'=>'ernest',
                'email'=>'ernest1@gmail.com',
                'password' =>Hash::make('123') ,
                // 'remember_token'(),
                'role_id'=>'2',
        ]);
        $customer = Customer::create([
            'nama_customer'=>'ernest',
            'jeniskelamin'=>'perempuan',
            'alamat'=>'Mt. Hryono',
            'no_telepon' =>'135654246',
            'users_id' =>$user->id,
        ]);

        $response = $this->get(url('register_customer'));
        $response->assertStatus(200);
    }

    // public function test_tambah_pegawai() 
    // {
    //     $user = User::where('role_id', '1')->first();   
    //     Storage::fake('local');
    //     $fotopegawai = UploadedFile::fake()->create('fotopegawai.png');

    //     $response = $this->actingAs($user)
    //                      ->post(route('pegawai'), [
    //                         'name' => 'Neris',
    //                         'no_telp' => '1355782',
    //                         'email' => 'neris@gmail.com',
    //                         'username' => 'Neris',
    //                         'password' => '456',
    //                         'role_id' => '4',
    //                         'foto'=>$fotopegawai
    //                      ]);
    //     $response->assertStatus(302);
    // }

    public function test_lihat_pegawai()
    {
        $user = User::where('role_id', '1')->first();

        $response = $this->actingAs($user)->get(route('pegawai.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_pegawai() 
    {
        $user = User::where('role_id', '1')->first();

        Storage::fake('local');
        $fotopegawai = UploadedFile::fake()->create('fotopegawai2.png');

        $response = $this->actingAs($user)
                         ->put(route('pegawai.update', 9), [
                            'name' => 'Karin',
                            'email' => 'karin@gmail.com',
                            'username' => 'karin',
                            'password' => '234',
                            'role_id' => '3',
                            'nama_pegawai'=>'Karin',
                            'no_telp' => '34645725672',
                            'users_id'=>'31',
                            'foto'=>$fotopegawai
                         ]);
        $response->assertStatus(302);
    }

    public function test_hapus_pegawai()
    {
        $user = User::where('role_id', '1')->first();

        $response = $this->actingAs($user)->delete(route('pegawai.destroy',9));
        $response->assertStatus(302);
    }
}
