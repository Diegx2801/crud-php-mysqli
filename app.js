const tbody = document.querySelector("#tbody");
const formCreate = document.querySelector("#formCreate");
const search = document.querySelector("#search");
const dlg = document.querySelector("#dlg");
const formEdit = document.querySelector("#formEdit");

async function load(q = "") {
  const res = await fetch(`api.php?action=read&q=${encodeURIComponent(q)}`);
  const json = await res.json();

  tbody.innerHTML = "";
  json.data.forEach(u => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${u.id}</td>
      <td>${u.nombre}</td>
      <td>${u.email}</td>
      <td>
        <button class="btn-edit" data-id="${u.id}" data-nombre="${u.nombre}" data-email="${u.email}">Editar</button>
        <button class="btn-del" data-id="${u.id}">Eliminar</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

formCreate.addEventListener("submit", async (e) => {
  e.preventDefault();
  const fd = new FormData(formCreate);

  await fetch("api.php?action=create", { method: "POST", body: fd });
  formCreate.reset();
  load(search.value.trim());
});

search.addEventListener("input", () => {
  load(search.value.trim());
});

tbody.addEventListener("click", async (e) => {
  const del = e.target.closest(".btn-del");
  const edit = e.target.closest(".btn-edit");

  if (del) {
    if (!confirm("¿Eliminar este usuario?")) return;
    const fd = new FormData();
    fd.append("id", del.dataset.id);
    await fetch("api.php?action=delete", { method: "POST", body: fd });
    load(search.value.trim());
  }

  if (edit) {
    formEdit.id.value = edit.dataset.id;
    formEdit.nombre.value = edit.dataset.nombre;
    formEdit.email.value = edit.dataset.email;
    dlg.showModal();
  }
});

formEdit.addEventListener("submit", async (e) => {
  e.preventDefault();
  const fd = new FormData(formEdit);
  await fetch("api.php?action=update", { method: "POST", body: fd });
  dlg.close();
  load(search.value.trim());
});

load();
