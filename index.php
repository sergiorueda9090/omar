<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/tarjetaCliente.controlador.php";
require_once "controladores/gastos.controlador.php";
require_once "controladores/billetera.controlador.php";
require_once "controladores/banco.controlador.php";
require_once "controladores/efectivo.controlador.php";
require_once "controladores/cobrosDelDia.controlador.php";
require_once "controladores/reporte.controlador.php";
require_once "controladores/inicio.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/tarjetaCliente.modelo.php";
require_once "modelos/gastos.modelo.php";
require_once "modelos/billetera.modelo.php";
require_once "modelos/banco.modelo.php";
require_once "modelos/efectivo.modelo.php";
require_once "modelos/cobrosDelDia.modelo.php";
require_once "modelos/reporte.modelo.php";
require_once "modelos/inicio.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
