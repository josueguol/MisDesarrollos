<?php
/**
 * Archivo de definición de clase Model para alojar aqui los metodos que referencien a ubicaciones que obtengan informacion de Blogs
 * @package azteca.My.Model.Ubicacion
 * @author  RMI
 * @version 1.0.0
 */
class My_Model_UbicacionesBlog extends My_Db_TableAzteca implements My_Interface_Submodels {
	protected $_table = 'ubicacion';
	protected $_primary = 'idUbicacion';
	public $_elementos;
	public $_pagina;
	public $_idProg;
	public $tPurgar;
	
	public function init() {
		$this->_setAdapter ( Zend_Registry::getInstance ()->dbAdapter ['cmsAzteca'] );
	}
	
	public function getDefault() {
	}
	
	public function datosBlog($elementos) {
		$utilidades = new My_Model_UtileriasCadenas ();
		$inicio = ($this->_pagina - 1) * $elementos;
		$db = $this->getAdapter ();
		
		$inicio = intval ( $inicio ) + 3;
		
		$sql = "SELECT SQL_CALC_FOUND_ROWS
			                    cb.idCatBlogs as id, cb.cTitulo as cTituloBlog,
			                    cb.cContenido as cAcercaBlog, 
			                    ca.cNombre as cNombreAutor, ca.idCatAutor, ca.cUrl,
			                    im.cUrl as imgAutor, im.cPivotPoint, im.cTitulo as TitImagen,
			                    cb.dtFechaCaptura as Fecha, cat.cDescripcion AS categoria 
			                FROM catBlogs cb
			                    LEFT JOIN catAutores ca USING (idCatAutor)                    
			                    LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
			        			LEFT JOIN rel_Blog_Programas rbp ON rbp.idBlog = cb.idCatBlogs
								LEFT JOIN imagenes im USING (idMultimediaImagenes)
								LEFT JOIN rel_Blog_Categorias rb ON rb.idBlog = cb.idCatBlogs
	                    		LEFT JOIN categorias cat ON cat.idCategoria = rb.idCategoria
			                WHERE cb.iStatus = 1
			                	AND ca.idMultimediaImagen IS NOT NULL
			                    AND rbp.idPrograma = '{$this->_idProg}'	        			
			                ORDER BY cb.dtFechaCaptura DESC
			                LIMIT {$inicio},{$elementos}";
		
		$sqlMasVisto = "SELECT SQL_CALC_FOUND_ROWS
				        cb.idCatBlogs as id, cb.cTitulo as cTituloBlog,
				        cb.cContenido as cAcercaBlog,
				        ca.cNombre as cNombreAutor, ca.idCatAutor, ca.cUrl,
				        im.cUrl as imgAutor, im.cPivotPoint, im.cTitulo as TitImagen
				        FROM catBlogs cb
				        LEFT JOIN catAutores ca USING (idCatAutor)
				        LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
				        LEFT JOIN rel_Blog_Programas rbp ON rbp.idBlog = cb.idCatBlogs
				        LEFT JOIN imagenes im USING (idMultimediaImagenes)
				        WHERE cb.iStatus = 1
				        AND ca.idMultimediaImagen IS NOT NULL
				        AND rbp.idPrograma = '{$this->_idProg}'
				        ORDER BY cb.dtFechaCaptura DESC";
		
		$contenidoMasVisto = $db->query ( $sqlMasVisto )->fetchAll ();
		$contenido = $db->query ( $sql )->fetchAll ();
		
		$arrayMasVisto = array ();
		
		for($i = 0; $i < sizeof ( $contenidoMasVisto ); $i ++) {
			if ($i < 3) {
				array_push ( $arrayMasVisto, $contenidoMasVisto [$i] );
			}
		}
		
		$total = $db->query ( "SELECT FOUND_ROWS();" )->fetchColumn ();
		foreach ( $contenido as $key => $value ) {
			$contenido [$key] ['total'] = $total;
			$contenido [$key] ['urlBlog'] = "/blog/historico/" . $value ['id'] . "/" . $utilidades->convierteUrl ( $value ['cTituloBlog'] );
			$contenido [$key] ['urlBlogA'] = "/blogs/articulo/" . $value ['id'] . "/" . $utilidades->convierteUrl ( $value ['cTituloBlog'] );
		}
		
		$contenido [0] ["elementos"] = intval ( $elementos );
		$contenido [0] ["MasVistos"] = $arrayMasVisto;
		
		foreach ($contenido [0]["MasVistos"] as $key => $value ) {
			$contenido [0]["MasVistos"][$key]['urlMasVisto'] = "/blogs/articulo/" . $value ['id'] . "/" . $utilidades->convierteUrl ( $value ['cTituloBlog'] );
		}
		
		$contenido [0] ["inicio"] = $inicio + sizeof ( $contenido );
		$contenido [0] ["total"] = sizeof ( $contenidoMasVisto );
		
		return $contenido;
	}
}