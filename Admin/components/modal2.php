<?php
$training_name = '';

if (isset($_GET["atribuir"])) {
    $data = $pdo->query("SELECT * FROM tarefa WHERE id =" . $_GET["atribuir"]);
    if ($data) {
        $data = $data->fetch(PDO::FETCH_ASSOC);
        $descricao = $data['descricao'];
    }
}
?>
<div class="abs" style="display: flex;">
    <div class="Ed">
        <form method="GET" class="log">
        <div class="item" style="display: none;">
                <input type="text" name="id" value="<?php echo $_GET["atribuir"] ?>">
            </div>
            <div class="header">
                <h2>atribuit </h2>
                <small class="x close"><a href="./">x</a></small>
            </div>
            <div class="body">
                <div class="item">
                    <label class="lb">Descriçãos:</label>
                    <input value="<?php echo $descricao ?>" disabled>
                </div>
                <div class="item">
                    <label class="lb">Funcionarios:</label>
                    <select name="Funcio">
                    <?=$treina?>        
                </select>
                </div>
                <div class="btn">
                    <button type="submit" name="Att">Atribuir</button>
                </div>
            </div>
        </form>
    </div>
</div>
