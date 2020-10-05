<?php


namespace App\Models;


class Provider extends Model
{
    protected  $table = "proveedores";
    protected  $columns = ["id", "razon_social", "id_deta"];
    /**
     * @return array
     */
    public function list()
    {
        return parent::rawQuery("SELECT * FROM proveedores JOIN identificacion ON proveedores.id_deta = identificacion.id");
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

    public function delete($wheres)
    {
        return parent::delete($wheres);
    }

}