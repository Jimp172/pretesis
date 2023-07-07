$(document).ready(function()
  {
    ddl_DCRetIBienes();
    ddl_DCRetISer();
    // ddl_DCSustento();
    ddl_DCDctoModif();
    // ddl_DCPorcenIva();
    // ddl_DCPorcenIce();
    ddl_DCTipoPago();
    ddl_DCRetFuente();
    // ddl_DCConceptoRet();
    ddl_DCPais();
    Carga_RetencionIvaBienes_Servicios();
    cargar_grilla();
    // $(function() {
    // $('#TxtNumTresComRet').bind('focusout', function(e) {
    //    console.log($('#val_num').val());
    //      if($('#val_num').val() == 0)
    //      {
    //         $('#TxtNumTresComRet').select();
    //      }else if($('#val_num').val()==1) {
    //         e.preventDefault();
    //          Swal.fire('RETENCION REPETIDA','Número de Retención ya existe, \n si continua se borrará los datos de este número de retención QUIERE REPROCESARLA','info').then(function() {
    //             $('#TxtNumTresComRet').focus(); 
    //        $('#val_num').val(0);});  
    //     }else
    //     {
    //       $('#val_num').val(0);
    //     }
    //                 // $('#TxtNumTresComRet').select();
    //   });
    // });

    $("#TxtNumTresComRet").blur(function () {
        validar_num_retencion();
       if($('#val_num').val() == 0)
         {
          $('#TxtNumTresComRet').select();
         }else if($('#val_num').val()==1) {
          Swal.fire({
            title: 'RETENCION REPETIDA',
            html: 'Número de Retención ya existe, \n '+
              'si continua se borrará los datos de este número de retención QUIERE REPROCESARLA',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Procesar'
          }).then((result) => {
              if (result.value) {
                 $('#TxtNumUnoAutComRet').focus();

              }else
              {
                 $('#TxtNumTresComRet').focus();
                  $('#val_num').val(0);  
              }
          });



             // Swal.fire('RETENCION REPETIDA','Número de Retención ya existe, \n '+
             //  'si continua se borrará los datos de este número de retención QUIERE REPROCESARLA','info')
             // .then(function() {
             //      $('#TxtNumTresComRet').focus();
             //      $('#val_num').val(0);});  




        }else
        {
          $('#val_num').val(0);
        }
    });
    

     $("#DCRetISer").blur(function () { $('#iva_si').trigger( "focus" );});
     $("#iva_si").blur(function () { $('#iva_no').trigger( "focus" );});
     $("#iva_no").blur(function () { $('#DCSustento').trigger( "select" );});
     $("#DCSustento").blur(function () { $('#DCTipoComprobante').trigger( "focus" );});
     $("#TxtIvaSerValRet").blur(function () { $('#CFormaPago').trigger( "focus");});
     $("#TxtNumDosComRet").blur(function () { $('#TxtNumTresComRet').trigger( "focus" );});
     $("#ChRetS").blur(function () { if($("#ChRetS").prop('checked')==false){ $('#iva_si').trigger( "focus" );} });

     // $("#TxtIvaBienMonIva").blur(function () { $('#DCPorcenRetenIvaBien').trigger( "focus" );});
     // $("#DCPorcenRetenIvaBien").blur(function () { $('#TxtIvaBienValRet').trigger( "focus" );});
     // $("#TxtIvaBienValRet").blur(function () { $('#TxtIvaSerMonIva').trigger( "focus" );});
     // $("#TxtIvaSerMonIva").blur(function () { $('#DCPorcenRetenIvaServ').trigger( "focus" );});
     // $("#DCPorcenRetenIvaServ").blur(function () { $('#TxtIvaSerValRet').trigger( "focus" );});

      $('#TxtIvaBienMonIva').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault(); $('#TxtIvaBienMonIva').val(parseFloat($('#TxtIvaBienMonIva').val()).toFixed(2)); $('#DCPorcenRetenIvaBien').trigger( "focus" ); }
      });
       $('#DCPorcenRetenIvaBien').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault();  $('#TxtIvaBienValRet').trigger( "focus" ); }
      });
       $('#TxtIvaBienValRet').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault();  if($('#TxtIvaSerMonIva').prop('readonly')){ $('#btn_air').trigger( "focus" ) }else{$('#TxtIvaSerMonIva').trigger( "focus" )} }
      });
      $('#TxtIvaSerMonIva').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault();  $('#TxtIvaSerMonIva').val(parseFloat($('#TxtIvaSerMonIva').val()).toFixed(2));  $('#DCPorcenRetenIvaServ').trigger( "focus" ); }
      });
      $('#DCPorcenRetenIvaServ').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault();  $('#TxtIvaSerValRet').trigger( "focus" ); }
      });



     $('#TxtIvaSerValRet').keydown( function(e) { 
          var keyCode1 = e.keyCode || e.which; 
          if (keyCode1 == 9) { e.preventDefault();  $('#btn_air').trigger( "focus" ); }
           });   


      $('#txt_total_retencion').keydown( function(e) { 
          var keyCode = e.keyCode || e.which; 
          if (keyCode == 9) {     e.preventDefault();  $('#btn_g').trigger( "focus" );  }  
        });   

      })


 function ddl_DCRetIBienes() {
 	var opcion = '';
  var ini = '';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCRetIBienes=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	$.each(response,function(i,item){
            if(i==0)
            {
              ini = item.Codigo;
            }
        		opcion+='<option value="'+item.Codigo+'">'+item.Cuentas+'</option>';
        	})
        	$('#DCRetIBienes').html(opcion);
          $('#DCRetIBienes').val(ini);
                    // console.log(ini);
      }
    }); 
}

