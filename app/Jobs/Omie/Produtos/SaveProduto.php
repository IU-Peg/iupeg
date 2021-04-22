<?php

namespace App\Jobs\Omie\Produtos;

use App\Adapters\Omie\OmieProductAdapter;
use App\Models\Models\Items\Item;
use App\Models\Models\Market\MarketAPI;
use App\Models\Models\Market\MarketItems;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveProduto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $produto;
    private $marketAPI;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($produtoOmie, MarketAPI $marketAPI)
    {
        $this->produto = $produtoOmie;
        $this->marketAPI = $marketAPI;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        /**
         * Exemplo de produto da Omie

        [
        "aliquota_cofins" => 0
        "aliquota_ibpt" => 0
        "aliquota_icms" => 0
        "aliquota_pis" => 0
        "altura" => 0
        "bloqueado" => "N"
        "bloquear_exclusao" => "N"
        "cest" => ""
        "cfop" => ""
        "codInt_familia" => ""
        "codigo" => "1000"
        "codigo_beneficio" => ""
        "codigo_familia" => 0
        "codigo_produto" => 1485108568
        "codigo_produto_integracao" => ""
        "csosn_icms" => ""
        "cst_cofins" => ""
        "cst_icms" => ""
        "cst_pis" => ""
        "dadosIbpt" => array:8 [
        "aliqEstadual" => 0
        "aliqFederal" => 0
        "aliqMunicipal" => 0
        "chave" => ""
        "fonte" => ""
        "valido_ate" => ""
        "valido_de" => ""
        "versao" => ""
        ]
        "descr_detalhada" => ""
        "descricao" => "Mouse sem fio Microsoft"
        "descricao_familia" => ""
        "dias_crossdocking" => 0
        "dias_garantia" => 0
        "ean" => ""
        "estoque_minimo" => 0
        "exibir_descricao_nfe" => "N"
        "exibir_descricao_pedido" => "N"
        "importado_api" => "N"
        "inativo" => "N"
        "info" => array:6 [
        "dAlt" => "14/04/2021"
        "dInc" => "14/04/2021"
        "hAlt" => "12:38:05"
        "hInc" => "12:38:05"
        "uAlt" => "P000256704"
        "uInc" => "P000256704"
        ]
        "largura" => 0
        "marca" => ""
        "motivo_deson_icms" => ""
        "ncm" => "9504.10.99"
        "obs_internas" => ""
        "per_icms_fcp" => 0
        "peso_bruto" => 0
        "peso_liq" => 0
        "profundidade" => 0
        "quantidade_estoque" => 0
        "recomendacoes_fiscais" => array:7 [
        "cnpj_fabricante" => ""
        "cupom_fiscal" => "N"
        "id_cest" => ""
        "id_preco_tabelado" => 0
        "indicador_escala" => ""
        "market_place" => "N"
        "origem_mercadoria" => ""
        ]
        "red_base_icms" => 0
        "tipoItem" => "00"
        "unidade" => "UN"
        "valor_unitario" => 150
        ]
         */
        $new_item = (new OmieProductAdapter())->convert($this->produto);

        $item = Item::query()->updateOrCreate($new_item);

        MarketItems::query()->updateOrCreate([
            "market_id" => $this->marketAPI->market_id,
            "item_id" => $item->id,
            "ean" => $this->produto["ean"].random_int(111111, 999999)
        ], [
            "unit_price" => (float) $this->produto["valor_unitario"],
            "stock" => $this->produto["quantidade_estoque"],
            "active" => $this->produto["inativo"] == "N" ? 0 : 1
        ]);
    }
}
