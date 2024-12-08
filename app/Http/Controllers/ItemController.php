<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'))->with([
            'items' => $items,
        ]);
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集ページへ移動
     */

    public function edit($edit_id)
        {   
            $edit = Item::find($edit_id);
            $item = Item::find($edit->item_id);
            $items = Item::all();
            return view('item.edit', ['edit' => $edit,]);
        }



    /* 商品情報の更新 */
    public function update(Request $request, $update_id)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            'type' => 'required|max:100',
            'detail' => 'required|max:255',
        ]);
    

        //商品情報の更新
        
        Item::find($update_id)->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'detail' => $request->input('detail'),
        ]);
        return redirect('/items');
    }

        /* 商品削除 */
        public function destroy(Request $request, $delete_id){
            $item = Item::find($delete_id);
            $item->delete();
            return redirect('/items');
        }
}