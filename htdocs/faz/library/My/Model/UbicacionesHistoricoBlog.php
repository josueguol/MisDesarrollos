<?php 
/**
 * Archivo de definición de clase Model para alojar aqui los metodos que referencien a ubicaciones que obtengan informacion del Histórico de Blogs
 * @package azteca.My.Model.Ubicacion
 * @author  RMI
 * @version 1.0.0
 */
class My_Model_UbicacionesHistoricoBlog extends My_Db_TableAzteca implements My_Interface_Submodels{
    protected $_table   = 'ubicacion';
    protected $_primary = 'idUbicacion';

    public $_idEjeHome;

    public function init(){
        //$this->_setAdapter(Zend_Registry::getInstance()->dbAdapter['pruebas']);
    }

    public function getDefault(){ }
	
    public function datosHistoricoBlog() {
    	
	        $sql = "SELECT cb.idCatBlogs as id, cb.cTitulo as cTituloBlog, cb.cContenido,
	                        ca.idCatAutor, ca.cNumEmpleado,  ca.cNombre as cNombreAutor, ca.cBiografia as cAcercaAutor, ca.cAcercaBlog, ca.cTwitter, ca.cFacebook, ca.cUrl as autorUrl, ca.cTeaser,
	                        im.cUrl as imagen, im.cPivotPoint, im.cTitulo as TitImagen, cb.dtFechaCaptura as Fecha, cat.cDescripcion AS categoria
	                FROM catBlogs cb
	                    LEFT JOIN catAutores ca USING (idCatAutor)
	                    LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
	                    LEFT JOIN imagenes im USING (idMultimediaImagenes)
	                    LEFT JOIN rel_Blog_Categorias rb ON rb.idBlog = cb.idCatBlogs
	                    LEFT JOIN categorias cat ON cat.idCategoria = rb.idCategoria
	                WHERE cb.iStatus = 1
	                AND cb.idCatBlogs = {$this->_idEjeHome}
	                ORDER BY cb.idCatBlogs DESC";
	    	$contenido = $this->query($sql);
	    	
	        $sql_imagen = "SELECT i.cUrl as imagenAutor FROM catBlogs cb
	                            LEFT JOIN catAutores ca ON ca.idCatAutor = cb.idCatAutor
	                            LEFT JOIN imagenes i ON i.idMultimediaImagenes = ca.idMultimediaImagen
	                        WHERE cb.idCatBlogs = {$this->_idEjeHome}";
	                
	        $imagen = $this->query($sql_imagen);
	        if(!$imagen) $imagen[0]['imagenAutor'] = '/images/blogs_central.png';
	        $contenido[0]['imagenAutor'] = $imagen[0]['imagenAutor'];
	        $contenido['blogsRelacion'] = $this->blogsRelacionadas($contenido[0]['idCatAutor'], $contenido[0]['id']);

	        return $contenido;
		
    }
    
    /**
     * Regresa los ultimas 5 notas relacionadas con la categoria de la actual y del programa actual
     * Trae la imagen mas grande asignada a dicha nota, para su resampleo dinamico en el phtml
     *
     * @param integer $idAutor
     *
     * @return array
     */
    public function blogsRelacionadas($idAutor = 0, $idCurrentPost = 0){
    	$utilidades = new My_Model_UtileriasCadenas();
    	$sql = "SELECT cb.idCatBlogs as id, cb.cTitulo as cTituloBlog, cb.cContenido,
    	ca.cNombre as cNombreAutor, ca.cBiografia as cAcercaAutor, ca.idCatAutor , ca.cNumEmpleado,
    	ca.cTeaser, im.cUrl as imagen, im.cPivotPoint, im.cTitulo as TitImagen
    	FROM catBlogs cb
    	LEFT JOIN catAutores ca USING (idCatAutor)
    	LEFT JOIN rel_Blog_multimediaImagenes rbmi ON rbmi.idBlog = cb.idCatBlogs
    	LEFT JOIN imagenes im USING (idMultimediaImagenes)
    	WHERE cb.iStatus = 1
    	AND cb.idCatAutor = {$idAutor}
    	AND rbmi.thumbs = 1
    	AND cb.idCatBlogs NOT IN ({$idCurrentPost})
    	ORDER BY cb.idCatBlogs DESC
    	LIMIT 0,4";

    	$stmt = $this->query($sql);
    	foreach ($stmt as $key => $value) {
    		$stmt[$key]['urlBlog'] = "/blog/historico/".$value['id']."/".$utilidades->convierteUrl($value['cTituloBlog']);
    		$stmt[$key]['urlBlogA']= "/blogs/articulo/".$value['id']."/".$utilidades->convierteUrl($value['cTituloBlog']);
    	}
    	 
    	return $stmt;
    }
    
}