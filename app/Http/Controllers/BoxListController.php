<?php

namespace App\Http\Controllers;

use App\models\BoxList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BoxListController extends Controller
{
    use BaseApiController;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $data['list1'] = BoxList::where('type', 'list1')->where('user_id',$user->id)->get()->toArray();
        $data['list2'] = BoxList::where('type', 'list2')->where('user_id',$user->id)->get()->toArray();

        return $this->apiResponse($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required|unique:box_lists,name'
        ];

        $data = $this->validate(request(), $rules, [], [
            'name' => trans('name'),
        ]);

        $item = BoxList::create([
            'name' => \request('name'),
            'user_id' => $user->id
        ]);

        return $this->apiResponse($item);
    }

    /**
     * Change Element List
     */
    public function changeList(Request $request)
    {
        $user = Auth::user();
        $listItem = BoxList::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        if ($listItem) {
            if ($listItem->type == 'list1') {
                $listItem->type = 'list2';
            } else {
                $listItem->type = 'list1';
            }
            $listItem->save();
            return $this->apiResponse($listItem);
        }
        return $this->apiResponse('','','Not Found',404);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\models\BoxList $boxList
     * @return \Illuminate\Http\Response
     */
    public function show(BoxList $boxList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\models\BoxList $boxList
     * @return \Illuminate\Http\Response
     */
    public function edit(BoxList $boxList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\models\BoxList $boxList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxList $boxList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\models\BoxList $boxList
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoxList $boxList)
    {
        //
    }
}
