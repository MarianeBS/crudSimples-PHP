// FORM
async function createClient(event) {
    event.preventDefault();

    const alert    = document.querySelector('[data-js="create-client-alert"');
    const url      = "http://localhost/App/index.php";
    const formData = new FormData(document.getElementById("formCreate"));

    alert.classList.add('d-none');

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (!response.ok) throw new Error('Erro na requisição');

        setTimeout(() => {
            getAllClients();
            alert.classList.remove('d-none');
        }, 500);
    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }
}

async function updateClient(event) {
    event.preventDefault();

    const alert    = document.querySelector('[data-js="update-client-alert"');
    const url      = "http://localhost/App/index.php";
    const formData = new FormData(document.getElementById("formUpdate"));

    alert.classList.add('d-none');

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (!response.ok) throw new Error('Erro na requisição');

        setTimeout(() => {
            getAllClients();
            alert.classList.remove('d-none');
        }, 500);
    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }
}

async function getAllClients() {
    const url = "http://localhost/App/index.php?action=listClients";

    try {
        const response = await fetch(url, {
            method: 'GET'
        });

        if (!response.ok) {
            throw new Error('Erro na requisição');
        }

        const data = await response.json();
        const table = document.querySelector('[data-js="table-client"]');
        const tr    = document.querySelector('[data-model="tr"]');
        const tbody = table.querySelector('tbody');

        tbody.innerHTML = '';

        data.forEach(client => {
            const newTr = tr.cloneNode(true);
            newTr.querySelector('[data-field="id"]').innerText    = client.cliente_id;
            newTr.querySelector('[data-field="name"]').innerText  = client.nome;
            newTr.querySelector('[data-field="email"]').innerText = client.email;
            newTr.querySelector('[data-field="city"]').innerText  = client.cidade;
            newTr.querySelector('[data-field="state"]').innerText = client.estado;

            tbody.appendChild(newTr);
        });

    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }
}

async function getClientById(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById("formFindById"));
    const url = `http://localhost/App/index.php?action=findClientById&id=${formData.get('id')}`;

    try {
        const response = await fetch(url, {
            method: 'GET',
        });

        console.log(response)

        if (!response.ok) throw new Error('Erro na requisição');
        const data = await response.json();

        document.querySelector('[data-js="id-by-id"]').innerText    = data.cliente_id;
        document.querySelector('[data-js="name-by-id"]').innerText  = data.nome;
        document.querySelector('[data-js="email-by-id"]').innerText = data.email;
        document.querySelector('[data-js="city-by-id"]').innerText  = data.cidade;
        document.querySelector('[data-js="state-by-id"]').innerText = data.estado;
    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }

}

async function deleteClient(event) {
    event.preventDefault();

    const alert    = document.querySelector('[data-js="delete-client-alert"');
    const url      = "http://localhost/App/index.php";
    const formData = new FormData(document.getElementById("formDelete"));

    alert.classList.add('d-none');

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (!response.ok) throw new Error('Erro na requisição');

        setTimeout(() => {
            getAllClients();
            alert.classList.remove('d-none');
        }, 500);
    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }

}

// TESTE DE CARGA
function gerarNumeroAleatorio() {
    return Math.floor(Math.random() * 60) + 1;
}

async function enviarRequisicao(contador) {
    const url = "http://localhost/App/index.php";
    const data = {
        num1: gerarNumeroAleatorio(),
        num2: gerarNumeroAleatorio(),
        num3: gerarNumeroAleatorio(),
        num4: gerarNumeroAleatorio(),
        num5: gerarNumeroAleatorio(),
        num6: gerarNumeroAleatorio()
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        if (!response.ok) throw new Error('Erro na requisição');
        document.getElementById("count").innerText = "Requisições enviadas: " + contador;
    } catch (error) {
        console.error('Falha ao enviar requisição:', error);
    }
}

function iniciarTesteDeCarga() {
    for (let i = 1; i <= 10; i++) {
        enviarRequisicao(i);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    getAllClients();
});