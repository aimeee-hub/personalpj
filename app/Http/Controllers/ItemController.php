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
        // Item モデルと Type モデルをリレーションで一緒に取得
        $items = Item::with('type')->get();
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
                'name' => 'required|max:50',
                'type' => 'required|max:50',
                'detail' => 'required|max:100',
                'other' =>'required|max:50',
            ]);

            // 種別テーブルにデータ登録または取得
            $type_id = $request->type;
            if ($request->type == 'other') {
                $type = Type::firstOrCreate(
                    ['name' => $request->input('type-name')],  // 検索条件
                    ['detail' => $request->input('type-detail') ?? null] // 新規作成時のみ
                );
                $type_id = $type->id;
            }


            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type_id' => $type_id,
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
        $type = Type::find($edit->type);
        $types = Type::all();
        return view('item.edit', ['edit' => $edit, 'type_id_id' => $type, 'types' => $types,]);
    }

    public function update(Request $request, $update_id)
{
    // バリデーション
    $this->validate($request, [
        'name' => 'required|max:50',
        'type_id' => 'required|exists:types,id',  // type_idがvalidであることを確認
        'detail' => 'required|max:100',
    ]);

    // 商品情報の更新
    Item::find($update_id)->update([
        'name' => $request->input('name'),
        'type_id' => $request->input('type_id'),  // 修正箇所
        'detail' => $request->input('detail'),
    ]);

    return redirect('/items');
}



    /* 商品削除 */
    public function destroy(Request $request, $delete_id)
    {
        $item = Item::find($delete_id);
        $item->delete();
        return redirect('/items');
    }
}