function ddl_DCRetISer() {
 	var opcion = '<option value="">Seleccione tipo de retencion</option>';
  var ini= '';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCRetISer=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
            if(i==0)
            {
              ini = item.Codigo;
            }
        		opcion+='<option value="'+item.Codigo+'">'+item.Cuentas+'</option>';
        	})
        	$('#DCRetISer').html(opcion);
          $('#DCRetISer').val(ini);
                    // console.log(response);
      }
    }); 
}
function ddl_DCSustento(fecha) {
 	var opcion = '<option value="">Seleccione sustento</option>';
  var ini = '';
 	var parametros = 
 	{
 		'fecha':fecha,
 	}
	$.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCSustento=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
            if(i==0)
            {
              ini = item.Credito_Tributario;
            }
        		opcion+='<option value="'+item.Credito_Tributario+'">'+item.Sustento+'</option>';
        	})
        	$('#DCSustento').html(opcion);
          $('#DCSustento').val(ini);
                    // console.log(response);
      }
    }); 
}


function ddl_DCDctoModif() {
  // $('#DCSustento').css('border','1px solid #d2d6de');
 	var opcion = '<option value="">Seleccione tipo de Comprobante</option>';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCDctoModif=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
        		opcion+='<option value="'+item.Codigo+'">'+item.Descripcion+'</option>';
        	})
        	$('#DCDctoModif').html(opcion);
                    // console.log(response);
      }
    }); 
}

function ddl_DCPorcenIva(fecha) {
  console.log(fecha);
 	var opcion = '<option value="I">Iva</option>';
  var ini ='';
 	var parametros = 
 	{
 		'fecha':fecha,
 	}
	$.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCPorcenIva=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        //	console.log(response);
        	$.each(response,function(i,item){
            if(i==0)
            {
              ini = item.Porc;
            }
        		opcion+='<option value="'+item.Porc+'">'+item.Porc+'</option>';
        	})
        	$('#DCPorcenIva').html(opcion);
          $('#DCPorcenIva').val(ini);
                    // console.log(response);
      }
    }); 
}

function ddl_DCPorcenIce(fecha) {
 	var opcion = '<option value="0">ICE</option>';
  var ini ='';
 	var parametros = 
 	{
 		'fecha':fecha,
 	}
	$.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCPorcenIce=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
            if(i==0)
            {
              ini = item.Porc.toFixed(2);
            }
        		opcion+='<option value="'+item.Porc.toFixed(2)+'">'+item.Porc.toFixed(2)+'</option>';
        	})
        	$('#DCPorcenIce').html(opcion);
          $('#DCPorcenIce').val(ini);
                    // console.log(response);
      }
    }); 
}

function ddl_DCTipoPago() {
 	var opcion = '<option value="">Seleccione tipo de pago</option>';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCTipoPago=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
        		opcion+='<option value="'+item.Codigo+'">'+item.CTipoPago+'</option>';
        	})
        	$('#DCTipoPago').html(opcion);
          $('#DCTipoPago').val("01");
                    // console.log(response);
      }
    }); 
}


