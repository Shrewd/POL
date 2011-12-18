<?php 
include('inc-login.php');

/*

Cosas por hacer:
- Autentificar
- Votar en Elecciones
- Votar en Votaciones
- Repartir votos de confianza.
- Rellenar perfil.
- Votar hilos del foro.
- 

*/


$margen_30dias	= date('Y-m-d 20:00:00', time() - 2592000); // 30 dias

$txt .= '<h1>&iquest;Qu&eacute; puedes hacer en VirtualPol?</h1>

<ol>

<li>'.($_SESSION['pol']['dnie']=='true'?'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Est&aacute;s autentificado correctamente.</b>':'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">No has autentificado tu usuario.</b>').' <a href="https://virtualpol.com/dnie.php" target="_blank">Ver autentificaci&oacute;n</a>.<br />
Puedes identificarte solidamente con <abbr title="DNI electronico y otros 30 certificados">DNIe</abbr>, contribuir&aacute;s a reforzar la legitimidad de las votaciones y tu usuario nunca se eliminar&aacute;. Es opcional. <!--Autentificarse con un DNIe es gratis, solo necesitas tener un DNIe vigente, conocer su contrase&ntilde;a y disponer de un lector USB DNIe (8-12 euros).--><br /><br /></li>';



$has_votado_elecciones = false;
if ($pol['config']['elecciones_estado'] == 'elecciones') {
	$result = mysql_query("SELECT user_ID FROM ".SQL."elecciones WHERE user_ID = '".$pol['user_ID']."' LIMIT 1", $link);
	while($r = mysql_fetch_array($result)) { $has_votado_elecciones = true; }
}

$txt .= '<li>'.($pol['config']['elecciones_estado']=='normal'?'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Quedan <span class="timer" value="'.strtotime($pol['config']['elecciones_inicio']).'"></span> para las pr&oacute;ximas Elecciones.</b>':($has_votado_elecciones==true?'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Has votado correctamente en las elecciones.</b>':'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">No has votado en las elecciones Elecciones.</b>')).' <a href="/elecciones/" target="_blank">Ver Elecciones</a>.<br />
Las Elecciones son un proceso democr&aacute;tico, peri&oacute;dico y autom&aacute;tico. De su resultado dependen los cargos principales de moderaci&oacute;n y gesti&oacute;n. Todos los participantes pueden votar y cualquiera puede postularse como candidato.<br /><br /></li>';




$hay_votaciones = false;
if ($pol['config']['info_consultas'] > 0) {
	$result = mysql_query("SELECT ID, acceso_votar, acceso_cfg_votar, (SELECT user_ID FROM votacion_votos WHERE ref_ID = votacion.ID AND user_ID = '".$pol['user_ID']."' LIMIT 1) AS ha_votado FROM votacion WHERE estado = 'ok' AND pais = '".PAIS."'", $link);
	while($r = mysql_fetch_array($result)) { 
		if ((!$r['ha_votado']) AND (nucleo_acceso($r['acceso_votar'], $r['acceso_cfg_votar']))) { $hay_votaciones = true; }
	}
}

$txt .= '<li>'.($pol['config']['info_consultas']>0?($hay_votaciones?'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">Hay votaciones en las que puedes votar.</b>':'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Has votado en todas las votaciones en curso.</b>'):'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">No hay votaciones en curso.</b>').' <a href="/votacion/" target="_blank">Ver votaciones</a>.<br />
Las votaciones (informativas o vinculantes) son el mecanismo democr&aacute;tico m&aacute;s habitual. Duran un tiempo determinado, configuraci&oacute;n espec&iacute;fica y puede haber varias simult&aacute;neas.<br /><br /></li>';




$votos_confianza = 0;
$result = mysql_query("SELECT COUNT(*) AS num FROM votos WHERE tipo = 'confianza' AND emisor_ID = '".$pol['user_ID']."'", $link);
while($r = mysql_fetch_array($result)) { $votos_confianza = $r['num']; }

$txt .= '<li>'.($votos_confianza<VOTO_CONFIANZA_MAX?'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">Te quedan '.(VOTO_CONFIANZA_MAX-$votos_confianza).' votos de confianza por repartir.</b>':'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Has repartido todos tus votos de confianza.</b>').' <a href="/info/censo/confianza/" target="_blank">Votar confianza</a>.<br />
El voto de confianza es una valoraci&oacute;n (+1 -1) que los usuarios se reparten entre s&iacute;. No implica que te guste ese usuario, si no que conf&iacute;as en &eacute;l. Tienes '.VOTO_CONFIANZA_MAX.' votos de confianza para repartir.<br /><br /></li>';



$perfil = false;
$result = mysql_query("SELECT ID FROM users WHERE ID = '".$pol['user_ID']."' AND (datos = '' OR text = '') LIMIT 1", $link);
while($r = mysql_fetch_array($result)) { $perfil = true; }

$txt .= '<li>'.($perfil?'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">Tienes cosas por rellenar en tu perfil.</b>':'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Tu perfil est&aacute; bastante completo.</b>').' <a href="/perfil/'.$pol['nick'].'/" target="_blank">Ir a tu perfil</a>.<br />
Cada usuario tiene su perfil personal, en &eacute;l se muestra informaci&oacute;n de actividad, etc. Se recomienda indicar tus redes sociales y escribir una breve nota.<br /><br /></li>';




$votos_foro = 0;
$result = mysql_query("SELECT COUNT(*) AS num FROM votos WHERE tipo IN ('msg', 'hilos') AND emisor_ID = '".$pol['user_ID']."' AND time > '".$margen_30dias."'", $link);
while($r = mysql_fetch_array($result)) { $votos_foro = $r['num']; }

$txt .= '<li>'.($votos_foro>=15?'<img src="'.IMG.'ico/ok.png" width="32" height="32" /> <b style="color:blue;">Has votado '.$votos_foro.' veces en el foro el &uacute;ltimo m&eacute;s.</b>':'<img src="'.IMG.'ico/no.png" width="32" height="32" /> <b style="color:red;">Participa votando m&aacute;s en el foro.</b>').' <a href="/foro/" target="_blank">Ir al foro</a>.<br />
Puedes votar (+1 -1) cualquier hilo y mensaje del foro, as&iacute; contribuir&aacute;s al debate con tu opini&oacute;n. Se recomienda hacer al menos 15 votos al m&eacute;s (vas '.$votos_foro.').</li>';





$txt .= '</ol>

<p>Por orden de importancia.</p>';


if (!$pol['user_ID']) { $txt = '<p>Debes <a href="'.REGISTRAR.'?p='.PAIS.'">registrar un ciudadano</a> para poder ver esta p&aacute;gina.</p>'; } 
elseif ($pol['estado'] == 'extranjero') { header('Location: http://'.strtolower($pol['pais']).'.virtualpol.com/hacer/'); exit; }
elseif ($pol['estado'] != 'ciudadano') { $txt = '<p>Debes <a href="'.REGISTRAR.'">solicitar ciudadania</a> en alguna plataforma.</p>'; }


//THEME
$txt_title = '&iquest;Qu&eacute; puedes hacer?';
include('theme.php');
?>