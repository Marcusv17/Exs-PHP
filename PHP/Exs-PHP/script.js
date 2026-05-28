const exs = {
  1: { tit: "1) Tabuada", desc: "Número:", inp: '<input type="number" name="n" required>' },
  2: { tit: "2) Desconto", desc: "Preço e %:", inp: '<input type="number" name="p" step="0.01" placeholder="Preço" required><input type="number" name="d" step="0.01" placeholder="%" required>' },
  3: { tit: "3) Aprovação", desc: "4 notas (1-10):", inp: '<div class="g2"><input type="number" name="n1" min="1" max="10" step="0.1" required><input type="number" name="n2" min="1" max="10" step="0.1" required><input type="number" name="n3" min="1" max="10" step="0.1" required><input type="number" name="n4" min="1" max="10" step="0.1" required></div>' },
  5: { tit: "5) Soma dos Quadrados", desc: "3 números:", inp: '<div class="g3"><input type="number" name="a" required><input type="number" name="b" required><input type="number" name="c" required></div>' },
  6: { tit: "6) Salário Líquido", desc: "Salário bruto:", inp: '<input type="number" name="sal" step="0.01" required>' },
  7: { tit: "7) Média Aritmética", desc: "4 notas:", inp: '<div class="g2"><input type="number" name="m1" step="0.1" required><input type="number" name="m2" step="0.1" required><input type="number" name="m3" step="0.1" required><input type="number" name="m4" step="0.1" required></div>' },
  8: { tit: "8) Maior e Menor", desc: "3 números:", inp: '<div class="g3"><input type="number" name="x" required><input type="number" name="y" required><input type="number" name="z" required></div>' },
  9: { tit: "9) Soma dos Ímpares", desc: "Início e fim:", inp: '<input type="number" name="ini" placeholder="Início" required><input type="number" name="fim" placeholder="Fim" required>' },
  10: { tit: "10) Par ou Ímpar", desc: "Número:", inp: '<input type="number" name="n" required>' },
  11: { tit: "11) Calculadora", desc: "Valores e operador:", inp: '<input type="number" name="v1" step="any" placeholder="Valor 1" required><select name="op"><option value="+">+</option><option value="-">-</option><option value="*">*</option><option value="/">/</option></select><input type="number" name="v2" step="any" placeholder="Valor 2" required>' }
};

const menu = document.getElementById('menu');
const topo = document.getElementById('topo');
const corpo = document.getElementById('corpo');
const result = document.getElementById('result');

Object.keys(exs).forEach(e => {
  const b = document.createElement('button');
  b.textContent = e;
  b.className = 'btn';
  b.onclick = () => mostrar(e);
  menu.appendChild(b);
});

function mostrar(e) {
  document.querySelectorAll('.btn').forEach(b => b.classList.remove('on'));
  document.querySelector(`.btn:nth-child(${Object.keys(exs).indexOf(e)+1})`).classList.add('on');
  const d = exs[e];
  topo.textContent = d.tit;
  corpo.innerHTML = `<p>${d.desc}</p><form id="f" onsubmit="return calc(event,'${e}')">${d.inp}<button class="ok">Calcular</button></form>`;
  result.style.display = 'none';
}

async function calc(event, e) {
  event.preventDefault();
  const fd = new FormData(document.getElementById('f'));
  fd.append('ajax', '1');
  fd.append('ex', e);
  result.style.display = 'block';
  result.innerHTML = 'Calculando...';
  const res = await fetch('', { method: 'POST', body: fd });
  const data = await res.json();
  result.innerHTML = data.html || 'Erro';
}

mostrar(1);