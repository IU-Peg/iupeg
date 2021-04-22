<?php

namespace App\Http\Controllers\API\ERP\Omie;

use App\Http\Controllers\Controller;
use App\Jobs\Omie\SyncProdutosJob;
use App\Models\Models\Market\MarketAPI;
use App\Repositories\ERP\OmieRepository;
use Illuminate\Http\Request;

class OmieController extends Controller
{
    public function syncProducts(OmieRepository $omieRepository)
    {
        dispatch(new SyncProdutosJob(MarketAPI::find(1)));
        return response()->json(["success" => "Sincronização de Produtos iniciada"]);
    }

}