function ddl_DCRetFuente() {
 	var opcion = '<option value="">Seleccione tipo de Retencion</option>';
  var ini = '';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCRetFuente=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
            if(i == 0)
            {
              ini = item.Codigo;
            }
        		opcion+='<option value="'+item.Codigo+'">'+item.Cuentas+'</option>';
        	})
        	$('#DCRetFuente').html(opcion);

          $('#DCRetFuente').val(ini);
          $('#ChRetF').prop('checked',true);
          $('#DCRetFuente').show();

                    // console.log(response);
      }
    }); 
}


function ddl_DCConceptoRet(fecha) {
 	var opcion = '<option value="">Seleccione Codigo de retencion</option>';
  var ini ='';
 	var parametros = 
 	{
 		'fecha':fecha,
 	}
	$.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCConceptoRet=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	console.log(response);
        	$.each(response,function(i,item){
             if(i == 0)
            {
              ini = item.Codigo+'-'+item.Porc;
            }
        		opcion+='<option value="'+item.Codigo+'-'+item.Porc+'">'+item.Detalle_Conceptos+'</option>';
        	})
        	$('#DCConceptoRet').html(opcion);
          $('#DCConceptoRet').val(ini);
                    // console.log(response);
      }
    }); 
}


function ddl_DCPais() {
 	var opcion = '<option>Seleccione pais</option>';
	$.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCPais=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        //	console.log(response);
        	$.each(response,function(i,item){
        		opcion+='<option value="'+item.CPais+'">'+item.Descripcion_Rubro+'</option>';
        	})
        	$('#DCPais').html(opcion);
                    // console.log(response);
      }
    }); 
}


function Carga_RetencionIvaBienes_Servicios() {
  var opcion = '<option value="0">0</option>';
  var opcion2 = '<option value="0">0</option>';
  $.ajax({
      //data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?Carga_RetencionIvaBienes_Servicios=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        //  console.log(response);
          $.each(response.bienes,function(i,item){
            opcion+='<option value="'+item.Porc+'">'+item.Porc+'</option>';
          });
           $.each(response.servicios,function(i,item){
            opcion2+='<option value="'+item.Porc+'">'+item.Porc+'</option>';
          });
          $('#DCPorcenRetenIvaBien').html(opcion);
          $('#DCPorcenRetenIvaServ').html(opcion2);
                    // console.log(response);
      }
    }); 
}

function ddl_DCTipoComprobante(fecha) {
 	var opcion = '<option value="">Seleccione tipo de comprobante</option>';
  var sus = $('#DCSustento').val();
  if(sus=='00')
  {
    $('#MBFechaEmi').val('2000-01-01');
  }else
  {
    $('#MBFechaEmi').val(fecha);
  }
  $('#MBFechaRegis').val($('#MBFechaEmi').val());
 	var parametros = 
 	{
 		'DCSustento':$('#DCSustento').val(),
 		'fecha':fecha,
 		'TipoBenef':$('#LblTD').val(),
 	}
	$.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCTipoComprobante=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        	//console.log(response);
        	$.each(response,function(i,item){
        		opcion+='<option value="'+item.Tipo+'">'+item.Descripcion+'</option>';
        	})
        	$('#DCTipoComprobante').html(opcion);
                    // console.log(response);
      }
    }); 
}

function DCBenef_LostFocus(bene,cta,contr)
{
	 var parametros =
    {
        'DCBenef':bene,
        'cta' :cta,
        'contra' :contr,
    }
    $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?DCBenef_Data=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response.length !=0) 
            {
           	console.log(response)
             $("#grupo_no").val(response.grupo_no); 
             $("#Tipodoc").val(response.tipodoc);
             $("#TipoBenef").val(response.TipoBenef);
             $("#cod_benef").val(response.cod_benef); 
             $("#InvImp").val(response.InvImp);  
             $("#TipoBenef").val(response.TipoBenef); 
             $("#ci").val(response.CICLIENTE); 

             $('#TextConcepto').val(response.text);
             $('#LblNumIdent').val(response.CICLIENTE);
             $('#LblTD').val(response.TipoBenef);
             $('#DCProveedor').html('<option value="'+response.id+'">'+response.text+'</option>');

             $("#si_no").val(response.si_no); 
             // ddl_DCTipoComprobante();
            }
         
    $('#myModal_espera').modal('hide');
      }
    });  
}

