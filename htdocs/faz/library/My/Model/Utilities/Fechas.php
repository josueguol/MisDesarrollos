<?php
/**
 * Archivo de definición de clase 
 * 
 * @package My.Models.Utilities.Fechas
 * @author Pablo
 */

/**
 * Define fecha y la regresa con formato 
 *
 */
class My_Model_Utilities_Fechas extends DateTime
{
	/**
	 * Regresa fecha con formato en español
	 * 'l d \d\e F g:i '
	 * @see DateTime::format()
	 */
	public function format($format) {
        $denglish = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday','January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December');
        $dspanis = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre', 'Diciembre');
        return str_replace($denglish, $dspanis, parent::format($format));
    }
}