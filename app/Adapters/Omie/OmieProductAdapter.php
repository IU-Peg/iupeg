<?php


namespace App\Adapters\Omie;


class OmieProductAdapter
{
    public function convert($omieProduct)
    {
        $iupegItem = [
            "brand" => $omieProduct["marca"],
            "description" => $omieProduct["descricao"],
        ];

        return $iupegItem;
    }
}
