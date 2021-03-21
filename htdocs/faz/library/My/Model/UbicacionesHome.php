<?php
/**
 * Archivo de definición de clase Model para alojar aqui los metodos que referencien a ubicaciones que obtengan informacion de Blogs
 * @package azteca.My.Model.Ubicacion
 * @author  RMI
 * @version 1.0.0
 */
class My_Model_UbicacionesHome extends My_Db_TableAzteca implements My_Interface_Submodels {
	protected $_table = 'ubicacion';
	protected $_primary = 'idUbicacion';
	public $_elementos;
	public $_pagina;
	public $_idProg;
	public function init() {
		$this->_setAdapter ( Zend_Registry::getInstance ()->dbAdapter ['cmsAzteca'] );
	}
	public function getDefault() {
	}
	public function datosBlog() {
		$utilidades = new My_Model_UtileriasCadenas ();
		$db = $this->getAdapter ();
		
		$sql = "SELECT SQL_CALC_FOUND_ROWS
			                    cb.idCatBlogs as id, cb.cTitulo as cTituloBlog,
			                    cb.cContenido as cAcercaBlog, 
			                    ca.cNombre as cNombreAutor, ca.idCatAutor, ca.cUrl,
			                    im.cUrl as imgAutor, im.cPivotPoint, im.cTitulo as TitImagen,
			                    cat.idCategoria as idCategoria
			                FROM catBlogs cb
			                    LEFT JOIN catAutores ca USING (idCatAutor)                    
			                    LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
			        			LEFT JOIN rel_Blog_Programas rbp ON rbp.idBlog = cb.idCatBlogs
			        			LEFT JOIN rel_Blog_Categorias rbc ON rbc.idBlog = cb.idCatBlogs
								LEFT JOIN imagenes im USING (idMultimediaImagenes)
								LEFT JOIN categorias cat USING (idCategoria)
			                WHERE cb.iStatus = 1
			                    AND rbp.idPrograma = '{$this->_idProg}'	        			
			                ORDER BY cb.dtFechaCaptura DESC";
		
		// AND ca.idMultimediaImagen IS NOT NULL
		// $contenido = $this->queryTotal($sql);
		$contenido = $db->query ( $sql )->fetchAll ();
		
		$total = $db->query ( "SELECT FOUND_ROWS();" )->fetchColumn ();
		foreach ( $contenido as $key => $value ) {
			$contenido [$key] ['total'] = $total;
			$contenido [$key] ['urlBlog'] 	= "/blog/historico/" . $value ['id'] . "/" . $utilidades->convierteUrl ( $value ['cTituloBlog'] );
			$contenido [$key] ['urlBlogA'] 	= "/blogs/articulo/".$value['id']."/".$utilidades->convierteUrl($value['cTituloBlog']);
		}
		
		return $contenido;
	}
}