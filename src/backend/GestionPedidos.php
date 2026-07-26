<?php
/**
 * Modulo de gestion de pedidos - Tienda E-commerce
 * Rama: feature/gestion-pedidos
 */

class GestionPedidos
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Registra un nuevo pedido y su detalle dentro de una transaccion.
     */
    /**
     * @param int $idCliente Debe provenir de la sesion autenticada del usuario,
     * validada previamente en el controlador que invoca este metodo. Nunca debe
     * recibirse directo desde $_POST o $_GET sin verificar contra la sesion.
     */
    public function crearPedido(int $idCliente, array $productos, float $total): int
    {
        if (empty($productos)) {
            throw new InvalidArgumentException('El arreglo de productos no puede estar vacio');
        }

        $this->conexion->beginTransaction();

        try {
            $sql = "INSERT INTO pedidos (id_cliente, total, estado, fecha_creacion)
                    VALUES (:id_cliente, :total, 'pendiente', NOW())";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':total', $total);
            $stmt->execute();

            $idPedido = (int) $this->conexion->lastInsertId();
            $this->registrarDetallePedido($idPedido, $productos);

            $this->conexion->commit();
            return $idPedido;
        } catch (Exception $e) {
            $this->conexion->rollBack();
            throw $e;
        }
    }

    /**
     * Registra los productos asociados a un pedido.
     */
    private function registrarDetallePedido(int $idPedido, array $productos): void
    {
        $sql = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario)
                VALUES (:id_pedido, :id_producto, :cantidad, :precio_unitario)";
        $stmt = $this->conexion->prepare($sql);

        foreach ($productos as $producto) {
            $stmt->execute([
                ':id_pedido' => $idPedido,
                ':id_producto' => $producto['id'],
                ':cantidad' => $producto['cantidad'],
                ':precio_unitario' => $producto['precio'],
            ]);
        }
    }

    /**
     * Consulta el estado actual de un pedido.
     */
    public function obtenerEstadoPedido(int $idPedido): ?string
    {
        $sql = "SELECT estado FROM pedidos WHERE id_pedido = :id_pedido";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['estado'] ?? null;
    }

    /**
     * Actualiza el estado de un pedido validando contra una lista cerrada de estados.
     */
    public function actualizarEstadoPedido(int $idPedido, string $nuevoEstado): bool
    {
        $estadosValidos = ['pendiente', 'pagado', 'enviado', 'entregado', 'cancelado'];
        if (!in_array($nuevoEstado, $estadosValidos, true)) {
            throw new InvalidArgumentException('Estado de pedido no valido');
        }

        $sql = "UPDATE pedidos SET estado = :estado WHERE id_pedido = :id_pedido";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':estado', $nuevoEstado);
        $stmt->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);

        return $stmt->execute();
    }
}