function mostrar_panel()
{  
  $('#DCTipoComprobante').css('border','1px solid #d2d6de');
	if($('#DCTipoComprobante').val()== 4 || $('#DCTipoComprobante').val()== 5)
	{
    	$('#panel_notas').show();
      Documento_Modificado();
	}else{
		$('#panel_notas').hide();
	}
}

function mostrar_panel_ext()
{
  $('#CFormaPago').css('border','1px solid #d2d6de');
	if($('#CFormaPago').val()== 2)
	{
    	$('#panel_exterior').show();
	}else{
		$('#panel_exterior').hide();
	}
}

function mostra_select()
{
	if($('#ChRetF').prop('checked'))
	{ 
    $('#lbl_rbl').css('border','0px');
    	$('#DCRetFuente').show();
	}else{
		$('#DCRetFuente').hide();
	}
}


function grabacion()
{
    $('#myModal_espera').modal('show');
  var  parametros= 
  {
    "IdProv":$('#DCProveedor').val(), 
    "DevIva":$('input:radio[name=cbx_iva]:checked').val(),
    "CodSustento":$('#DCSustento').val(), 
    "TipoComprobante":$('#DCTipoComprobante').val(), 
    "Establecimiento":$('#TxtNumSerieUno').val(), 
    "PuntoEmision":$('#TxtNumSerieDos').val(), 
    "Secuencial":$('#TxtNumSerietres').val(), //CTNumero
    "Autorizacion":$('#TxtNumAutor').val(), 
    "FechaEmision":$('#MBFechaEmi').val(), 
    "FechaRegistro":$('#MBFechaRegis').val(), 
    "FechaCaducidad":$('#MBFechaCad').val(), 
    "BaseNoObjIVA":$('#TxtBaseImpoNoObjIVA').val(), //CTNumero 2 decimales
    "BaseImponible":$('#TxtBaseImpo').val(), //CTNumero 2 decimales
    "BaseImpGrav":$('#TxtBaseImpoGrav').val(), //CTNumero 2 decimales
    "PorcentajeIva": $('#DCPorcenIva').val(), 
    "MontoIva": $('#TxtMontoIva').val(), //CTNumero 2 decimales
    "BaseImpIce": $('#TxtBaseImpoIce').val(), //CTNumero 2 decimales
    "PorcentajeIce": $('#DCPorcenIce').val(),
    "MontoIce": $('#TxtMontoIce').val(), //CTNumero 2 decimales
    "Porc_Bienes": $('#DCPorcenRetenIvaBien').val(),
    "MontoIvaBienes": $('#TxtIvaBienMonIva').val(), //CTNumero 2 decimales
    "PorRetBienes":  $('#DCPorcenRetenIvaBien').val(),                  //ojo la varable puedee cambiar
    "ValorRetBienes": $('#TxtIvaBienValRet').val(), //CTNumero 2 decimales
    "Porc_Servicios":$('#DCPorcenRetenIvaServ').val(),
    "MontoIvaServicios":$('#TxtIvaSerMonIva').val(), //CTNumero 2 decimales
    "PorRetServicios": $('#DCPorcenRetenIvaServ').val(),                //ojo la varable puedee cambiar
    "ValorRetServicios": $('#TxtIvaSerValRet').val(), //CTNumero 2 decimales

    "DocModificado":$('#DCDctoModif').val(),
    "FechaEmiModificado":$('#MBFechaEmiComp').val(),
    "EstabModificado":$('#TxtNumSerieUnoComp').val(),
    "PtoEmiModificado":$('#TxtNumSerieDosComp').val(),
    "SecModificado":$('#CNumSerieTresComp').val(),
    "AutModificado":$('#TxtNumAutComp').val(),

    "ContratoPartidoPolitico":$('#TxtNumConParPol').val(),
    "MontoTituloOneroso":$('#TxtMonTitOner').val(),
    "MontoTituloGratuito":$('#TxtMonTitGrat').val(),

    "ChRetB":$('#ChRetB').prop('checked'),
    "ChRetS":$('#ChRetS').prop('checked'),
    "Bienes":$("#DCRetIBienes").val(),
    "Servicio":$("#DCRetISer").val(),
    //forma de pago
    "CFormaPago":$("#CFormaPago").val(),
    "FormaPago":$("#DCTipoPago").val(),
    "DCPais":$("#DCPais").val(),
    "OpcSiAplicaDoble":$('input:radio[name=rbl_convenio]:checked').val(),
    "OpcSiFormaLegal": $('input:radio[name=rbl_pago_retencion]:checked').val(),
    'NombreCliente':$('#DCProveedor').text(), 
    "opcion_mult":$('#txt_opc_mult').val(),

  }
   $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?grabacion=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response==1) 
            {
               $('#myModal_espera').modal('hide');
              Swal.fire( 'Retenciones ingresadas','','success');              
                parent.location.reload();
                $('#iframe').css('display','none');
            }
         
         $('#myModal_espera').modal('hide');
      }
    });  
}

