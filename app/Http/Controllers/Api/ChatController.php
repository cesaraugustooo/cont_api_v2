<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $chats = Chat::orderBy('created_at','DESC')->paginate();

        return ChatResource::collection($chats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatRequest $request): JsonResponse
    {
        $chat = Chat::create(array_merge($request->validated(),["users_id"=>auth()->user()->id]));

        return response()->json(new ChatResource($chat));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat): JsonResponse
    {
        return response()->json(new ChatResource($chat));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat): JsonResponse
    {
        $chat->update($request->validate(Chat::updateRule()));

        return response()->json(new ChatResource($chat));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Chat $chat): Response
    {
        $chat->delete();

        return response()->noContent();
    }
}
