<?php
namespace App\Http\Controllers;
use App\crud;
use Illuminate\Http\Request;

class CRUDController extends Controller {
    // Create
    public function create(Request $request) {
        $data = crud::create($request->all());
        return response()->json($data, 201);
    }

    // Get
    public function index() {
        return crud::all();
    }

    // Update
    public function update(Request $request) {
        crud::where('id', $request->id)->update($request->all());
    }

    // Delete
    public function delete(Request $request) {
        crud::where('id', $request->id)->delete();
    }
}