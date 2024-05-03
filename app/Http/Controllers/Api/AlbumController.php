<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index()
  {
    $data = Album::orderBy('id', 'asc')->get();
    return response()->json([
      'status' => 'success',
      'message' => 'Success retrieve all albums',
      'data' => $data
    ],200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    $data = Album::create($request->all());
    return response()->json([
      'status' => 'success',
      'message' => 'Album created successfully',
      'data' => $data
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show($id)
  {
    $data = Album::find($id);
    if ($data) {
      return response()->json([
        'status' => 'success',
        'message' => 'Success retrieve an album',
        'data' => $data
      ], 200);
    } else {
      return response()->json([
        'status' => 'failed',
        'message' => 'Album not found'
      ], 404);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, $id)
  {
    $data = Album::find($id);
    if ($data) {
      $data->update($request->all());
      return response()->json([
        'status' => 'success',
        'message' => 'Album updated successfully',
        'data' => $data
      ]);
    } else {
      return response()->json([
        'status' => 'failed',
        'message' => 'Album not found'
      ], 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id)
  {
    $data = Album::find($id);
    if ($data) {
      $data->delete();
      return response()->json([
        'status' => 'success',
        'message' => 'Album deleted successfully'
      ]);
    }else{
      return response()->json([
        'status' => 'failed',
        'message' => 'Album not found'
      ], 404);
    }
  }
}
