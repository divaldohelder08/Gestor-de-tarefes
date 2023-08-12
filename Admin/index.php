<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=SoftCode', 'root', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 if (isset($_GET['Fdelete'])) {
        $id = (int) $_GET['Fdelete'];
        $pdo->exec("delete from user where id=$id");
        header("location:./index.php");
    }

    if (isset($_GET['Tdelete'])) {
        $id = (int) $_GET['Tdelete'];
        $pdo->exec("delete from tarefa where id=$id");
        header("location:./index.php");
    }
    if (isset($_POST['FAdd'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $sql = $pdo->prepare("insert into user values (default,?,?)");
        $sql->execute(array($nome, $email));
        header("location:./");

    }

    if (isset($_POST['Tadd'])) {
        $desc = $_POST['desc'];
        $nivel = $_POST['nivel'];
        $sql = $pdo->prepare('insert into tarefa (id,descricao,nivel,data,estado) values (null,?,?,default,"não atribuída")');
        $sql->execute(array($desc, $nivel));
        header("location:./");

    }
    if (isset($_GET['Eadd'])) {
        $sql  = $pdo->prepare(" update tarefa set descricao=?,nivel=?,data=default where id=?;");
         $sql->execute(array($_GET['Edesc'],$_GET['Enivel'],  $_GET['id'])); 
        header("location:./");

    }

    if (isset($_GET['Att'])) {
        $sql  = $pdo->prepare(" update tarefa set user_id=? where id=?;");
         $sql->execute(array($_GET['Funcio'],$_GET['id'])); 
        header("location:./");
     }

         


    $F = $pdo->prepare('select * from user;');
    $F->execute();
    $F = $F->fetchAll();
    $Fun = "";
    $treina = "";
    foreach ($F as $key => $value) {
        $Fun .= '<div class="Titem"><b>' . $value['nome'] . '</b><a class="close" href="?Fdelete=' . $value['id'] . '"  style="background:#4caf;">X</a></div>';
        $treina .= '<option value="' . $value['id'] . '">' . $value['nome'] . '</option>';
    }
    

    $tb = $pdo->prepare('select id,descricao,nivel,data,estado,user_id from tarefa;');
    $tb->execute();
    $tbvalue = $tb->fetchAll();
    $tabela = "";
    foreach ($tbvalue as $key => $value) {
        $va = $value['user_id'];
        if (is_null($value['user_id'])) {
            $tabela .= "<tr>
                      <td>" . $value['id'] . "</td>
                      <td>" . $value['descricao'] . "</td>
                      <td>" . $value['nivel'] . "</td>
                      <td>" . $value['data'] . "</td>
                      <td>" . $value['estado'] . "</td>
                      <td>
                          <a href='?Tdelete=" . $value['id'] . "'>
                              <button class='red'>Eliminar</button>
                          </a>
                          <a href='?edite=" . $value['id'] ." '>
                              <button class='blue'>Editar</button>
                          </a>
                          <a href='?atribuir=" . $value['id'] ." '>
                              <button class='blue att' id='" . $value['id'] . "'>Atribuir</button>
                          </a>
                      </td>
                  <tr>";
        } else {
            $tabela .= "<tr>
                      <td>" . $value['id'] . "</td>
                      <td>" . $value['descricao'] . "</td>
                      <td>" . $value['nivel'] . "</td>
                      <td>" . $value['data'] . "</td>
                      <td>" . $value['estado'] . "</td>
                      <td>
                          <a href='?Tdelete=" . $value['id'] . "'>
                              <button class='red'>Eliminar</button>
                          </a>
                          <a href='?edite=" . $value['id'] ." '>
                              <button class='blue'>Editar</button>
                          </a>
                      </td>
                  <tr>";
        }
    }
    ?>

    <div class="things">
        <div class="li">
            <div class="lista">
                <header class="BB">
                    <div class="user">Funcionarios</div>
                </header>
                <div class="ting">
                    <?= $Fun ?>
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
                        <th>Estado</th>
                        <th>OPÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tabela ?>
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

    <?php
    if (isset($_GET["edite"])) {
        require_once './components/moda1.php';

    }
    if (isset($_GET["atribuir"])) {
        require_once './components/modal2.php';

    }
     ?>
    <div class="add">
        <div class="op">
            <span class="spa" id="T" style=" left: -40px;">
                F
            </span>
        </div>
        <div class="text" style="z-index: 10;">+</div>
        <span class="wa">
    </div>
    <script>
        const add = document.querySelector(".add")
        const abs = document.querySelector(".abs")
        const funcionario = document.querySelector(".funcionario")
        const VV = document.querySelector(".VV")
        const Ed = document.querySelector(".Ed")

        const btE = document.querySelectorAll(".btE")
        for (let b of btE) {
            b.addEventListener("click", () => {
                abs.style.display = "flex"
            })
        }


        document.getElementById("T").addEventListener("click", () => {
            abs.style.display = "flex"
            funcionario.style.display = "flex"
        })
        document.querySelector(".text").addEventListener("click", () => {
            abs.style.display = "flex"
            VV.style.display = "flex"
        })


        document.querySelector('.x1').addEventListener("click", () => {
            abs.style.display = "none"
            VV.style.display = "none"
        })

        document.querySelector('.x').addEventListener("click", () => {
            abs.style.display = "none"
            funcionario.style.display = "none"
        })
        add.addEventListener("mouseenter", () => {
            add.style.opacity = 1;
        })
    </script>
</body>

</html>