function insertar_grid()
{
  var nom = $('select[name="DCConceptoRet"] option:selected').text().split('-');
  console.log(nom);
  var  parametros= 
  {
      "CodRet": nom[0].trim(),
      "Detalle": nom[1],
      "BaseImp":$('#TxtBimpConA').val(), // CTNumero 2
      "Porcentaje":$('#TxtPorRetConA').val(), // CTNumero 2
      "ValRet": $('#TxtValConA').val(), // CTNumero 2
      "EstabRetencion": $('#TxtNumUnoComRet').val(),
      "PtoEmiRetencion": $('#TxtNumDosComRet').val(),
      "SecRetencion": $('#TxtNumTresComRet').val(),
      "AutRetencion": $('#TxtNumUnoAutComRet').val(),
      "FechaEmiRet": $('#MBFechaRegis').val(),
      "Cta_Retencion": $('#DCRetFuente').val(),
      "EstabFactura": $('#TxtNumSerieUno').val(),
      "PuntoEmiFactura":  $('#TxtNumSerieDos').val(),
      "Factura_No":  $('#TxtNumSerietres').val(),
      "IdProv": $('#DCProveedor').val(), //revisar el id
      "T_No": '1',
      "Tipo_Trans":"C",
  }
   $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?Insertar_DataGrid=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response==1) 
            {
              cargar_grilla();          
            }
         
      }
    });
}
function cargar_grilla()
{
  var  parametros= 
  {
    'Trans_No':'1',
  }
   $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?Cargar_DataGrid=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response!='') 
            {
              $('#tbl_retencion').html(response.tbl);
              $('#txt_total_retencion').val(response.total);          
            }
         
      }
    });
}  

function calcular_iva()
{
  var iva = $('#DCPorcenIva').val();
  var Total_IVA = $('#TxtBaseImpoGrav').val();
  if(iva != 'I')
  {
    valor = (Total_IVA*iva)/100;
    $('#TxtMontoIva').val(valor.toFixed(2));
  }else
  {
     $('#TxtMontoIva').val(0);
  }
  calcular_ice();
}

function calcular_ice()
{
  var ice = $('#DCPorcenIce').val();
  var Total_ice = $('#TxtBaseImpoIce').val();
  if(ice != 'I')
  {
    valor = (Total_ice*ice)/100;
    $('#TxtMontoIce').val(valor.toFixed(2));
  }else
  {
     $('#TxtMontoIce').val(0);
  }
  if($('#ChRetB').prop('checked')==false && $('#ChRetS').prop('checked')==false)
  {
    $('#TxtIvaBienMonIva').val($('#TxtMontoIva').val());
  }
  if($('#ChRetB').prop('checked'))
  {
    $('#TxtIvaBienMonIva').val($('#TxtMontoIva').val());
    $('#TxtIvaSerMonIva').val(0);
  }else{
   if($('#ChRetS').prop('checked'))
  {
    $('#TxtIvaBienMonIva').val(0);
    $('#TxtIvaSerMonIva').val($('#TxtMontoIva').val());
  }
 }
 calcular_iva();
}

