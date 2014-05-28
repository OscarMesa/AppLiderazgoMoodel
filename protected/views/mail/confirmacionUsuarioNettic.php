<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aprovación del programa</title>

<!-- Hotmail ignora cierto código valido, se agrega esto -->
<style type="text/css">
.ReadMsgBody
{width: 100%; background-color: #FFFFFF;}
.ExternalClass
{width: 100%; background-color: #FFFFFF;}
body
{width: 100%; height: 100%; background-color: #FFFFFF; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
html
{width: 100%; height: 100%;}

@media only screen and (max-device-width: 480px) {

.mobile_text_1 { font-size: 9px; color: #fff; text-align: right; }
.mobile_text_2 { font-size: 14px; color: #404040; text-align: left; font-weight:bold; }
.mobile_text_3 { font-size: 12px; color: #404040; text-align: left; }
.mobile_text_4 { font-size: 11px; color: #404040; text-align: left; }
.mobile_text_5 { font-size: 11px; color: #fff; text-align: center; line-height: 20px; }
.mobile_text_6 { font-size: 10px; color: #404040; text-align: left; line-height: 15px; }

}


</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- Wrapper -->
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
	  <td width="100%" height="100%" valign="top">	

		<!-- Main wrapper --><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td>
				
					<!-- Iphone Wrapper -->
                    
                    <table width="660" border="0" cellpadding="0" cellspacing="0" align="center">
						<tr>
							<td width="30"></td>
						  <td width="600" bgcolor="#DDDDDD">
				<!-- Top -->
                <table width="600" border="0" cellspacing="0" cellpadding="0">
<!--  <tr>
    <td width="600" height="10" bgcolor="#FFFFFF" align="center" valign="top" style="text-align:center; font-size: 9px; color: #040401; font-family: Helvetica, Arial, sans-serif; line-height: 20px; vertical-align: top;"><section class="mobile_text_1">No puedes ver correctamente este correo? <a href="http://[web_version]" style="color:#000000;">Click</a> aquí</section></td>
  </tr>-->
  </table>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" bgcolor="#FFFFFF"><img src="http://www.nettic.com.co/boletines/tudiscotek/top.png" width="600" height="35" /></td>
  </tr>
  </table>
  <table width="580" align="center" height="40" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td width="193" height="40"><img src="http://www.aerovision.com.co/images/logo-aerovision.png" width="250" height="86" alt="logo" /></td>
  </tr>
  </table>
  <table width="580" height="40" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300"><p style="text-align:left; font-size: 20px; color: #000000; line-height:10px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><strong>Hola, <?php echo $usuario->name; ?></strong><br/>
      </p></td>
    <td align="right">
    <table width="280"  align="center" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="147" height="28" bgcolor="#242424" style="text-align:center; font-size: 18px; color: #FFFFFF; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><strong><?php echo $programa->title; ?></strong></td>
        <td width="23" height="28"><img src="http://fc08.deviantart.net/fs70/f/2011/160/0/a/gmail_metal_icon_256x256_px_by_agamemmnon-d3igont.png" width="41" height="33" /></td>
        </tr>
    </table></td>
  </tr>
</table>
  <table width="580" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <span style="text-align:center; font-size: 13px; color: #0A0A04; line-height:18px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">Un usuario realizo la revisión y <?php ($aprobacion->aprobado?'aprobo':'desaprobo');?> el programa <b><?php echo $programa->title; ?></b>. Le esetamos confirmando esta acción con el fin de que uste realice las correciones de ser necesario.</span>
    </td>
  </tr>
      <?php if($aprobacion->motivos != ''){?>
      <tr>
          <td>
              <b>Algunos comentarios y razones, se exponen a continuacion:</b><br/>
              <?php echo $aprobacion->motivos;?>
          </td>
      </tr>     
      <?php } ?>
      <tr>
          <td>
            <?php if($aprobacion->aprobado){?>
              <p><span>Dirijace al siguiente link:</span></p><br/>
              <a href="<?php echo Yii::app()->baseUrl .'/programa/ActualizaEstado/'.$programa->id.'/2';?>">Click aqui</a>
            <?php }else{?>
              
            <?php }?>  
          </td>
      </tr>
</table>
    <table width="580" height="15" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
  </tr>
</table>
    <table width="600" border="0" align="center" bgcolor="#F2F2F2" cellpadding="0" cellspacing="5" id="separador">
      <tr>
    <td height="25" valign="middle" style="font-size: 16px; color: #000000; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"><strong>¡Aerovision!</strong></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" bgcolor="#FFFFFF"><img src="http://www.nettic.com.co/boletines/tudiscotek/shadow-bottom.png" width="600" height="35" /></td>
  </tr>
  </table>



</td>
						<td width="30"></td>
					</tr>
				</table>
                    
                    
                    <!-- End Iphone Wrapper -->

		
				</td>
			</tr>
		</table><!-- End Main wrapper -->

		</td>
	</tr>
</table><!-- End Wrapper -->

<!-- Done -->

</body>
</html>