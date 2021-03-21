<?php 
/**
 * Arreglo de Autores que alimentaran el sitio puntoTrader -no es la forma correcta de hacer esto, pero si genero un json desde tv azteca va a consumir mucho recurso al recorrer los foreach...
 * @package azteca.My.Model.JsonAutoresTrader
 * @author  Kevin_Miriam_2019
 * @version 1.0.0 - 29-11-2019
 */
class My_Model_JsonAutoresTrader{
    /* 
     * Obtiene los datos del autor
     */
    public function obtenerDatosAutor($idAutor,$nombreAutor){
    	$datosAutor		= "";
    	$arregloAutores = array(    	
    			'camila-espinosa-de-los-monteros-valdiveso' => array(
    					'cNombre' 	=> "Camila Espinosa de los Monteros Valdiveso",
    					'cAcerca'  	=> "Diseñadora apasionada del marketing cultural y educativo y futura maestra en Administración de Empresas. Soy madre de 2 hijos de 14 y 16 años, respectivamente. A lo largo de mi trayectoria he superado distintos retos laborales en el sector editorial. Desde hace algunos años, soy Directora de Mercadotecnia de una reconocida marca en este sector laboral. Amo el baseball, soy fiel fan de las Chivas y disfruto salir de viaje con mis hijos y mi esposo.",
    					'cImagen'  	=> "https://tvazteca.brightspotcdn.com/69/8f/c4398ae64e7daa7e8e35ca1ed2b0/camila-espinosa.jpg"
    			),
    			'maria-fernanda-valverde-perez' => array(
    					'cNombre' 	=> "María Fernanda Valverde Pérez",
    					'cAcerca'  	=> "Tengo 33 años y me siento muy afortunada porque desde hace 2 años mi sueño se ha convertido en realidad: tengo una ludoteca divina en la Ciudad de México. La maternidad (tengo un niño que está en los terribles 3) y la vida en familia me han empujado a creer en mí y en que todo es posible cuando de emprender se trata. En mi tiempo libre (que, por ahora, es diminuto), me gusta salir con mi esposo y mi hijo. Sigo trabajando y estudiando con esmero para aprender y crecer mi patrimonio.",
    					'cImagen'  	=> "https://tvazteca.brightspotcdn.com/f2/ae/d92bca8c48c4bfb15694e634f8b3/maria-fernanda.jpg"
    			),
    			'ricardo-lorenzo-padilla' => array(
    					'cNombre' 	=> "Ricardo Lorenzo Padilla",
    					'cAcerca'  	=> "Soy un comprometido director de auditoría en una de las empresas más importantes del país. Nací y crecí en Guadalajara. Tengo 3 hijos y una esposa que me han acompañado en todos mis logros laborales y personales. Creo que la educación financiera es la base de un país sólido. Trabajo con esmero para darles a mis hijos el mejor futuro y para enseñarles a otros lo que he aprendido a lo largo de mi carrera.",
    					'cImagen'  	=> "https://tvazteca.brightspotcdn.com/1f/80/45cdfb364735baebb6a7d3fdbfe0/ricardo-lorenzo.jpg"
    			),
    			'jose-antonio-rojas-garza' => array(
    					'cNombre' 	=> "José Antonio Rojas Garza",
    					'cAcerca'  	=> "Soy un actuario empecinado por convertirme en embajador en trading… No diría gurú porque no existen… Creo que todos los días se aprende algo nuevo, y más, en ese mundo. Estudio una Maestría en Finanzas Corporativas y Bursátiles, procuro entrenar duro todos los días para correr en maratones internacionales y disfruto dar clases de finanzas para no financieros.",
    					'cImagen'  	=> "https://tvazteca.brightspotcdn.com/9b/27/147c550e4ee8a98eb4683cc4fcb2/jose-antonio.jpg"
    			),
    			'juan-carlos-gonzalez-diaz' => array(
    					'cNombre' 	=> "Juan Carlos González Díaz",
    					'cAcerca'  	=> "Soy contador egresado de la UNAM. Me apasiona el mundo de las finanzas porque entenderlo significa que podré contribuir a construir un mejor país. Además, soy un curioso nato del mercado bursátil. Sin inversiones, el crecimiento de la economía de una nación es casi una quimera. Por eso, sueño con convertirme en asesor financiero. Estudio una maestría en Innovación para el Desarrollo Empresarial y quiero, en un futuro, tener un negocio propio. Amo viajar con mi novia y, sobre todo, aprender nuevas cosas.",
    					'cImagen'  	=> "https://tvazteca.brightspotcdn.com/2f/52/e322f1c744039fad015321995b38/juan-carlos.jpg"
    			)
    		);
    	$datosAutor = $arregloAutores[$idAutor];
    	
    	if(empty($datosAutor)){//Si no existiera el autor que le envié uno por default
    		$datosAutor = array(
    						'cNombre' 	=> $nombreAutor,
    						'cAcerca'  	=> "Autor de PuntoTrader.",
    						'cImagen'  	=> "https://tvazteca.brightspotcdn.com/d3/8a/7e7f6bdd48f9b1ed91b2cf9e15b6/defaultautor.png"
    					);
    	}
		
    	return $datosAutor;
    }
    
}