function habilitar_bienes()
{
  if($('#ChRetB').prop('checked'))
  {
    $('#TxtIvaBienMonIva').prop('readonly', false);
    $('#TxtIvaBienValRet').prop('readonly', false); 
    $('#DCPorcenRetenIvaBien').prop('disabled', false);
    $('#DCRetIBienes').css('display', 'initial');

  }else
  {
    $('#TxtIvaBienMonIva').prop('readonly', true);
    $('#TxtIvaBienValRet').prop('readonly', true); 
    $('#DCPorcenRetenIvaBien').prop('disabled', true);
    $('#DCRetIBienes').css('display', 'none');
    $('#TxtIvaBienMonIva').val('0.00');     
    $('#TxtIvaBienValRet').val('0.00');
    $('#DCPorcenRetenIvaBien').val(0);

  }
}

function habilitar_servicios()
{
  if($('#ChRetS').prop('checked'))
  {
    $('#TxtIvaSerMonIva').prop('readonly', false);
    $('#TxtIvaSerValRet').prop('readonly', false); 
    $('#DCPorcenRetenIvaServ').prop('disabled', false);
    $('#DCRetISer').css('display', 'initial');

  }else
  {
    $('#TxtIvaSerMonIva').prop('readonly', true);
    $('#TxtIvaSerValRet').prop('readonly', true); 
    $('#DCPorcenRetenIvaServ').prop('disabled', true);
    $('#DCRetISer').css('display', 'none');
   $('#TxtIvaSerMonIva').val('0.00');     
    $('#TxtIvaSerValRet').val('0.00');
    $('#DCPorcenRetenIvaServ').val(0);

  }
}

function calcular_retencion_porc_bienes()
{
  var Total_IVA = $('#TxtIvaBienMonIva').val();
  var porc = $('#DCPorcenRetenIvaBien').val();
  var valor  = Total_IVA*porc / 100;
  $('#TxtIvaBienValRet').val(valor.toFixed(2));
  var miva= $('#TxtMontoIva').val();
  var ivamo=$('#TxtIvaBienMonIva').val();
  $('#TxtIvaSerMonIva').val(parseFloat(miva-ivamo).toFixed(2));
}

function calcular_retencion_porc_serv()
{
  var Total_IVA = $('#TxtMontoIva').val();
  var porc = $('#DCPorcenRetenIvaServ').val();
  var valor  = Total_IVA*porc / 100;
  $('#TxtIvaSerValRet').val(valor.toFixed(2));
  var miva= $('#TxtMontoIva').val();
  var ivamo=$('#TxtIvaSerMonIva').val();
  $('#TxtIvaBienMonIva').val(parseFloat(miva-ivamo).toFixed(2));
}
function validar_num_retencion()
{
  // $('#TxtNumTresComRet').focus();
  var TxtSuma = 0;
  var le = $('#TxtNumTresComRet').val().length;
  var v = $('#TxtNumTresComRet').val();
   if($('#TxtNumTresComRet').val() <= 0 || $('#TxtNumTresComRet').val()=="")
    {
      $('#TxtNumTresComRet').val("000000001");
    }else
    {

    while(v.length < 9)
    {
      v = '0'+v;
    }
    $('#TxtNumTresComRet').val(v);
  }

   // var TxtNumTresComRet = Format(Round(Val(TxtNumTresComRet)), "000000000")
  // 'Calcula la sumatoria de Monto Iva Bienes, Monto Iva Servicios y Base Imponible
  TxtSuma = parseFloat($('#TxtBaseImpoNoObjIVA').val())+parseFloat($('#TxtBaseImpo').val())+parseFloat($('#TxtBaseImpoGrav').val());
  $('#TxtSumatoria').val(TxtSuma.toFixed(2));
  $('#TxtBimpConA').val(TxtSuma.toFixed(2));  
  // 'TxtSumatoria = TxtBaseImpoGrav 
  var parametros = 
  {
    'uno':$('#TxtNumUnoComRet').val(),
    'dos':$('#TxtNumDosComRet').val(),
    'ret':$('#TxtNumTresComRet').val(),
  }
  var respuesta;

   $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?validar_numero=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
        $('#val_num').val(response);
        // console.log(response);
      }
    });
}

function validar_num_factura(id)
{
  var TxtSuma = 0;
  var le = $('#'+id).val().length;
  var v = $('#'+id).val();
   if($('#'+id).val() <= 0 || $('#'+id).val()=="")
    {
      $('#'+id).val("000000001");
    }else
    {

    while(v.length < 9)
    {
      v = '0'+v;
    }
    $('#'+id).val(v);
  }
}

