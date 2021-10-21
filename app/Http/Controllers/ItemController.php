<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Attachment;
use Exception;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Item::class, 'item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = new Item();
        $item->fill($request->all());

        $item->user_id = $request->user()->id;

        $files = $request->file;

        DB::beginTransaction();

        try {

            $item->save();

            $paths = [];

            foreach ($files as $file) {

                $name = $file->getClientOriginalName();

                $path = Storage::putFile('items', $file);
                if (!$path) {
                    throw new \Exception("ファイルの保存に失敗しました。");
                }
                $paths[] = $path;
                // dd($path);

                $attachment = new Attachment([
                    'item_id' => $item->id,
                    'org_name' => $name,
                    'name' => basename($path)
                ]);

                $attachment->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            if (!empty($paths)) {
                foreach ($paths as $path) {
                    Storage::delete($path);
                }
            }
            DB::rollback();
            return back()
                ->withErrors(['error' => '保存に失敗しました']);
        }
        return redirect(route('items.index'))->with(['flash_message' => '登録が完了しました']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        $item->fill($request->all());

        try {
            $item->save();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '保存に失敗しました']);
        }
        return redirect(route('items.index'))->with(['flash_message' => '更新が完了しました']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        DB::beginTransaction();
        try {
            $paths = $item->image_paths;
            foreach ($paths as $path) {
                if (!Storage::delete($path)) {
                    throw new Exception('ファイルの削除を失敗しました');
                }
            }
            $attachment = Attachment::where('item_id', $item->id);
            $attachment->delete();
            $item->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->getMessage());
        }
        return redirect()
            ->route('items.index')
            ->with(['flash_message' => '削除しました']);
    }
}
