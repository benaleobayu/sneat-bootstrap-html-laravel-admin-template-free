<?php

namespace App\Http\Controllers;

use App\Models\Song;

class SongController extends Controller
{
  public function index()
  {
    $data = Song::all();
    return response()->json([
      'status' => 'success',
      'message' => 'Success retrieve all songs',
      'data' => $data
    ], 200);
  }

  public function show(string $id)
  {
    $data = Song::find($id);
    if ($data) {
      return response()->json([
        'status' => 'success',
        'message' => 'Success retrieve a song',
        'data' => $data
      ], 200);
    } else {
      return response()->json([
        'status' => 'failed',
        'message' => 'Song not found'
      ], 404);
    }
  }

  public function store(Request $request)
  {
    $data = Song::create($request->all());
    return response()->json([
      'status' => 'success',
      'message' => 'Song created successfully',
      'data' => $data
    ]);
  }

  public function update(Request $request, string $id)
  {
    $data = Song::find($id);
    if ($data) {
      $data->update($request->all());
      return response()->json([
        'status' => 'success',
        'message' => 'Song updated successfully',
        'data' => $data
      ]);
    } else {
      return response()->json([
        'status' => 'failed',
        'message' => 'Song not found'
      ], 404);
    }
  }

  public function destroy(string $id)
  {
    $data = Song::find($id);
    if ($data) {
      $data->delete();
      return response()->json([
        'status' => 'success',
        'message' => 'Song deleted successfully'
      ]);
    } else {
      return response()->json([
        'status' => 'failed',
        'message' => 'Song not found'
      ], 404);
    }
  }
}
