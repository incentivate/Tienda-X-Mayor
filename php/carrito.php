<?php 

session_start();

class Carrito {
	
    protected $contenido_carrito = array();
    
    public function __construct(){
        // toma el carrito de compras de la sesión
        $this->contenido_carrito = !empty($_SESSION['contenido_carrito'])?$_SESSION['contenido_carrito']:NULL;
        if ($this->contenido_carrito === NULL){
            // seteo valores iniciales
            $this->contenido_carrito = array('total_carrito' => 0, 'total_items' => 0);
        }
    }
    
    /*
     Devuelve un arreglo del carrito de compras entero
     */
    public function contiene(){
        // arreglo los primeros items primero
        $cart = array_reverse($this->contenido_carrito);

        // los borro para que no tener problemas cuando muestro la tabla del carrito
        unset($cart['total_items']);
        unset($cart['total_carrito']);

        return $cart;
    }
    
    /*
     Devuelve un item especifico dentro del carrito de compras
     */
    public function get_item($row_id){
        return (in_array($row_id, array('total_items', 'total_carrito'), TRUE) 
        OR !isset($this->contenido_carrito[$row_id]))? FALSE: $this->contenido_carrito[$row_id];
    }
    
    /*
     Devuelve la cantidad de items en el carrito
     */
    public function total_items(){
        return $this->contenido_carrito['total_items'];
    }
    
    /*
     Devuelve el precio total del carrito
     */
    public function total(){
        return $this->contenido_carrito['total_carrito'];
    }
    
    /*
     Inserta items en el carrito
     */
    public function insert($item = array()){
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if(!isset($item['id'], $item['nombre'], $item['precio'], $item['cantidad'])){
                return FALSE;
            }else{
                /*
                 * Insertar Item
                 */
				// setea la cantidad
                $item['cantidad'] = (float) $item['cantidad'];
                if($item['cantidad'] == 0){
                    return FALSE;
                }
                // setea precio
                $item['precio'] = (float) $item['precio'];
                // crea un identificador unico para el item que se va a insertar 
                $rowid = md5($item['id']);
                // toma la cantidad (si existe) y la agrega al total
                $cant_ant = isset($this->contenido_carrito[$rowid]['cantidad']) ? (int) $this->contenido_carrito[$rowid]['cantidad'] : 0;
                // re-crea la entrada con la nueva cantidad y el nuevo identificador
                $item['rowid'] = $rowid;
                $item['cantidad'] += $cant_ant;
                $this->contenido_carrito[$rowid] = $item;
                
                // guarda el carrito
                if($this->guardarCarrito()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }
    
    /*
      Actualiza el carrito
     */
    public function actualizar($item = array()){
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if (!isset($item['rowid'], $this->contenido_carrito[$item['rowid']])){
                return FALSE;
            }else{
                // setea la cantidad
                if(isset($item['cantidad'])){
                    $item['cantidad'] = (float) $item['cantidad'];
                    // saca el item del carrito si la cantidad es igual a cero
                    if ($item['cantidad'] == 0){
                        unset($this->contenido_carrito[$item['rowid']]);
                        return TRUE;
                    }
                }
                
                // busca las claves para actualizarlas
                $keys = array_intersect(array_keys($this->contenido_carrito[$item['rowid']]), array_keys($item));
                // prepara el precio
                if(isset($item['precio'])){
                    $item['precio'] = (float) $item['precio'];
                }
                // el id de producto y el nombre no se deberian cambiar
                foreach(array_diff($keys, array('id', 'nombre')) as $key){
                    $this->contenido_carrito[$item['rowid']][$key] = $item[$key];
                }
                // gurda la info del carrito
                $this->guardarCarrito();
                return TRUE;
            }
        }
    }
    
    /*
      Guarda el arreglo del carrito en la sesion
     */
    protected function guardarCarrito(){
        $this->contenido_carrito['total_items'] = $this->contenido_carrito['total_carrito'] = 0;
        foreach ($this->contenido_carrito as $key => $val){
            // asegurarse de que el arreglo tengo bien los indices
            if(!is_array($val) OR !isset($val['precio'], $val['cantidad'])){
                continue;
            }
     
            $this->contenido_carrito['total_carrito'] += ($val['precio'] * $val['cantidad']);
            $this->contenido_carrito['total_items'] += $val['cantidad'];
            $this->contenido_carrito[$key]['subtotal'] = ($this->contenido_carrito[$key]['precio'] * $this->contenido_carrito[$key]['cantidad']);
        }
        
        // si el carrito está vacio lo borra de la sesión
        if(count($this->contenido_carrito) <= 2){
            unset($_SESSION['contenido_carrito']);
            return FALSE;
        }else{
            $_SESSION['contenido_carrito'] = $this->contenido_carrito;
            return TRUE;
        }
    }
    
    /*
      Borrar un item del carrito
     */
     public function remover($row_id){
        // cerrar sesion y guardar
        unset($this->contenido_carrito[$row_id]);
        $this->guardarCarrito();
        return TRUE;
     }
     
    /*
     	Borra el contenido del carrito y destruye la sesión
     */
    public function destruir(){
        $this->contenido_carrito = array('total_carrito' => 0, 'total_items' => 0);
        unset($_SESSION['contenido_carrito']);
    }
}