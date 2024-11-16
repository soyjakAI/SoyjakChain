<?php

namespace App\Http\Controllers;

use App\Helpers\Classes\Helper;
use App\Models\OpenaiGeneratorChatCategory;
use App\Models\ShareLink;
use App\Models\UserOpenaiChat;
use App\Models\UserOpenaiChatMessage;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function share($category, $chat, $message): View
    {
        abort_unless(
            ShareLink::query()->where('url', request()->fullUrl())->exists(),
            404
        );

        $category = OpenaiGeneratorChatCategory::whereSlug($category)->firstOrFail();
        $chat = UserOpenaiChat::query()->findOrFail($chat);
        $list = $chat->toArray();
        $chatCompletions = str_replace(["\r", "\n"], '', $category->chat_completions);
        $lastThreeMessageQuery = $chat->messages()->whereNot('input', null)->orderBy('created_at', 'desc')->take(2);

        $lastThreeMessage = $lastThreeMessageQuery->get()->reverse();

        if (filled($chatCompletions)) {
            $chatCompletions = json_decode($chatCompletions, true, 512, JSON_THROW_ON_ERROR);
        }

        $messages = $chat->messages()
            ->where('id', '<=', $message)
            ->orderBy('id')
            ->get();

        return view('share.index', [
            'category'         => $category,
            'chat'             => $chat,
            'list'             => $list,
            'chat_completions' => $chatCompletions,
            'lastThreeMessage' => $lastThreeMessage,
            'messages'         => $messages,
        ]);
    }

    public function createLink(Request $request): JsonResponse
    {
        $categoryId = $request->input('category_id');
        $chatId = $request->input('chat_id');

        $category = OpenaiGeneratorChatCategory::query()->find($categoryId);

        $messageId = UserOpenaiChatMessage::query()->where('user_openai_chat_id', $chatId)->latest()->first()->id;
        $time = Carbon::now()->timestamp;

        $url = Helper::parseUrl(config('app.url'), 'share', $category->slug, $chatId, $messageId);
        $url .= '?time=' . $time;

        ShareLink::query()->create([
            'url'      => $url,
            'category' => $category->slug,
            'chat'     => $chatId,
            'message'  => $messageId,
            'time'     => $time,
        ]);

        return response()->json(['link' => $url]);
    }
}