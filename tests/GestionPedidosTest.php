<?php
/**
 * Pruebas para la clase GestionPedidos
 * Requiere PHPUnit
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/backend/GestionPedidos.php';

class GestionPedidosTest extends TestCase
{
    public function testEstadoInvalidoLanzaExcepcion(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $pdoMock = $this->createMock(PDO::class);
        $gestion = new GestionPedidos($pdoMock);
        $gestion->actualizarEstadoPedido(1, 'estado_no_existente');
    }
}