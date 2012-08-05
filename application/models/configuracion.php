<?php
class Configuracion extends DataMapper{
    var $table = 'configuracion';

    public function get_nombre_empresa()
    {
        $this->limit(1)->get();
        $this->config->set_item('nombre_empresa',$this->nombre_empresa);
        return $this->nombre_empresa;
    }
}
//end of file