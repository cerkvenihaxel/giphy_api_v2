<?php

namespace App\Http\Controllers;

use App\Models\SavedGifs;
use Illuminate\Http\Request;
use App\Services\GiphyService;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
use App\Traits\ValidatorResponse;


class GiphyController extends Controller
{
    use ApiResponse;
    use ValidatorResponse;
    protected $giphyService;

    public function __construct(GiphyService $giphyService, LogInfoController $logInfoController)
    {
        $this->giphyService = $giphyService;
        $this->logInfo = $logInfoController;
    }

    public function search(Request $request){

        $rules = [
            'query' => 'required|string',
            'limit' => 'integer|min:1',
            'offset' => 'integer|min:0'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($response = $this->validationFails($validator)) {
            return $response;
        }

        $query = $request->query('query');
        $limit = $request->query('limit');
        $offset = $request->query('offset');

        try {
            $results = $this->giphyService->searchGifs($query, $limit, $offset);
            $this->logInfo->registerActivity('search', $query, 200, $request);
            return $this->successBody($results);
        } catch (\Exception $e){
            $this->logInfo->registerActivity('search', $query, 400, $request);
            return $this->invalid($e->getMessage());
        }
    }


    public function searchById(Request $request){

        $rules = [
            'id' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($response = $this->validationFails($validator)) {
            return $response;
        }

        $id = $request->query('id');

        try {
            $results = $this->giphyService->searchGifById($id);
            $this->logInfo->registerActivity('searchById', $id, 200, $request);
            return $this->successBody($results);
        } catch (\Exception $e){
            $this->logInfo->registerActivity('searchById', $id, 400, $request);
            return $this->invalid($e->getMessage());
        }
    }


    public function saveGifs(Request $request){

        $rules = [
            'gif_id' => 'required|string',
            'alias' => 'required|string|min:1',
            'user_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($response = $this->validationFails($validator)) {
            return $response;
        }

        try {
        $gif_id = $request->input('gif_id');
        $alias = $request->input('alias');
        $user_id = $request->input('user_id');

        $saveGif = new SavedGifs();
        $saveGif->gif_id = $gif_id;
        $saveGif->alias = $alias;
        $saveGif->user_id = $user_id;
        $saveGif->save();

        $this->logInfo->registerActivity('saveGif', $gif_id, 200, $request);
        return $this->success('Gif saved correctly');

        } catch (\Exception $e){
            $this->logInfo->registerActivity('saveGif', $request->all(), 500, $request);
            return response()->json([
                'message' => 'An error occurred while saving your Gif',
                'error' => 'Please provide a valid User ID'
            ], 500);
        }

    }

}
