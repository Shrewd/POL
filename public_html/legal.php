<?php
include('inc-login.php');
$adsense_exclude = true;

$txt_title = 'CONDICIONES DE USO DE VIRTUALPOL | Informacion legal, contacto';
$txt_description = 'Condiciones de Uso de VirtualPol. Texto legal, contacto.'; 

$txt_header .= '<meta name="robots" content="noindex,nofollow" />
<style type="text/css">
.content { width:700px; margin: 0 auto; padding: 2px 12px 30px 12px; }


ol{margin:0;padding:0}p{margin:0}.c0{padding-left:0pt;direction:ltr;margin-left:36.0pt}.c11{list-style-type:decimal;margin:0;padding:0}.c8{padding-left:0pt;direction:ltr;margin-left:72.0pt}.c3{direction:ltr;margin:0;padding:0}.c17{width:468.0pt;background-color:#ffffff;padding:72.0pt 72.0pt 72.0pt 72.0pt}.c9{list-style-type:lower-roman;margin:0;padding:0}.c12{list-style-type:lower-latin;margin:0;padding:0}.c10{color:inherit;text-decoration:inherit}.c7{text-indent:36.0pt;margin-left:36.0pt}.c2{line-height:1.0;direction:ltr}.c13{margin:5px;border:1px solid black}.c5{font-size:14pt;font-weight:bold}.c1{color:#000099;text-decoration:underline}.c18{font-size:24pt;font-weight:bold}.c16{padding-left:0pt;margin-left:108.0pt}.c15{font-size:18pt;font-weight:bold}.c6{height:11pt;direction:ltr}.c14{direction:ltr}.c4{text-align:center}body{color:#000000;font-size:11pt;font-family:Arial}h1{padding-top:24.0pt;color:#000000;font-size:24pt;font-family:Arial;font-weight:bold;padding-bottom:6.0pt}h2{padding-top:18.0pt;color:#000000;font-size:18pt;font-family:Arial;font-weight:bold;padding-bottom:4.0pt}h3{padding-top:14.0pt;color:#000000;font-size:14pt;font-family:Arial;font-weight:bold;padding-bottom:4.0pt}h4{padding-top:12.0pt;color:#000000;font-size:12pt;font-family:Arial;font-weight:bold;padding-bottom:2.0pt}h5{padding-top:11.0pt;color:#000000;font-size:11pt;font-family:Arial;font-weight:bold;padding-bottom:2.0pt}h6{padding-top:10.0pt;color:#000000;font-size:10pt;font-family:Arial;font-weight:bold;padding-bottom:2.0pt}
</style>';


if ($pol['user_ID']) {
	$result = mysql_query("SELECT fecha_legal FROM users WHERE ID = '".$pol['user_ID']."' AND fecha_legal != '0000-00-00 00:00:00'", $link);
	while($r = mysql_fetch_array($result)) { $fecha_legal = $r['fecha_legal']; }

	if ($fecha_legal) {
		$txt_legal = 'Como usuario de VirtualPol aceptaste las siguientes condiciones. ('.$fecha_legal.')<br /><br />';
		$txt_legal_botones = '';
	} else {
		$txt_legal = 'Como usuario de VirtualPol debes aceptar las siguientes condiciones.<br /><br />';
		$txt_legal_botones = '<div style="margin:30px 0 0 0;">'.boton('HE LEIDO Y ACEPTO TODAS LAS CONDICIONES.', 'http://'.$pol['pais'].DEV.'.'.URL.'/accion.php?a=aceptar-condiciones').'</div>';
	}

}



/* NO TOCAR ABAJO */

$txt .= '<em>'.$txt_legal.'</em>

<span class="c18">CONDICIONES DE USO DE VIRTUALPOL</span></h1><p class="c6"><span></span></p><h3 class="c3"><a name="h.qowhj4l5s8w2"></a><span class="c5">MOTIVOS DE </span><span class="c5">EXPULSIÓN</span></h3><p class="c14"><span>Infringir cualquiera de las siguientes reglas tendrá como consecuencia la expulsión permanente de VirtualPol, sin la necesidad de un previo aviso y sin posibilidad de ningún tipo de juicio</span><span>.</span></p><p class="c6"><span></span></p><ol class="c11" start="1"><li class="c0"><span>Clones:</span></li></ol><ol class="c12" start="1"><li class="c8"><span>Creación de </span><span>múltiples usuarios</span><span>&nbsp;por parte de una sola persona.</span></li><li class="c8"><span>Uso de una dirección de email temporal o de uso no habitual.</span></li><li class="c8"><span>Uso de cualquier método cuyo fin sea ocultar la conexión a Internet</span><span>.</span></li><li class="c8"><span>Compartir la misma conexión a Internet con otro usuario y no notificarlo en el formulario de registro.</span></li><li class="c8"><span>Compartir la misma conexión a Internet con otro usuario expulsado por incumplimiento de estas Condiciones de Uso.</span></li></ol><p class="c6"><span></span></p><ol class="c11" start="2"><li class="c0"><span>Ataques al sistema:</span></li></ol><ol class="c12" start="1"><li class="c8"><span>Uso o descubrimiento de bugs del sistema, sea cual fuere su finalidad, sin reportarlo inmediatamente </span><span>u obrando de mala fe</span><span>.</span></li></ol><ol class="c9" start="1"><li class="c14 c16"><span>Inyección de código malicioso.</span></li><li class="c16 c14"><span>Ejecutar cualquier acción no permitida por el sistema en condiciones normales.</span></li></ol><ol class="c12" start="2"><li class="c8"><span>Ejecutar</span><span>&nbsp;cualquier tipo de acción</span><span>&nbsp;que busque causar un perjuicio al mismo.</span></li><li class="c8"><span>La utilización malintencionada del privilegio de expulsión.</span></li></ol><p class="c6 c7"><span></span></p><ol class="c11" start="3"><li class="c0"><span>Ataques a la comunidad:</span></li></ol><ol class="c12" start="1"><li class="c8"><span>Publicación de contenido altamente violento, obsceno o, en todo caso, no apto para menores de edad.</span></li><li class="c8"><span>Hacer apología del terrorismo o ideologías que defiendan el uso de la violencia.</span></li><li class="c8"><span>Amenazar a otros usuarios con repercusiones fuera de la comunidad. </span></li><li class="c8"><span>El uso reiterado o sistemático de “kicks” superiores a 15 minutos sin cobertura legal dentro de la comunidad.</span></li><li class="c8"><span>Faltar gravemente al respeto por lo personal a un Administrador.</span></li></ol><p class="c6"><span></span></p><p class="c14"><span>La aplicación de las expulsiones queda a cargo de los Supervisores del Censo, con la supervisión en última instancia del </span><span>Administrador</span><span>. Se aplicarán con la flexibilidad apropiada y la posibilidad del indulto, valorando criterios como la ausencia de mala intención o el arrepentimiento</span><span>.</span></p><p class="c6"><span></span></p><h3 class="c3"><a name="h.4c64wznv92bz"></a><span class="c5">EL CÓDIGO FUENTE</span></h3><p class="c14"><span>El código fuente y la estructura de la base de datos están publicados bajo licencia </span><span class="c1"><a class="c10" href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html">GNU GPL v2</a></span><span>&nbsp;y es publicado en </span><span class="c1"><a class="c10" href="http://code.google.com/p/virtualpol/source/browse/trunk#trunk%2Fpublic_html">esta dirección</a></span><span>.</span><span>&nbsp;</span></p><p class="c6"><span></span></p><p class="c14"><span>También se especifica las siguientes condiciones añadidas:</span></p><ol class="c11" start="1"><li class="c0"><span>Se debe reconocer los créditos de la obra mediante un enlace web regular en el pie de todas las páginas con el texto “VirtualPol” y llevando hacia la siguiente dirección “http://www.virtualpol.com/”.</span></li><li class="c0"><span>Se debe reportar cualquier fallo de seguridad encontrado en el código fuente.</span></li></ol><p class="c6"><span></span></p><h3 class="c3"><a name="h.1kseqem9ogqz"></a><span class="c5">DESARROLLO DEL CÓDIGO FUENTE</span></h3><p class="c14"><span>La modificación del código fuente y las decisiones intrínsecas del sistema son competencia exclusiva de los desarrolladores, (personas que contribuyen a modificar el código de forma libre y desinteresada) con la supervisión en última instancia del Administrador.</span></p><p class="c6"><span></span></p><h3 class="c3"><a name="h.srrws82imer2"></a><span class="c5">PROPIEDAD INTELECTUAL</span></h3><p class="c14"><span>Toda contribución hecha en el sistema que resulte difundida de forma pública pasará a ser propiedad intelectual de VirtualPol, conservando el creador original el derecho de autoría, pero prescindiendo del derecho de propiedad sobre el contenido. </span></p><p class="c6"><span></span></p><p class="c14"><span>Todo el contenido es publicado bajo licencia </span><span class="c1"><a class="c10" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES">Creative Commons BY-SA 3.0</a></span><span>. Siguiendo los siguientes principios:</span></p><p class="c6"><span></span></p><p class="c14"><span>Usted es libre de:</span></p><ol class="c11" start="1"><li class="c0"><span>Copiar, distribuir y comunicar públicamente la obra.</span></li><li class="c0"><span>Remezclar. Transformar la obra.</span></li></ol><p class="c6"><span></span></p><p class="c14"><span>Bajo las condiciones siguientes:</span></p><ol class="c11" start="1"><li class="c0"><span>Reconocimiento. Debe reconocer los créditos de la obra mediante un enlace web regular.</span></li><li class="c0"><span>Compartir bajo la misma licencia. Si altera o transforma esta obra, o genera una obra derivada, sólo puede distribuir la obra generada bajo una licencia idéntica a la indicada.</span></li></ol><p class="c6"><span></span></p><h3 class="c3"><a name="h.dncosafwg08m"></a><span class="c5">COMUNICACIÓN</span></h3><p class="c14"><span>El método de contacto principal es: desarrollo@virtualpol.com. Debe ser usado en caso de no haber otro medio más adecuado para la comunicación. En caso de no recibir respuesta desde dicha dirección de email principal, usted debe dirigirse a blogs@teoriza.com.</span></p><p class="c6"><span></span></p><h3 class="c3"><a name="h.85zu5dlguxc7"></a><span class="c5">PRIVACIDAD</span></h3><p class="c14"><span>Cualquier usuario puede ser voluntariamente eliminado. Tras el correspondiente proceso se dejará de almacenar toda su información, exceptuando la información de carácter público.</span></p><p class="c6"><span></span></p><h3 class="c3"><a name="h.1oiavdh6qp6b"></a><span class="c5">DESCARGA DE RESPONSABILIDAD</span></h3><p class="c14"><span>El administrador del proyecto no se declara responsable de las acciones u opiniones vertidas por terceras personas.</span></p><p class="c6"><span></span></p><p class="c14"><span>El Administrador principal y propietario de “virtualpol.com” es Javier González González con domicilio en Vinaroz (España).</span></p><p class="c6"><span></span></p><p class="c14"><span>Para la resolución de cualquier controversia relacionada con VirtualPol será aplicable la ley española y los Juzgados y Tribunales competentes de Vinaroz (España).</span></p><p class="c6"><span></span></p><h2 class="c3 c4"><a name="h.aho4mu6mdzba"></a><span class="c15">FIN DE LAS CONDICIONES DE USO DE VIRTUALPOL</span>


'.$txt_legal_botones;

/* NO TOCAR ARRIBA */

include('theme.php');
?>