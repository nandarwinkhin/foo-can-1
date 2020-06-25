<?php

namespace App\Http\Controllers\Admin;


use App\Components\Core\Result;
use App\Components\CardType\Models\CardType;
use App\Components\CardType\Repositories\CardTypeRepository;
use Illuminate\Http\Request;
use Auth;

class CardTypeController extends AdminController
{
    /**
     * @var CardTypeRepository
     */
    private $CardTypeRepository;

    /**
     * CardTypeController constructor.
     * @param CardTypeRepository $CardTypeRepository
     */
    public function __construct(CardTypeRepository $CardTypeRepository)
    {
        $this->CardTypeRepository = $CardTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->CardTypeRepository->index(request()->all());
        // $data  = CardType::all()->get()->first();
        // echo $data;
        // $res ponse["data"] = $data();
        // return response()->json($data);
        
        return $this->sendResponseOk($data,"ok");
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate = validator($request->all(),[
        //     'cardTypeName' => 'string',
        //     'cardTypeDescription' => 'string',
        //     'CreatedBy' => 'integer',
        // ]);

        // if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        // $cardtype = $this->CardTypeRepository->create($request->all());
        $CardType = new CardType ();
        $CardType->cardTypeName = $request->cardTypeName;
        $CardType->cardTypeDescription = $request->cardTypeDescription;
        $CardType->CreatedBy =Auth::user()->id;
        $CardType->save ();
        // return $CardType;
        // return response()->json($CardType);
        // if(!$cardtype) return $this->sendResponseBadRequest("Failed to create");

        return $this->sendResponseCreated($CardType);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cardtype = $this->CardTypeRepository->find($id);

        if(!$cardtype) return $this->sendResponseNotFound();

        return $this->sendResponseOk($cardtype);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator($request->all(),[
            'cardTypeName' => 'string',
            'cardTypeDescription' => 'string',
            'CreatedBy' => 'integer',
        ]);

        if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        $updated = $this->CardTypeRepository->update($id,$request->all());

        if(!$updated) return $this->sendResponseBadRequest("Failed update.");

        return $this->sendResponseUpdated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var CardType $cardtype */
        $cardtype = $this->CardTypeRepository->find($id);

        if(!$cardtype) return $this->sendResponseNotFound();

        // // prevent delete of super user permission
        // if($cardtype->key == CardType::SUPER_USER_PERMISSION_KEY)
        // {
        //     return $this->sendResponseBadRequest("Cannot delete permission.");
        // }

        $this->CardTypeRepository->delete($id);

        return $this->sendResponseDeleted();
    }
}
