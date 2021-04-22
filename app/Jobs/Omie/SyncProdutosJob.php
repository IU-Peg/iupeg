<?php

namespace App\Jobs\Omie;

use App\Jobs\Omie\Produtos\DispatchSaveProdutos;
use App\Models\Models\Market\MarketAPI;
use App\Repositories\ERP\OmieRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncProdutosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $marketAPI;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MarketAPI $marketAPI)
    {
        $this->marketAPI = $marketAPI;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $omieRepository = new OmieRepository();
        $omieRepository->setAuth($this->marketAPI->api_key, $this->marketAPI->api_secret);
        $actual_page = 1;
        do{
            $omieRepository->getProducts(["pagina" => $actual_page]);

            if($omieRepository->getError())
               dd($omieRepository->getError());

            $omieResponse = $omieRepository->getBody();

            $pages_total = $omieResponse["total_de_paginas"];

            $products = $omieResponse["produto_servico_cadastro"];

            dispatch(new DispatchSaveProdutos($products, $this->marketAPI));
            $actual_page++;

        }while($actual_page <= $pages_total);
    }
}
