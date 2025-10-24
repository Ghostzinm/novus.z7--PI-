<?php
class Favoritos {
    public static function isFavorito($conn, $produtoId, $usuarioId) {
        $stmt = $conn->prepare("SELECT id FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?");
        $stmt->execute([$usuarioId, $produtoId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
}
