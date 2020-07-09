<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CRUDController extends Controller {
    // Create
    public function create(Request $req) {
        DB::table('crud')->insert([
            'name' => $req['name'],
            'gender' => $req['gender'],
            'age' => $req['age'],
            'address' => $req['address'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Read
    public function read(Request $req) {
        $data = DB::table('crud')->select(
            'id',
            'name',
            'gender',
            'age',
            'address'
        )->get();
        return $data;
    }

    // Update
    public function update(Request $req) {
        DB::table('crud')->where('id', $req['id'])->update([
            'name' => $req['name'],
            'gender' => $req['gender'],
            'age' => $req['age'],
            'address' => $req['address'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Delete
    public function delete(Request $req) {
        DB::table('crud')->where('id', $req['id'])->delete();
    }
}