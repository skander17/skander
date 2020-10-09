<?php


namespace App\Models;


class Provider extends Model
{
    protected  $table = "proveedores";
    protected  $columns = ["id", "razon_social", "id_deta"];
    protected  $alias = [
        "id"=>"Id", "razon_social"=>"Razón Social", "telefono"=>"Telefono","direccion"=>"Dirección","dni"=>"DNI"];
    private $identifier;

    public function __construct()
    {
        $this->identifier = new Identifier();
    }
    /**
     * @return array
     */
    public function getAll()
    {
        return parent::rawQuery("SELECT *, proveedores.id as id 
            FROM proveedores LEFT JOIN identificacion ON proveedores.id_deta = identificacion.id");
    }
    public function find($id)
    {
        $client =  parent::rawQuery("
            SELECT *, proveedores.id as id FROM proveedores JOIN identificacion ON proveedores.id_deta = identificacion.id
                WHERE proveedores.id = ?
        ",[$id]);

        return count($client) > 0 ? (object) $client[0] : null;
    }
    /**
     * @return Identifier
     */
    public function identifier(){
        return $this->identifier;
    }

    /**
     * @param array $data
     * @return object|null
     */
    public function create(array $data)
    {
        $identifier = (new Identifier())->create($data);
        if ($identifier){
            $data['id_deta'] = $identifier->id;
        }
        return parent::create($data);
    }

    /**
     * @param array $data
     * @param array $wheres
     * @return bool|null
     */
    public function update($data, $wheres = [])
    {
        return (new Identifier())->update($data,["id"=>$data['id_deta']]);
    }

    public function destroy($id)
    {
        $provider = $this->find($id);
        parent::delete(['id'=>$id]);
        return $this->identifier->delete(['id'=>$provider->id_deta]);
    }

}