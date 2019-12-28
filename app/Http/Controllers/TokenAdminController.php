<?php

namespace App\Http\Controllers;

use App\DownloadToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TokenAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('security_pin');
    }

    public function index(): View
    {
        $tokens = DownloadToken::all();
        return view('pages.tokens')->with(['tokens' => $tokens]);
    }

    public function show($id): RedirectResponse
    {
        return redirect(route('tokens.edit', $id));
    }

    public function edit($id): View
    {
        $token = DownloadToken::findOrFail($id);
        return view('pages.tokens_edit')->with(['token' => $token]);
    }

    public function destroy($id): RedirectResponse
    {
        $token = DownloadToken::findOrFail($id);
        $token->delete();
        return redirect(route('tokens.index'));
    }

    public function create(): View
    {
        return view('pages.tokens_create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'token' => 'required|string|min:3|max:50|unique:download_tokens',
            'download_count' => 'required|integer|min:0',
            'max_download' => 'required|integer|min:1',
            'locale' => 'string|required|in:' . implode(",", config('custom.available_locales'))
        ]);

        $token = new DownloadToken();

        $token->token = $request->input('token');
        $token->download_count = $request->input('download_count');
        $token->max_download = $request->input('max_download');
        $token->locale = $request->input('locale');
        $token->save();

        return redirect()->route('tokens.edit', $token->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'max_download' => 'required|integer|min:1',
            'locale' => 'string|required|in:' . implode(",", config('custom.available_locales'))
        ]);

        $token = DownloadToken::findOrfail($id);
        $token->max_download = $request->input('max_download');
        $token->locale = $request->input('locale');
        $token->save();

        return redirect()->route('tokens.edit', $id);
    }
}
