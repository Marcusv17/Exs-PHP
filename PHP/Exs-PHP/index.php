<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json; charset=utf-8');
    $ex = $_POST['ex'] ?? '';
    $r = '';

    switch ($ex) {
        case '1':
            $n = intval($_POST['n'] ?? 0);
            $r = "<table class='tab'>";
            for ($i = 1; $i <= 10; $i++) $r .= "<tr><td>$n x $i</td><td>=</td><td>" . ($n * $i) . "</td></tr>";
            $r .= "</table>";
            break;

        case '2':
            $p = floatval($_POST['p'] ?? 0);
            $d = floatval($_POST['d'] ?? 0);
            $desc = $p * ($d / 100);
            $r = "Preço: R$ " . number_format($p,2,',','.') . "<br>Desconto: R$ " . number_format($desc,2,',','.') . "<br><strong>Final: R$ " . number_format($p - $desc,2,',','.') . "</strong>";
            break;

        case '3':
            $n = array_map('floatval', [$_POST['n1']??0, $_POST['n2']??0, $_POST['n3']??0, $_POST['n4']??0]);
            $ok = true;
            foreach ($n as $v) { if ($v < 1 || $v > 10) $ok = false; }
            if (!$ok) { $r = "<span class='erro'>Notas de 1 a 10!</span>"; break; }
            $m = array_sum($n) / 4;
            $r = "Média: $m<br><strong>" . ($m >= 5 ? "Aprovado" : "Reprovado") . "</strong>";
            break;

        case '5':
            $n = [intval($_POST['a']??0), intval($_POST['b']??0), intval($_POST['c']??0)];
            $r = "{$n[0]}² + {$n[1]}² + {$n[2]}² = <strong>" . ($n[0]**2 + $n[1]**2 + $n[2]**2) . "</strong>";
            break;

        case '6':
            $b = floatval($_POST['sal'] ?? 0);
            $l = ($b * 1.10) * 0.80;
            $r = "Bruto: R$ " . number_format($b,2,',','.') . "<br><strong>Líquido: R$ " . number_format($l,2,',','.') . "</strong>";
            break;

        case '7':
            $n = array_map('floatval', [$_POST['m1']??0, $_POST['m2']??0, $_POST['m3']??0, $_POST['m4']??0]);
            $m = array_sum($n) / 4;
            $s = $m >= 6 ? "Aprovado" : ($m < 3 ? "Retido" : "Exame");
            $r = "Média: <strong>$m</strong><br>Situação: <strong>$s</strong>";
            break;

        case '8':
            $n = [intval($_POST['x']??0), intval($_POST['y']??0), intval($_POST['z']??0)];
            $r = "Maior: <strong>" . max($n) . "</strong><br>Menor: <strong>" . min($n) . "</strong>";
            break;

        case '9':
            $ini = intval($_POST['ini'] ?? 0);
            $fim = intval($_POST['fim'] ?? 0);
            $s = 0;
            for ($i = $ini; $i <= $fim; $i++) if ($i % 2 !== 0) $s += $i;
            $r = "Soma dos ímpares: <strong>$s</strong>";
            break;

        case '10':
            $n = intval($_POST['n'] ?? 0);
            $r = "<strong>$n</strong> é <strong>" . ($n % 2 === 0 ? "PAR" : "ÍMPAR") . "</strong>";
            break;

        case '11':
            $v1 = floatval($_POST['v1'] ?? 0);
            $v2 = floatval($_POST['v2'] ?? 0);
            $op = $_POST['op'] ?? '+';
            switch ($op) {
                case '+': $res = $v1 + $v2; break;
                case '-': $res = $v1 - $v2; break;
                case '*': $res = $v1 * $v2; break;
                case '/':
                    if ($v2 == 0) { $r = "<span class='erro'>Divisão por zero!</span>"; break 2; }
                    $res = $v1 / $v2; break;
            }
            $r = "<strong>$v1 $op $v2 = $res</strong>";
            break;
    }

    echo json_encode(['html' => $r]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Exercícios PHP</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h1>Exercícios em PHP</h1>
    <div class="menu" id="menu"></div>
    <div class="card" id="card">
        <div class="topo" id="topo">Clique em um exercício</div>
        <div class="corpo" id="corpo"></div>
        <div class="result" id="result"></div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>