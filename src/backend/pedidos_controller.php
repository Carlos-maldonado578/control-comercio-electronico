<?php
/**
 * Controlador de pedidos - Tienda E-commerce
 * Ejemplo de uso correcto de GestionPedidos: el id_cliente se obtiene
 * siempre desde la sesion autenticada, nunca desde datos enviados por el cliente.
 */

session_start();

require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/GestionPedidos.php';

if (!isset($_SESSION['id_cliente'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$idCliente = (int) $_SESSION['id_cliente'];
$productos = $_POST['productos'] ?? [];
$total = (float) ($_POST['total'] ?? 0);

$gestion = new GestionPedidos($conexion);

try {
    $idPedido = $gestion->crearPedido($idCliente, $productos, $total);
    echo json_encode(['id_pedido' => $idPedido]);
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}