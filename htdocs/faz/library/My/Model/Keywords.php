<?php
/**
 * Archivo de definición de model de keywords
 * @package My.Model.Keywords
 * @author  Azteca Digital [EPG] 2012-09-25
 * @version 1.0.0
 */

class My_Model_Keywords extends My_Db_TableAzteca{
	public $_idEjeHome;
	public $_modulo;
	/**
	 * 
	 * Metodo que obtiene los keywords de la cookie
	 */
	public function getKeywordsCookie(){
		//
	}
	
	public function setKeywordsTemplate(){
		switch ($this->_modulo){
			case "notas" :
					$sql = "select idCatKeywords as keywords
							    from rel_keywords_notaGenerica rkng
							where rkng.idNotaGenerica = ".$this->_idEjeHome;
					$result = $this->query($sql);
					if(count($result)>0){
						foreach($result as $k => $v){
							$keywords[] = $v['keywords'];
						}
						
						$keywords = implode("','", $keywords);
						$keywords = "['".$keywords."']";
					}					
					else
						$keywords = 'null';
				break;
			case "capitulos" :
		            $sql = "select idCatKeywords as keywords from rel_keywords_videonota rkvn where rkvn.idMultimediaVideos = {$this->_idEjeHome}";
					$result = $this->query($sql);
					if(count($result)>0){
						foreach($result as $k => $v){
							$keywords[] = $v['keywords'];
						}
						
						$keywords = implode("','", $keywords);
						$keywords = "['".$keywords."']";
					}					
					else
						$keywords = 'null';
		        break;
		    case "videos" :
		            $sql = "select idCatKeywords as keywords from rel_keywords_videonota rkvn where rkvn.idMultimediaVideos = {$this->_idEjeHome}";
					$result = $this->query($sql);
					if(count($result)>0){
						foreach($result as $k => $v){
							$keywords[] = $v['keywords'];
						}
						
						$keywords = implode("','", $keywords);
						$keywords = "['".$keywords."']";
					}					
					else
						$keywords = 'null';
		        break;
		}
		
		return $keywords;
	}
}