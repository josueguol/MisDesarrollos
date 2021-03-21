<?php
class My_Model_Kaltura extends My_Db_TableAzteca {
	/**
	 *	Metodo que recibe un id y regresa la info secret y partnerId de kaltura, por partnerId
	 *	Azteca Digital[EM] 2012-12-07
	 */
	public function getAccountDataByPartnerId($partnerId) {
		$sql="select iPartnerId, cSecret from catKalturaAccounts where iPartnerId = $partnerId";
		$result = $this->query($sql);
		return $result[0];
	}
	
    /**
     * Función que hará la conexión con kaltura a partir de los datos de la cuenta correspondiente
     * @param string $secret
     * @param string $partnerId
     * @return KalturaClient
     */
	public function iniciaSesion($secret,$partnerId){
		require_once '/webtva/webhost/tvazteca/htdocs/exampleKaltura2/libActualizado/KalturaClient.php';
		$userId = null;
		$type = KalturaSessionType::ADMIN;
		$expiry = null;
		$privileges = null;
			
		$config = new KalturaConfiguration($partnerId);
		$config->serviceUrl = 'http://www.kaltura.com/';
		$client = new KalturaClient($config);			
			
		$ks = $client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
		$client->setKs($ks);
		
		return $client;
	}
	
	/**
	 * Función que una vez establecida la conexión con kaltura obtendra la metadata del video para imprimir lo que necesitamos
	 * @param KalturaClient $client
	 * @param string $entryId
	 * @return boolean
	 */
	public function getMetadata($client,$entryId){
		$pager = null;
		$filter = new KalturaMetadataFilter();
		$filter->objectIdEqual = $entryId;
		$results = $client-> metadata ->listAction($filter, $pager);

		$metadata = @get_object_vars($results->objects[0]);
		
		if($metadata!=null) $results = $client-> metadata ->get($metadata['id']);
		else $results = false;
		
		return $results;
	}
	
	public function uploadKaltura($client,$nombre,$categoria='VIDEOS Mexico Baila'){
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name        = $nombre;
		$mediaEntry->description = '';
		$mediaEntry->categories  =$categoria;
		$mediaEntry->mediaType = KalturaMediaType::VIDEO;
		$urlVideo = 'http://static.azteca.com'.$nombre;
		$resultsUpload = $client->media->addFromUrl($mediaEntry,$urlVideo);
		return $resultsUpload->id;
	}
	
	public function getBaseentryInfo($client, $entryId) {
	    return $result = $client->baseEntry->get($entryId, null);
	}
}
