<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Services\LinkService;
use DB;

class LinkController extends Controller
{
    private $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    //cadastrar link
    public function addLink(Request $request)
    {

        $data = [
            'id_user' => auth()->user()->id,
            'id_social_network' => $request->id_social_network,
            'link' => trim($request->link),
            'status' => 'A',
        ];

        $response = $this->linkService->addLink($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    //editar link
    public function editLink(Request $request)
    {

        $data = [
            'id_social_network' => $request->id_social_network,
            'link' => $request->link ,
            'id' => trim($request->id_link),
        ];

        $response = $this->linkService->editLink($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    //buscar links
    public function searchLinksByUser()
    {
        $response = $this->linkService->searchLinksByUser(auth()->user()->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    //buscar links
    public function searchLinksByUrl()
    {
        $url_name = $_GET['url_name'];
        $user = DB::select( DB::raw("select * from users where url_name = '".$url_name."' "))[0];

        $response = $this->linkService->searchLinksByUser($user->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    //buscar link
    public function searchLinkById()
    {
        $id = $_GET['id'];
        $response = $this->linkService->searchLinkById($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}