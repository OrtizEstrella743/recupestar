<?php
function showTable($conn, $category) {
    $query = "SELECT * FROM $category";
    $result = $conn->query($query);

    if ($result->num_rows > 0): ?>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Fecha de Adquisición</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_adquisicion']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio']); ?></td>
                            <td>
                                <!-- Formulario para eliminar -->
                                <form method="POST" style="display:inline;">
                                    <button type="submit" name="delete" value="Delete">Eliminar</button>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                </form>
                                <!-- Formulario para modificar -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="edit" value="Edit">Modificar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>

        <h3>Agregar Nuevo Producto</h3>
        <form method="POST">
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <label for="fecha_adquisicion">Fecha de Adquisición:</label>
            <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" required>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
            <button type="submit" name="add" value="Add">Agregar</button>
        </form>
    <?php else: ?>
        <p>No hay productos en esta categoría.</p>
    <?php endif;
}

function addProduct($conn, $category, $nombre, $cantidad, $fecha_adquisicion, $precio) {
    $stmt = $conn->prepare("INSERT INTO $category (nombre, cantidad, fecha_adquisicion, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sids", $nombre, $cantidad, $fecha_adquisicion, $precio);
    $stmt->execute();
    $stmt->close();
}

function deleteProduct($conn, $category, $id) {
    $stmt = $conn->prepare("DELETE FROM $category WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function updateProduct($conn, $category, $id, $nombre, $cantidad, $fecha_adquisicion, $precio) {
    $stmt = $conn->prepare("UPDATE $category SET nombre = ?, cantidad = ?, fecha_adquisicion = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("sidsi", $nombre, $cantidad, $fecha_adquisicion, $precio, $id);
    $stmt->execute();
    $stmt->close();
}
?>
