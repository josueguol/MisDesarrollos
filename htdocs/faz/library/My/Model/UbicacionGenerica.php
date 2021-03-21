<?php
/**
 * Archivo de definición de model para obtener datos de ubicacion generica
 * @package aztecaespectaculos.My.Model.UbicacionGenerica
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de model  para obtener datos de ubicacion generica
 * @package aztecaespectaculos.My.Model.UbicacionGenerica
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_UbicacionGenerica extends My_Db_TableAzteca implements My_Interface_Submodels{
	public $_idEjeHome;
	public $_idUbicacion;

	public function getDefault(){
		$query = "SELECT cH.idElemento AS idNotaGenerica, (CASE cH.cTipo WHEN 'Nota' THEN 3 WHEN 'Galeria' THEN 4 WHEN 'Capitulo' THEN 2 WHEN 'Video' THEN 34 WHEN 'Sugerencia' THEN 0 END) AS idTipoWidget,
    					 p.cUrl AS programa, p.cNombre AS nombrePrograma, cH.cTitulo, cH.cTeaser, cH.idImagen, cH.cPivotPoint,
    					 IF(cH.idImagen <> 0, (SELECT cUrl FROM imagenes WHERE idMultimediaImagenes = cH.idImagen LIMIT 1), cH.cUrlImg) AS cUrlImagen, cH.iPrioridad, 
    					 IF((cH.cTipo = 'Capitulo' || cH.cTipo = 'Video'), (SELECT idMultimediaKaltura FROM multimediaVideos WHERE idMultimediaVideos = cH.idElemento LIMIT 1), '') AS entryId,
    					 u.cDescripcion, cH.cDescripcion AS descContenidoHome, cH.cColor AS cColorSG, (SELECT cUrl FROM multimediaImagenes WHERE idMultimediaImagenes = cH.iSegundaImagen limit 1) AS imagenBgSG, 
    					 cH.idTipoLogo AS cTipoLogo, iBrand AS cBrandSG, cH.iTipoPrograma AS cTipoProgramaSG, cH.iVentanaNueva AS cTarget, cTextoExtra AS cTextoOpcional, cH.cUrlEspecial
  					FROM contenidoHome cH 
  					LEFT JOIN ubicacion u ON cH.idUbicacion = u.idUbicacion 
  					LEFT JOIN programas p ON cH.idPrograma = p.idPrograma 
 				   WHERE idEje =  $this->_idEjeHome AND cH.idUbicacion = $this->_idUbicacion
                   ORDER BY iPrioridad DESC;";
		$ubicacion = $this->query($query);
		$ubicacion = $this->procesarDatos($ubicacion);
		return $ubicacion;
	}

	/**
	 * Manipulacion de datos antes de enviarlo al controller
	 *
	 * Enter description here ...
	 * @param int $variableTemp
	 */
	public function procesarDatos($ubicacion){
		$ubicacionGenerica = new My_Model_UbicacionGenerica();
		$validador= New My_Validador_AztecaValidador();
		$convierteUrl = new My_Model_UtileriasCadenas();
		foreach ($ubicacion as $key => $item){
			$esNumericoWidget = $validador->intValido($item["idTipoWidget"]);
			if ($esNumericoWidget != false && $esNumericoWidget != 0){
				if ($item['idTipoWidget'] == 4){
					$ubicacion[$key]["url"] = "/galerias/";
					if ($ubicacion[$key]["cUrlImagen"] == null || $ubicacion[$key]["cUrlImagen"] == ''){
						$imagen = $ubicacionGenerica->getImagenGaleria($ubicacion[$key]["idNotaGenerica"]);
						$ubicacion[$key]["cUrlImagen"] = $imagen[0]["cUrl"];
					}
					$numTotal = $ubicacionGenerica->getImagenGaleriaTotal($ubicacion[$key]["idNotaGenerica"]);
					$ubicacion[$key]["iNumTotalImages"] = $numTotal;
					$imagesPrev = $ubicacionGenerica->getImagesPrevGaleria($ubicacion[$key]["idNotaGenerica"]);
					$ubicacion[$key]["imagePrevOne"] = $imagesPrev[0]['cUrl'];
					$ubicacion[$key]["imagePrevTwo"] = $imagesPrev[1]['cUrl'];
					$ubicacion[$key]["imagePrevThree"] = $imagesPrev[2]['cUrl'];
				}elseif ($item['idTipoWidget'] == 2 ){
					$ubicacion[$key]["url"] = "/capitulos/";
				}elseif ($item['idTipoWidget'] == 34 ){
						$ubicacion[$key]["url"] = "/videos/";
				}elseif ($item['idTipoWidget'] == 3 ){
					$ubicacion[$key]["url"] = "/notas/";
				}
				$ubicacion[$key]["url"] = $ubicacion[$key]["url"]. ($item["programa"])."/".$item["idNotaGenerica"]."/".$convierteUrl->convierteUrl(($item["cTitulo"]));
			}else{
				$ubicacion[$key]["url"] = $ubicacion[$key]["cUrlEspecial"];
			}
			$ubicacion[$key]["url"] = str_replace('http://www.azteca.com', '', $ubicacion[$key]["url"]);
		}

		return $ubicacion;
	}

	public function getImagesPrevGaleria($idGaleria) {
		$sql = "SELECT rgi.idMultimediaImagenes, i.cUrl 
  				  FROM rel_galerias_multimediaImagenes rgi 
  				  LEFT JOIN imagenes i ON rgi.idMultimediaImagenes = i.idMultimediaImagenes 
 				 WHERE idGalerias = 4374 GROUP BY rgi.idMultimediaImagenes ORDER BY iOrden ASC LIMIT 3;";
		return $this->query($sql);
	}

	public function getImagenGaleria($idGaleria){
		$query = "SELECT cUrl
		            FROM multimediaImagenes
		           WHERE idMultimediaImagenes = (SELECT idMultimediaImagenes FROM rel_galerias_multimediaImagenes where idGalerias = $idGaleria limit 1)";
		$imagen = $this->query($query);
		return $imagen;

	}

	public function getImagenGaleriaTotal($idGaleria){
		$query = "SELECT Count(*) as total
		            FROM rel_galerias_multimediaImagenes
		           WHERE idGalerias = $idGaleria";
		$imagen = $this->query($query);
		return $imagen[0]['total'];

	}

	public function getNotaRelacionadaNota($idnota){
		$query="SELECT nota.idNotaGenerica,
		               (SELECT cUrl
						  FROM programas as pro
						 WHERE pro.idPrograma = nota.idPrograma) as programa,
					   nota.cTitulo
				  FROM notaGenerica as nota
				 WHERE idNotaGenerica = (SELECT idNotaGenerica2
		                                   FROM rel_notaGenerica_notaGenerica 
		                                  WHERE idNotaGenerica1 = $idnota 
		                                  LIMIT 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idNotaGenerica"])){
			$stmt[0]["url"]= "notas/".$stmt[0]["programa"]."/".$stmt[0]["idNotaGenerica"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getVideoRelacionadaNota($idnota){
		$query="SELECT videos.idMultimediaVideos, 
		               (SELECT cUrl FROM programas as pro where pro.idPrograma = videos.idPrograma) as programa, 
		               videos.cTitulo 
		          FROM multimediaVideos as videos 
		         WHERE idMultimediaVideos = (SELECT idMultimediaVideos FROM rel_notaGenerica_multimediaVideos where idNotaGenerica = $idnota limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idMultimediaVideos"])){
			$stmt[0]["url"]= "videos/".$stmt[0]["programa"]."/".$stmt[0]["idMultimediaVideos"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getGaleriaRelacionadaNota($idnota){
		$query="SELECT galeria.idGalerias, (SELECT cUrl FROM programas as pro where pro.idPrograma = galeria.idPrograma) as programa, galeria.cTitulo FROM galeria where idGalerias = (SELECT idGalerias FROM rel_galerias_notaGenerica where idNotaGenerica = $idnota limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idGalerias"])){
			$stmt[0]["url"]= "galerias/".$stmt[0]["programa"]."/".$stmt[0]["idGalerias"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getGaleriaRelacionadaGaleria($idGaleria){
		$query="SELECT galeria.idGalerias, (SELECT cUrl FROM programas as pro where pro.idPrograma = galeria.idPrograma) as programa, galeria.cTitulo FROM galeria where idGalerias = (SELECT idGalerias2 FROM rel_galerias_galerias where idGalerias1 = $idGaleria limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idNotaGenerica"])){
			$stmt[0]["url"]= "galerias/".$stmt[0]["programa"]."/".$stmt[0]["idGalerias"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
		 
	}

	public function getVideoRelacionadaGaleria($idGaleria){
		$query="SELECT videos.idMultimediaVideos, (SELECT cUrl FROM programas as pro where pro.idPrograma = videos.idPrograma) as programa, videos.cTitulo FROM multimediaVideos as videos where idMultimediaVideos = (SELECT idMultimediaVideos FROM rel_galerias_multimediaVideos where idGalerias = $idGaleria limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idMultimediaVideos"])){
			$stmt[0]["url"]= "videos/".$stmt[0]["programa"]."/".$stmt[0]["idMultimediaVideos"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getNotaRelacionadaGaleria($idGaleria){
		$query="SELECT nota.idNotaGenerica, (SELECT cUrl FROM programas as pro where pro.idPrograma = nota.idPrograma) as programa, nota.cTitulo FROM notaGenerica as nota where idNotaGenerica = (SELECT idNotaGenerica FROM rel_galerias_notaGenerica where idGalerias  = $idGaleria limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idNotaGenerica"])){
			$stmt[0]["url"]= "notas/".$stmt[0]["programa"]."/".$stmt[0]["idNotaGenerica"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getGaleriaRelacionadaVideo($idVideo){
		$idVideo = 83501;
		$query="SELECT galeria.idGalerias, (SELECT cUrl FROM programas as pro where pro.idPrograma = galeria.idPrograma) as programa, galeria.cTitulo FROM galeria where idGalerias = (SELECT idGalerias FROM rel_galerias_multimediaVideos where idMultimediaVideos = $idVideo limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idNotaGenerica"])){
			$stmt[0]["url"]= "galerias/".$stmt[0]["programa"]."/".$stmt[0]["idGalerias"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getVideoRelacionadaVideo($idVideo){
		$query="SELECT videos.idMultimediaVideos, (SELECT cUrl FROM programas as pro where pro.idPrograma = videos.idPrograma) as programa, videos.cTitulo FROM multimediaVideos as videos where idMultimediaVideos = (SELECT idMultimediaVideos2 FROM rel_multimediaVideos_multimediaVideos where idMultimediaVideos1 = $idVideo limit 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idMultimediaVideos"])){
			$stmt[0]["url"]= "videos/".$stmt[0]["programa"]."/".$stmt[0]["idMultimediaVideos"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}

	public function getNotaRelacionadaVideo($idVideo){
		$query="SELECT nota.idNotaGenerica, (SELECT cUrl FROM programas as pro where pro.idPrograma = nota.idPrograma) as programa, nota.cTitulo FROM notaGenerica as nota where idNotaGenerica = (SELECT idNotaGenerica FROM rel_notaGenerica_multimediaVideos where idMultimediaVideos = $idVideo LIMIT 1)";
		$stmt = $this->query($query);
		$convierteUrl = new My_Model_UtileriasCadenas();
		if (isset($stmt[0]["idNotaGenerica"])){
			$stmt[0]["url"]= "notas/".$stmt[0]["programa"]."/".$stmt[0]["idNotaGenerica"]."/".$convierteUrl->convierteUrl($stmt[0]["cTitulo"]);
			return $stmt[0];
		}
	}
	
	public function getUbicacionGenerica($parametro = null) {
		
		$param = explode(",",$parametro);
		$stmt  = '';
		if(isset($param[0]) && isset($param[1])) {
			$sql = "SELECT cH.idElemento AS idNotaGenerica, (CASE cH.cTipo WHEN 'Nota' THEN 3 WHEN 'Galeria' THEN 4 WHEN 'Capitulo' THEN 2 WHEN 'Video' THEN 34 WHEN 'Sugerencia' THEN 0 END) AS idTipoWidget,
						   p.cUrl AS programa, p.cNombre AS nombrePrograma, cH.cTitulo, cH.cTeaser, cH.idImagen, cH.cPivotPoint,
						   IF(cH.idImagen <> 0, (SELECT cUrl FROM imagenes WHERE idMultimediaImagenes = cH.idImagen LIMIT 1), cH.cUrlImg) AS cUrlImagen, cH.iPrioridad,
						   IF((cH.cTipo = 'Capitulo' || cH.cTipo = 'Video'), (SELECT idMultimediaKaltura FROM multimediaVideos WHERE idMultimediaVideos = cH.idElemento LIMIT 1), '') AS entryId,
						   u.cDescripcion, cH.cDescripcion AS descContenidoHome, cH.cColor AS cColorSG, (SELECT cUrl FROM multimediaImagenes WHERE idMultimediaImagenes = cH.iSegundaImagen limit 1) AS imagenBgSG,
						   cH.idTipoLogo AS cTipoLogo, iBrand AS cBrandSG, cH.iTipoPrograma AS cTipoProgramaSG, cH.iVentanaNueva AS cTarget, cTextoExtra AS cTextoOpcional, cH.cUrlEspecial
					  FROM contenidoHome cH
				 LEFT JOIN ubicacion u ON cH.idUbicacion = u.idUbicacion
				 LEFT JOIN programas p ON cH.idPrograma = p.idPrograma
					 WHERE idEje =  " . $param[0] . "
					   AND cH.idUbicacion = " . $param[1] . "
				  ORDER BY iPrioridad DESC;";
			$stmt = $this->query($sql);
			$stmt = $this->procesarDatos($stmt);
		}
		
		return $stmt;

	}

}
