<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Requests\Module\IndexModuleRequest;
use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Resources\Module\IndexModuleResource;
use App\Http\Resources\Module\ShowModuleResource;
use App\Http\Resources\Module\StoreModuleResource;
use App\Http\Resources\Module\UpdateModuleResource;

class ModuleController extends Controller
{
    public function index(IndexModuleRequest $request)
    {
        $modules = Module::all();

        return response()->json([
            'message' => 'Module fetched successfully.',
            'data'    => IndexModuleResource::collection($modules)
        ]);
    }

    public function show(IndexModuleRequest $request, Module $module)
    {
        return new ShowModuleResource($module);
    }

    public function store(StoreModuleRequest $request)
    {
        $module = Module::create($request->validated());
        return response()->json([
            'message' => 'Module created successfully.',
            'data'    => new StoreModuleResource($module)
        ]);
    }

    public function update(StoreModuleRequest $request, Module $module)
    {
        $module->update($request->validated());
        return response()->json([
            'message' => 'Module updated successfully.',
            'data'    => new UpdateModuleResource($module)
        ]);
    }

    public function destroy(IndexModuleRequest $request, Module $module)
    {
        $module->delete();
        return response()->json(['message' => 'Module deleted successfully.']);
    }
}
