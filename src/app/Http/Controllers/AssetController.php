<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssetResource;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\Asset\StoreAssetRequest;
use App\Http\Requests\Asset\UpdateAssetRequest;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::get();
        if ($assets->count() > 0) {
            return AssetResource::collection($assets);
        } else {
            return response()->json(['message' => 'No assets records'], 200);
        }
    }

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

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());
        return response()->json([
            'message' => 'Asset updated successfully',
            'data' => new AssetResource($asset)
        ], 200);
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return response()->json([
            'message' => 'Asset deleted successfully',
        ], 200);
    }
}
