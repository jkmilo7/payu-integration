<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayU</title>
    <script type="text/javascript" src="https://maf.pagosonline.net/ws/fp/tags.js?id=d66f949f19b33e88c202b579cfc549b380200"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <noscript>
	    <iframe style="width: 100px; height: 100px; border: 0; position: absolute; top: -5000px;" src="https://maf.pagosonline.net/ws/fp/tags.js?id=d66f949f19b33e88c202b579cfc549b380200"></iframe>
    </noscript>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">    
</head>
<body>
<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <a href="#" class="navbar-brand">PayU</a>
            </div>
        </div>
    </div>
    <div role="main" class="container theme-showcase main-container">
        <div class="page-header">
            <h1>Payments</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#creditcard" role="tab" data-toggle="tab">Tarjeta de crédito o débito</a></li>
                    <li><a href="#pse" role="tab" data-toggle="tab">Débito bancario PSE</a></li>
                    <li><a href="#cash" role="tab" data-toggle="tab">Pago en efectivo</a></li>
                    <li><a href="#banks" role="tab" data-toggle="tab">Pago en bancos</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">                    
                    <div class="tab-pane active" id="creditcard">
                        <div id="alert-creditcard" class="alert alert-info " role="alert">...</div>
                        <form id="creditcard-form" class="form-horizontal" role="form">
                            <fieldset>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Nombre en la tarjeta *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="payer_name" id="card-holder-name" placeholder="Nombre del titular de la tarjeta">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="document-number">Documento de identificación *</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <select class="form-control col-sm-1" name="type_document" id="type_document" >
                                                <option value="CC">C.C.</option>
                                                <option value="CE">C.E. (Cédula de Extranjería)</option>
                                                <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                                                <option value="PP">Pasaporte</option>
                                                <option value="OTHER">Otro</option>                                            
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                            <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Numero Identificacion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Numero de tarjeta *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="credit_card_number" id="card-number" placeholder="Numero de tarjeta de credito">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cvv">Código de seguridad *</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVV">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="expiry-month">Fecha Vencimiento *</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <select class="form-control col-sm-2" name="month_exp" id="expiry-month">
                                                    <option value="01">Ene (01)</option>
                                                    <option value="02">Feb (02)</option>
                                                    <option value="03">Mar (03)</option>
                                                    <option value="04">Abr (04)</option>
                                                    <option value="05">May (05)</option>
                                                    <option value="06">Jun (06)</option>
                                                    <option value="07">Jul (07)</option>
                                                    <option value="08">Ago (08)</option>
                                                    <option value="09">Sep (09)</option>
                                                    <option value="10">Oct (10)</option>
                                                    <option value="11">Nov (11)</option>
                                                    <option value="12">Dic (12)</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-2">
                                            <select class="form-control" name="year_exp">
                                                <?php foreach ($years as $year): ?>
                                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="fees">Cuotas*</label>
                                    <div class="col-sm-1">
                                        <select class="form-control" name="fees" id="fees" >
                                            <?php foreach ($fees as $fee): ?>
                                                <option value="<?php echo $fee; ?>"><?php echo $fee; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cell-phone">Teléfono Celular *</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cell-phone" id="cell-phone" placeholder="Ej: 3112222222">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="payment_method">Tarjeta *</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="payment_method" id="payment_method" >
                                            <option value="VISA">VISA</option>
                                            <option value="MASTERCARD">MASTERCARD</option>
                                            <option value="AMEX">AMEX</option>
                                            <option value="DINERS">DINERS</option>
                                            <option value="CODENSA">CODENSA</option>                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">                                        
                                        <button onclick="Payment.creditcard()" type="button" class="btn btn-success">Pagar ahora</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form> 
                    </div>
                    <div class="tab-pane" id="pse">                        
                        <div class="alert alert-warning bg-light rounded p-3 mb-4">
                            <ol class="pl-4">
                                <li class="mb-2">Todas las compras y pagos por PSE son realizados en línea y la confirmación es inmediata.</li>
                                <li class="mb-2">Algunos bancos tienen un procedimiento de autenticación en su página (por ejemplo, una segunda clave), si nunca has realizado pagos por internet con tu cuenta de ahorros o corriente, es posible que necesites tramitar una autorización ante tu banco. Si tienes dudas, puedes consultar los requisitos de cada banco.</li>
                                <li class="mb-2">En tu extracto la compra puede aparecer con la identificación PayU PAGOS ONLINE o TECNIPAGOS.</li>
                            </ol>
                        </div>
                        <div id="alert-pse" class="alert alert-info " role="alert">...</div>
                        <form id="pse-form" class="form-horizontal" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="bank">Banco *</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="bank" id="bank">
                                        <?php foreach ($banksInfo as $bank): ?>
                                            <option value="<?php echo $bank['pseCode']; ?>"><?php echo $bank['description']; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Nombre del titular *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="payer_name" id="card-holder-name" placeholder="Nombres y Apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="type_person">Tipo de Persona *</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="type_person" id="type_person" >
                                            <option value="N">Natural</option>
                                            <option value="J">Jurídica</option>                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="document-number">Documento de identificación *</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <select class="form-control col-sm-1" name="type_document" id="type_document" >
                                                <option value="CC">C.C. (Cédula de ciudadanía.)</option>
                                                <option value="CE">C.E. (Cédula de Extranjería)</option>
                                                <option value="NIT">NIT (Número de Identificación Tributaria (Empresas))</option>
                                                <option value="TI">T.I. (Tarjeta de identidad)</option>
                                                <option value="PP">PP (Pasaporte)</option>
                                                <option value="IDC">IDC (Identificador único de cliente)</option>
                                                <option value="CEL">CEL (Número movil)</option>
                                                <option value="RC">RC (Registro civil de nacimiento)</option>
                                                <option value="DE">D.E. (Documento de identificación extranjero)</option>                                                
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                            <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Numero Identificacion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cell-phone">Teléfono *</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cell-phone" id="cell-phone" placeholder="Ej: 3112222222">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button onclick="Payment.pse()" type="button" class="btn btn-success">Pagar PSE</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form> 
                    </div>
                    <div class="tab-pane" id="cash">
                        <div class="alert alert-warning bg-light rounded p-3 mb-4">
                            <ol class="pl-4" id="cash-instructions">
                                <li class="mb-2">Haz click en el botón "Generar número de pago" para obtener el número que te pedirá el cajero de Pagatodo, Apuestas Cucuta 75, Gana, Gana Gana, Su Chance, Acertemos, La Perla, Apuestas Unidas o Jer.</li>
                                <li class="mb-2">Realiza el Pago en efectivo presentando el número que generaste, en cualquier punto Pagatodo, Apuestas Cucuta 75, Gana, Gana Gana, Su Chance, Acertemos, La Perla, Apuestas Unidas o Jer de Colombia.</li>
                                <li class="mb-2">Una vez recibido tu pago en Pagatodo, Apuestas Cucuta 75, Gana, Gana Gana, Su Chance, Acertemos, La Perla, Apuestas Unidas o Jer, PayU enviará la información del pago a CORPÓREOS COLOMBIA S.A.S, que procederá a hacer la entrega del producto/servicio que estás adquiriendo.</li>
                            </ol>
                            <ol class="pl-4" id="efecty-instructions" style="display:none;">
                                <li class="mb-2">Haz click en el botón "Generar número de pago" para obtener el número que te pedirá el cajero de Efecty.</li>
                                <li class="mb-2">Realiza el Pago en efectivo presentando el número que generaste, en cualquier punto Efecty de Colombia.</li>
                                <li class="mb-2">Una vez recibido tu pago en Efecty, PayU enviará la información del pago a CORPÓREOS COLOMBIA S.A.S, que procederá a hacer la entrega del producto/servicio que estás adquiriendo.</li>
                            </ol>
                        </div>
                        <div id="alert-cash" class="alert alert-info " role="alert">...</div>
                        <form id="cash-form" class="form-horizontal" role="form" >
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="payer_name">Nombre *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="payer_name" id="payer_name" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="document-number">Documento de identificación *</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <select class="form-control col-sm-1" name="type_document" id="type_document" >
                                                <option value="CC">C.C.</option>
                                                <option value="CE">C.E. (Cédula de Extranjería)</option>
                                                <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                                                <option value="PP">Pasaporte</option>
                                                <option value="OTHER">Otro</option>                                            
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                            <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Numero Identificacion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="payment_method_cash">Pago por: * </label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="payment_method_cash" id="payment_method_cash" >
                                            <option value="OTHERS_CASH">PAGA TODO</option>
                                            <option value="OTHERS_CASH">APUESTAS CUCUTA 75</option>
                                            <option value="OTHERS_CASH">GANA</option>
                                            <option value="OTHERS_CASH">GANA GANA</option>
                                            <option value="OTHERS_CASH">SU CHANCE</option>
                                            <option value="OTHERS_CASH">ACERTEMOS</option>
                                            <option value="OTHERS_CASH">LA PERLA</option>
                                            <option value="OTHERS_CASH">APUESTAS UNIDAS</option>
                                            <option value="OTHERS_CASH">JER</option>
                                            <option value="EFECTY">EFECTY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button onclick="Payment.cash()" type="button" class="btn btn-success">Pagar ahora</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form> 
                    </div>
                    <div class="tab-pane" id="banks">
                        <div class="alert alert-warning bg-light rounded p-3 mb-4">                            
                            <ol class="pl-4">
                                <li class="mb-2">Haz click en el botón "generar recibo de pago" e imprime el recibo que te muestra.</li>
                                <li class="mb-2">Puedes realizar el pago en efectivo presentando el recibo en cualquier sucursal de Banco de Bogotá, Bancolombia o Davivienda de Colombia.	 </li>
                                <li class="mb-2">Una vez recibido tu pago en el banco, PayU enviará la información del pago a CORPÓREOS COLOMBIA S.A.S, que procederá a hacer la entrega del producto/servicio que estás adquiriendo.</li>
                            </ol>
                        </div>
                        <div id="alert-banks" class="alert alert-info " role="alert">...</div>
                        <form id="banks-form" class="form-horizontal" role="form" >
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="payer_name">Nombre *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="payer_name" id="payer_name" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="document-number">Documento de identificación *</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <select class="form-control col-sm-1" name="type_document" id="type_document" >
                                                <option value="CC">C.C.</option>
                                                <option value="CE">C.E. (Cédula de Extranjería)</option>
                                                <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                                                <option value="PP">Pasaporte</option>
                                                <option value="OTHER">Otro</option>                                            
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                            <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Numero Identificacion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="payment_method_banks">Pago por: * </label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="payment_method_banks" id="payment_method_banks" >
                                            <option value="BANK_REFERENCED">BANCO DE BOGOTA</option>
                                            <option value="BANK_REFERENCED">BANCOLOMBIA</option>
                                            <option value="BANK_REFERENCED">DAVIVIENDA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button onclick="Payment.banks()" type="button" class="btn btn-success">Pagar ahora</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../lib/jquery/dist/jquery.min.js"></script>
    <script src="../lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
<?php
if (isset($resultPing) && $resultPing !== null) {
    echo "El resultado del ping es: <pre>" . print_r($resultPing, true) . "</pre>";
}
if (isset($resultPaymentMethods) && $resultPaymentMethods !== null) {
    echo "El resultado del PaymentMethods es: <pre>" . print_r($resultPaymentMethods, true) . "</pre>";
}
?>
</body>
</html>


