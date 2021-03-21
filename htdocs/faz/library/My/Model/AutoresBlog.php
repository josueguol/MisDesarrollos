<?php 
/**
 * Archivo de definición de clase Model para obtener los blogs correspondientes al autor seleccionado
 * @package azteca.My.Model.Ubicacion
 * @author  RMI
 * @version 1.0.0
 */
class My_Model_AutoresBlog extends My_Db_TableAzteca implements My_Interface_Submodels{
    protected $_table   = 'ubicacion';
    protected $_primary = 'idUbicacion';

    public $_idEjeHome;
    public $_elementos;
    public $_pagina;

    public function init(){
        //$this->_setAdapter(Zend_Registry::getInstance()->dbAdapter['pruebas']);
    }

    public function getDefault(){ }
	
    public function datosAutores($elementos) {
        $utilidades = new My_Model_UtileriasCadenas();
        $cat		= new My_Model_Categorias();
        
        $categorias = $cat->getCategorias(null,11497);
        
        foreach ($categorias as $k => $v){
        	if($v['idCategoria']>0)
        	$ids_categorias .= $v['idCategoria'].",";
        }
        
        $inicio = ($this->_pagina-1) * $elementos;

        $sql = "SELECT SQL_CALC_FOUND_ROWS
                        cb.idCatBlogs as id, cb.cTitulo as cTituloBlog, cb.cContenido,
                        ca.cNombre as cNombreAutor, ca.cBiografia as cAcercaAutor, ca.idCatAutor , ca.cNumEmpleado, 
                        ca.cTeaser, im.cUrl as imagen, im.cPivotPoint, im.cTitulo as TitImagen
                FROM catBlogs cb
                    LEFT JOIN catAutores ca USING (idCatAutor)
                    LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
                    LEFT JOIN imagenes im USING (idMultimediaImagenes)
                WHERE cb.iStatus = 1
                 AND cb.idCatAutor = {$this->_idEjeHome}
        		AND rbmi.thumbs = 1
                ORDER BY cb.idCatBlogs DESC
                LIMIT {$inicio},{$elementos}";
        
    	$contenido = $this->queryTotal($sql);
    	
    	
    	$sql_autores = "SELECT SQL_CALC_FOUND_ROWS
                        cb.idCatBlogs as id, cb.cTitulo as cTituloBlog,
                        ca.cNombre as cNombreAutor, ca.cBiografia as cAcercaAutor, ca.idCatAutor , ca.cNumEmpleado, 
                        ca.cTeaser, im.cUrl as imgAutor, im.cPivotPoint, im.cTitulo as TitImagen
		                FROM catBlogs cb
		                    LEFT JOIN catAutores ca USING (idCatAutor)
		                    LEFT JOIN imagenes im ON im.idMultimediaImagenes = ca.idMultimediaImagen 
		                    LEFT JOIN rel_Blog_Categorias rb ON rb.idBlog = cb.idCatBlogs
    					WHERE cb.iStatus = 1
    					AND rb.idCategoria IN (".trim($ids_categorias,",").")
    					group by ca.cNombre
                		ORDER BY RAND() DESC
    					LIMIT 3";

    	$autores = $this->query($sql_autores);
    	
    	$contenido[0]['arrayOtrosAutores'] = $autores;
    	$contenido[0]["elementos"] = $elementos;
    	
    	foreach ($contenido[0]['arrayOtrosAutores'] as $key => $value) {
    		$contenido[0]['arrayOtrosAutores'][$key]['urlOtrosAutores']= " /blogs/autor/".$value['idCatAutor']."/".$utilidades->convierteUrl($value['cNombreAutor']);
    	}
    	
        foreach ($contenido as $key => $value) {
            $contenido[$key]['total'] = $this->getTotal();
            $contenido[$key]['urlBlog'] = "/blog/historico/".$value['id']."/".$utilidades->convierteUrl($value['cTituloBlog']);
            $contenido[$key]['urlBlogA']= "/blogs/articulo/".$value['id']."/".$utilidades->convierteUrl($value['cTituloBlog']);
        }
       
    	return $contenido;
    }
    
}