<?php

namespace App\Jobs\Omie\Produtos;

use App\Models\Models\Market\MarketAPI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispatchSaveProdutos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $produtos;
    private $marketAPI;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($omieProdutos, MarketAPI $marketAPI)
    {
        $this->produtos = $omieProdutos;
        $this->marketAPI = $marketAPI;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->produtos as $produto){
            dispatch(new SaveProduto($produto, $this->marketAPI));
        }
    }
}
