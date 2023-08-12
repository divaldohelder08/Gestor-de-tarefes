<?php
$training_name = '';

if (isset($_GET["edite"])) {
    $data = $pdo->query("SELECT * FROM tarefa WHERE id =" . $_GET["edite"]);
    if ($data) {
        $data        = $data->fetch(PDO::FETCH_ASSOC);
        $descricao = $data['descricao'];
    }
}
?>
<div class="abs" style="display: flex;">
    <div class="Ed">
        <form method="GET" class="log">
            <div class="item" style="display: none;">
                <input type="text" name="id" value="<?php echo $_GET["edite"] ?>">
            </div>
            <div class="header">
                <h2>Editar Tarefa </h2>
                <small class="x close"><a href="./">x</a></small>
            </div>
            <div class="body">
                    <div class="item">
                        <label class="lb">Descrição:</label>
                        <textarea name="Edesc" id="" cols="35" rows="5"><?php echo $descricao ?></textarea>
                    </div>
                    <div class="item">
                        <label class="lb">Nível:</label>
                        <select name="Enivel">
                            <option value="Baixo">baixo</option>
                            <option value="Médio">médio</option>
                            <option value="Alto">alto</option>
                        </select>
                    </div>
                    <div class="btn">
                        <button type="submit" name="Eadd">Adicionar</button>
                    </div>
                </div>
        </form>
    </div>
</div>