function calcular_porc_ret()
{
  $('#DCConceptoRet').css('border','1px solid #d2d6de');
  var valor =$('#DCConceptoRet').val();
  valor = valor.split('-');
  valor = valor[1];
  var t = $('#TxtBimpConA').val();
  $('#TxtPorRetConA').val(valor);
  var tt = (t*valor)/100;
  $('#TxtValConA').val(tt.toFixed(2));

}

function autorizacion_factura()
{
  if($('#TxtNumAutor').val()<=0 || $('#TxtNumAutor').val()=="")
  {
     $('#TxtNumAutor').val("0000000001");
  }
  factura_repetida();
}

function autocompletar_serie_num(id)
{
  var v = $('#'+id).val();
  if($('#'+id).val()<=0 || $('#'+id).val()=="")
  {
     $('#'+id).val("001");
  }else
  {
     while(v.length < 3 )
    {
      v = '0'+v;
    }
    $('#'+id).val(v);
  }
  var serie = $('#TxtNumUnoComRet').val()+''+$('#TxtNumDosComRet').val();
  serie_ultima(serie)
}

function serie_ultima(serie)
{
   var parametros =
    {
        'serie':serie,
        'fechaReg':$('#MBFechaRegis').val(),
    }
    $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?serie_ultima=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            $('#TxtNumTresComRet').val(response.numero);
            if(response.autorizacion!='')
            {
              $('#TxtNumUnoAutComRet').val(response.autorizacion);
            }         
      }
    });  

}

function solo_3_numeros(id)
{  
  var v = $('#'+id).val();
  if(v.length >3)
  {
   val  = v.substr(0,3);
    $('#'+id).val(val);
  }else{
    $('#'+id).val(v);
  }
}

function solo_9_numeros(id)
{  
  var v = $('#'+id).val();
  if(v.length >9)
  {
   val  = v.substr(0,9);
    $('#'+id).val(val);
  }else{
    $('#'+id).val(v);
  }
}

function solo_10_numeros(id)
{  
  var v = $('#'+id).val();
  if(v.length >10)
  {
   val  = v.substr(0,10);
    $('#'+id).val(val);
  }else{
    $('#'+id).val(v);
  }
}

function validar_formulario()
{

  if($('#DCProveedor').val()=='')
  {
    return false;
  }
  if($('#DCSustento').val()=='' || $('#DCTipoComprobante').val()=='')
  { 
    alert('No se a llenado todo los datos');
    $('a[href="#home"]').click();
    $('#DCSustento').css('border','1px solid #c71414');
     if($('#DCSustento').val()=='')
     {
        $('#DCSustento').css('border','1px solid #c71414');
     }else
     {
        $('#DCSustento').css('border','1px solid #d2d6de');
     }
    if($('#DCTipoComprobante').val()=='')
     {
        $('#DCTipoComprobante').css('border','1px solid #c71414');
     }else
     {
         $('#DCTipoComprobante').css('border','1px solid #d2d6de');
     }
  }else
  {
      $('a[href="#menu1"]').click();
    if($('#DCTipoPago').val()=='' || $('#DCRetFuente').val()=='' || $('#DCConceptoRet').val()==''  ||  $('#CFormaPago').val()=='')
    { 
        alert('No se a llenado todo los datos en conceptos AIR');
    
        if($('#DCConceptoRet').val()=='')
          {
            $('#DCConceptoRet').css('border','1px solid #c71414');
          }else
          {
            $('#DCConceptoRet').css('border','1px solid #d2d6de');
          }
        if($('#CFormaPago').val()=='')
          {
            $('#CFormaPago').css('border','1px solid #c71414');
          }else
          {
            $('#CFormaPago').css('border','1px solid #d2d6de');
          }
         if($('#DCTipoPago').val()=='')
          {
            $('#DCTipoPago').css('border','1px solid #c71414');
          }else
          {
            $('#DCTipoPago').css('border','1px solid #d2d6de');
          }
          if($('#ChRetF').prop('checked'))
          {
             $('#lbl_rbl').css('border','0px');
            if($('#DCRetFuente').val()=='')
              {            
                $('#DCRetFuente').css('border','1px solid #c71414');
              }else
              {
                $('#DCRetFuente').css('border','1px solid #d2d6de');
              }
          }else
          {
             $('#lbl_rbl').css('border','1px solid #c71414');
             if($('#DCRetFuente').val()=='')
              {            
                $('#DCRetFuente').css('border','1px solid #c71414');
              }else
              {
                $('#DCRetFuente').css('border','1px solid #d2d6de');
              }

          }
    }else
    {
       // alert('Todos los datos estan correctos');
       grabacion();
    
    }
  }
}

