<?php


namespace App\Models;


class Client extends Model
{
    protected  $table = "clientes";
    protected  $columns = ["id", "id_deta"];
    private $identifier;

    public function __construct()
    {
        $this->identifier = new Identifier();
    }

    /**
     * @return array
     */
    public function list()
    {
        return parent::rawQuery("SELECT *, clientes.id as id FROM clientes JOIN identificacion ON clientes.id_deta = identificacion.id");
    }
    public function identifier(){
        return $this->identifier;
    }
    /**
     * @param array $data
     * @return object|null
     */
    public function create(array $data)
    {
        $identifier = $this->identifier->create($data);
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
        return $this->identifier->update($data,["id"=>$data['id_deta']]);
    }

    public function destroy($id)
    {
        $client = $this->find($id);
        parent::delete(['id'=>$id]);
        return $this->identifier->delete(['id'=>$client->id_deta]);
    }
}