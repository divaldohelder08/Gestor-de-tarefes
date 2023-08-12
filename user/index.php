<?php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $pdo->prepare('select * from user where id=' . $_SESSION['login'] . '');
$sql->execute();
$values = $sql->fetchAll();
foreach ($values as $key => $value) {
    $nome = $value['nome'];
    $email = $value['email'];
}
if (isset($_GET['Finalizar'])) {
    $id = (int) $_GET['Finalizar'];
    $pdo->exec("update tarefa set estado='finalizada' where id=$id");
}
if (isset($_GET['NFinalizar'])) {
    $id = (int) $_GET['NFinalizar'];
    $pdo->exec("update tarefa set estado='não finalizada' where id=$id");
}
$qlUser = $pdo->prepare('select * from tarefa where user_id=' . $_SESSION['login'] . '');
$qlUser->execute();
$TarefaUser = $qlUser->fetchAll();
foreach ($TarefaUser as $key => $value) {
    if ($value['estado'] == "não atribuída") {
        $tarefa .= '<tr><td>' . $value['id'] . '</td><td>' . $value['descricao'] . '</td><td>' . $value['nivel'] . '</td><td>' . $value['data'] . '</td>    <td>
      <a href="?Finalizar=' . $value['id'] . '">
          <button class="green" >
              F
          </button>
      </a>
      <a href="?NFinalizar=' . $value['id'] . '">
      <button class="red">
             NF
          </button>
          </a>
      </td><tr>
          ';
    } elseif ($value['estado'] == "finalizada") {
        $tarefa .= '<tr><td>' . $value['id'] . '</td><td>' . $value['nome'] . '</td><td>' . $value['nivel'] . '</td><td>' . $value['data'] . '</td>    <td>
        <a class="close" style="background:#4caf;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
      </svg></a>
     </td><tr>
         ';
    } elseif ($value['estado'] == "não finalizada") {
        $tarefa .= '<tr><td>' . $value['id'] . '</td><td>' . $value['nome'] . '</td><td>' . $value['nivel'] . '</td><td>' . $value['data'] . '</td>    <td>
        <a class="close red"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
      </svg></a>
        
        </td><tr>
         ';
    } else {

    }
}

?>

<div class="things">
    <div class="li">
        <div class="lista" style="    height: inherit;
">
            <header class="BB">
                <div class="user">Funcionario:
                    <?= $nome ?>
                </div>
            </header>
            <div class="ting">
                <div class="Titem" style="justify-content: space-between;"><b>
                        <?= $email ?>
                    </b><a class="close" href="?logout">C</a></div>
            </div>
        </div>

    </div>
    <div class="some">
        <header>
            <div class="user">Tarefas</div>
        </header>
        <table>
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Nível</th>
                    <th>Data</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?= $tarefa ?>
            </tbody>
        </table>
    </div>
</div>
<div class="abs" style="display: none;">
    <div class="funcionario" style="display: none;z-index: 1;">
        <form method="post" class="log">
            <div class="header">
                <h2>Funcionario </h2>
                <small class="x close">x</small>
            </div>
            <div class="body">
                <div class="item">
                    <label class="lb">Nome:</label>
                    <input type="text" name="nome" class="ipt" id="nome" placeholder="Insira o nome do funcionario"
                        required>
                </div>
                <div class="item">
                    <label class="lb">Email:</label>
                    <input type="email" id="so" name="email" class="ipt" placeholder="Insira o email do funcionario"
                        required>

                </div>
                <div class="btn">
                    <button type="submit" name="FAdd">Adicionar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="VV" style="display: none;z-index: 1;">
        <form method="post" class="log">
            <div class="header">
                <h2>Tarefa </h2>
                <small class="x1 close">x</small>
            </div>
            <div class="body">
                <div class="item">
                    <label class="lb">Descrição:</label>
                    <textarea name="desc" id="" cols="35" rows="5"></textarea>
                </div>
                <div class="item">
                    <label class="lb">Nível:</label>
                    <select name="nivel">
                        <option value="Baixo">baixo</option>
                        <option value="Médio">médio</option>
                        <option value="Alto">alto</option>
                    </select>
                </div>
                <div class="btn">
                    <button type="submit" name="Tadd">Adicionar</button>
                </div>
            </div>
        </form>
    </div>


</div>