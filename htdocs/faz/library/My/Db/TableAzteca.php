<?php
/**
 *
 * Enter description here ...
 * @author berenice
 *
 */

/**
 *
 * Enter description here ...
 * @author berenice
 *
 */
class My_Db_TableAzteca extends Zend_Db_Table_Abstract
{
	/**
	 * Total de registros devueltos
	 *
	 * @var integer
	 */
	private $_total   = 0;

	/**
	 * Total de registros devueltos en el fetchRows
	 * @var unknown_type
	 */
	private $_totalRows;

	/**
	 * Obtiene el total de registros y obtiene el TOTAL de elementos en la tabla!
	 *
	 * @param mixed $where
	 * @param mixed $order
	 * @param mixed $page Pagina
	 * @param mixed $size Tamaño de pagina
	 * @return mixed Arreglo de elementos
	 */
	public function fetchRows($where = null, $order = null, $page = null,$size = null){

		if($where instanceof Zend_Db_Select ){
			$select = $where;
		}else if (!($where instanceof Zend_Db_Table_Select)) {
			$select = $this->select();

			if ($where !== null) {
				$this->_where($select, $where);
			}

			if ($order !== null) {
				$this->_order($select, $order);
			}

			if ($page !== null || $size !== null) {
				$select->limitPage($page, $size);/*Page size*/
			}

		} else {
			$select = $where;
		}
		;
		$select  = str_replace("SELECT ","SELECT SQL_CALC_FOUND_ROWS ",$select->__toString());
		$result = $this->getAdapter()->query($select)->fetchAll();

		$total = $this->getAdapter()->query("SELECT FOUND_ROWS();")->fetchColumn();

		$this->_setTotalRows($total);

		if(!is_array($result)){
			$result = array(0=>(array)$result);
		}
		return $result;
	}

	/**
	 * Asigna valor a variable total
	 *
	 * @param integer $total
	 * @return void
	 */
	protected function _setTotal($total = 0){
		$this->_total = $total;
	}

	/**
	 * Obtiene el total de registros generados por una consulta
	 *
	 * @return integer
	 */
	public function getTotal(){
		return $this->_total;
	}
	 
	/**
	 * Carga la query en caso de que exista en caché, de lo contrario accede a bd
	 * y carga el resultado de la query en caché
	 *
	 * @param string $sql
	 * @return array|stdClass
	 */
	public function query($sql){
		$db           = $this->getAdapter();
		$stmt         = $db->query($sql)->fetchAll();
		if(!is_array($stmt)) $stmt = array(0=>(array)$stmt);
		return $stmt;
	}

	/**
	 * Carga la query en caso de que exista en caché, de lo contrario accede a bd
	 * y carga el resultado de la query en caché
	 *
	 * @param string $sql
	 * @return array|stdClass
	 */
	public function queryb($sql){
		$db           = $this->getAdapter();
		$stmt         = $db->query($sql);
		if(!is_array($stmt)) $stmt = array(0=>(array)$stmt);
		return $stmt;
	}

	/**
	 * Carga la query en caso de que exista en caché, de lo contrario accede a bd
	 * y carga el resultado de la query en caché
	 *
	 * @param string $sql
	 * @return array|stdClass
	 */
	public function queryTotal($sql){
			
		$db      = $this->getAdapter();
		$select  = str_replace("SELECT ","SELECT SQL_CALC_FOUND_ROWS ",$sql);
		$stmt    = $db->query($select)->fetchAll();
		$total   = $db->query("SELECT FOUND_ROWS();")->fetchColumn();
		$this->_setTotal($total);
		if(!is_array($stmt)) $stmt = array(0=>(array)$stmt);
		return $stmt;
	}	
	
	/**
	 * Inserts a new row.
	 *
	 * @param  array  $data  Column-value pairs.
	 * @return mixed         The primary key of the row inserted.
	 */
	public function insert(array $data){
		$primary = parent::insert($data);
		return $primary;
	}

	/**
	 * Updates existing rows.
	 *
	 * @param  array        $data  Column-value pairs.
	 * @param  array|string $where An SQL WHERE clause, or an array of SQL WHERE clauses.
	 * @return int          The number of rows updated.
	 */
	public function update(array $data, $where){
		$numrows = parent::update($data, $where);
		return $numrows;
	}

	/**
	 * Deletes existing rows.
	 *
	 * @param  array|string $where SQL WHERE clause(s).
	 * @return int          The number of rows deleted.
	 */
	public function delete($where){
		$numrows = parent::delete($where);
		return $numrows;
	}
}