function cambiar_air()
{
  $('a[href="#menu1"]').click();
}

function Ult_fact_Prove(prv)
{
  cargar_grilla();
  // var prv = $('#DCProveedor').val();
  var  parametros= 
  {
    'proveedor':prv,
  }
   $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/inventario/registro_esC.php?Ult_fact_Prove=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            $('#TxtNumSerietres').val(response.secu);
            $('#MBFechaCad').val(response.fech_cad);
            $('#TxtNumSerieUno').val(response.esta);
            $('#TxtNumSerieDos').val(response.punto);
            $('#TxtNumAutor').val(response.auto);

            $('#TxtNumUnoComRet').val("001");
            $('#TxtNumDosComRet').val("001");
            $('#TxtNumTresComRet').val(1);
            $('#TxtNumUnoAutComRet').val("1234567890");         
      }
    });
}

function cancelar()
{
  var Trans_No = 1;
 
   $.ajax({
      data:  {Trans_No,Trans_No},
      url:   '../controlador/inventario/registro_esC.php?cancelar=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response==1)
             {

             }
         
      }
    });
}

function Documento_Modificado()
{
  var prv = $('#DCProveedor').val();
  var  parametros= 
  {
    'proveedor':prv,
  }
   $.ajax({
      data:  {parametros,parametros},
      url:   '../controlador/inventario/registro_esC.php?Documento_Modificado=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
            if (response!='')
             {
               $('#CNumSerieTresComp').val(response);
             }
         
      }
    });
}

function validar_autorizacion()
{
   if($('#TxtNumUnoAutComRet').val()==0){$('#TxtNumUnoAutComRet').val('0000000000');}
   var parametros = 
   {
     'auto':$('#TxtNumUnoAutComRet').val(),
     'serie':$('#TxtNumUnoComRet').val()+''+$('#TxtNumDosComRet').val(),
     'numero':$('#TxtNumTresComRet').val(),
   }
   $.ajax({
      data:  {parametros,parametros},
      url:   '../controlador/inventario/registro_esC.php?validar_autorizacion=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
          console.log(response);
          if(response!=1)
          {
             Swal.fire(response.titulo,response.mensaje,'info') ;        
          }
      }
    });

}

 function generar_asiento()
{
      alert('sigue');
      return false;

      var tc = 'T';
      var OpcDH = '2';
      var OpcTM = '1';
      var cta = $('#DCRetFuente').val();
      var ben = $('#DCRetFuente').text();
      var val = $('#TxtValConA').val();
      var fec = $('#txt_fecha_ven').val();
       var parametros = 
      {
        'cta':cta,
        'tc':tc,
        'tm':OpcTM,
        'dh':OpcDH,
        'fec':fec,
        'val':val,
      }      
      $.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/inventario/registro_esC.php?ingresar_asiento=true',
          type:  'post',
          dataType: 'json',
            success:  function (response) { 
              if(response==1)
              {
                Swal.fire('Registrado','','success');
                parent.location.reload();
                $('#iframe').css('display','none');
              }
          }
        });

}

function factura_repetida()
{
   if($('#TxtNumAutor').val()<=0){$('#TxtNumAutor').val('0000000001');}
   var parametros = 
   {
     'auto':$('#TxtNumAutor').val(),
     'serie':$('#TxtNumSerieUno').val()+''+$('#TxtNumSerieDos').val(),
     'numero':$('#TxtNumSerietres').val(),
     'IdProv':$('#DCProveedor').val(),
   }
   $.ajax({
      data:  {parametros,parametros},
      url:   '../controlador/inventario/registro_esC.php?validar_factura=true',
      type:  'post',
      dataType: 'json',
        success:  function (response) {
          console.log(response);
          if(response!=1)
          {
             Swal.fire('USTED ESTA TRATANDO DE INGRESAR UNA FACTURA EXISTENTE','','info').then(function(){ $('#TxtNumSerietres').select()}) ;        
          }
      }
    });

}
