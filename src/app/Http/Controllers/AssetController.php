<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssetResource;
use App\Models\Asset;
use Illuminate\Support\Str;
use App\Http\Requests\Asset\StoreAssetRequest;
use App\Http\Requests\Asset\UpdateAssetRequest;

class AssetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/assets",
     *     summary="Get a list of assets",
     *     tags={"Assets"},
     *      @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function index()
    {
        $assets = Asset::get();
        if ($assets->count() > 0) {
            return AssetResource::collection($assets);
        } else {
            return response()->json(['message' => 'No assets records'], 200);
        }
    }

    /**
     * @OA\Post(
     *     path="/assets",
     *     summary="Create new asset",
     *     tags={"Assets"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateAssetRequest")
     *     ),
     *      @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create([
            'code' => Str::orderedUuid()->toString(),
            'name' => $request->name,
            'status' => $request->status
        ]);
        return response()->json([
            'message' => 'Asset created successfully',
            'data' => new AssetResource($asset)
        ], 200);
    }

    public function show(Asset $asset)
    {
        return new AssetResource($asset);
    }

    /**
     * @OA\Patch(
     *     path="/assets/{id}",
     *     summary="Update asset",
     *     tags={"Assets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the asset to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateAssetRequest")
     *     ),
     *      @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());
        return response()->json([
            'message' => 'Asset updated successfully',
            'data' => new AssetResource($asset)
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/assets/{id}",
     *     summary="Delete a assets",
     *     tags={"Assets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the asset to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Asset deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Asset not found"
     *     )
     * )
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return response()->json([
            'message' => 'Asset deleted successfully',
        ], 200);
    }
}
