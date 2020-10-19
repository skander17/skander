<?php


namespace App\Models;


class Purchase extends Model
{
    protected $table = "compras";
    protected $primaryKey = "id_compra";
    protected $columns = ["id_compra","proveedor","monto_total","tipo_pago"];


    public function getAll(){
        $purchases = $this->rawQuery(" 
        SELECT compras.*,(
                SELECT JSON_ARRAYAGG(det_compras.id) FROM det_compras where compras.id_compra=det_compras.id_compra
            ) as detalles FROM compras
        ");
        $detail_model = new PurchaseDetail();
        foreach ($purchases as & $purchase){
            $purchase['details'] = json_decode($purchase['details']);
            $aux_det = [];
            foreach ($purchase['details'] as $detail){
                $aux_det[] =$detail_model->find($detail);
            }
            $purchase['details'] = $aux_det;
        }
        return $purchases;
    }
}