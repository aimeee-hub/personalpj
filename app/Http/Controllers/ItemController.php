<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Type;

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
        $items = Item::all();
        return view('item.index', compact('items'));
    }


    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        //GETリクエストのとき
        if ($request->isMethod('get')) {
            $types = Type::all();
            return view('item.add', compact('types'));
            }
            
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'required|max:100',
                'detail' => 'required|max:255',
            ]);

            $existingType = Type::where('name', $request->input('type'))->first();

            // カテゴリ名が存在しない場合のみ、新しいカテゴリを作成
            if (!$existingType) {
                $type = Type::create(['name' => $request->input('type')]);
            } else {
                $type = $existingType;
            }


            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $type->id,
                'detail' => $request->detail,
                'options' => 'required',
                'other' => 'required_if:options,other',
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
            $type = Type::find($edit->item_id);
            $types = Type::all();
            return view('item.edit', ['edit' => $edit,'type' => $type, 'types' => $types,]);
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