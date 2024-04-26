// Création d'un objet XMLHttpRequest
let xhr = new XMLHttpRequest();

let table = document.getElementById('defaulTable');

if (document.getElementById("searchBtn")) {
    document.getElementById("searchBtn").addEventListener('click', () => {
        let searchText = document.getElementById('searchText');
        search(searchText.value);
    });
}

let tbody = table.querySelector('tbody');
let allEnc = []

// Définition de la méthode et de l'URL de la requête
xhr.open("GET", "./enginePhp/encadreur_crud.php?op=lecture", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

// Ajout d'un événement de rappel à l'événement `load`
xhr.onload = function () {
    try {
        // Récupération des données JSON
        let data = xhr.responseText;
        //console.log(data);
        let d = JSON.parse(data);
        if (d.status == 'success') {
            const jsonObj = JSON.parse(data);
            allEnc = jsonObj.allEnc;

            tbody.innerHTML = "";
            //console.log(allEnc);
            let classi = "";
            for (let i = 0; i < allEnc.length; i++) {

                tbody.innerHTML += `
                <tr>
                    <td>${allEnc[i].nom_complet}</td>
                    <td>${allEnc[i].matricule}</td>
                    <td>${allEnc[i].departement}</td>
                    <td>${allEnc[i].fonction}</td>
                    <td>
                        <ul>
                            <li onclick="editEncadreur(${allEnc[i].idencadreur})">
                                <a class="small-btn bg-yellow" href="#">
                                    <i class="ti-pencil"></i>
                                </a>
                            </li>
                            <li onclick="deleteEncadreur(${allEnc[i].idencadreur})" >
                                <a class="small-btn" href="#">
                                    <i class="ti-trash"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
                `;
            }

            //Ajout des markers des accords
        }
        else {
            alert("Erreur de lecture dans la base des données :" + data.msg)
        }
    }
    catch (e) {
        console.log(e);
        alert("Erreur de lecture dans la base des données, Veuillez Actualiser la page");
    }

};

function showForm(state) {
    if (state === 0) {
        //document.getElementById("id").value = ""
        document.getElementById("matricule").value = ""
        document.getElementById("nom").value = ""
        document.getElementById("fonction").value = ""
        document.getElementById("dept").value = ""

        showIsjForm2(0);
    }
    else {
        showIsjForm2(0);
    }
}

function reloadTable() {
    xhr.open("POST", "./enginePhp/encadreur_crud.php?op=lecture", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    search("");
}

function search(mot) {
    const rows = tbody.querySelectorAll('tr');
    //console.log("Searching", mot)
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let found = false;

        if (mot == "") {
            //console.log("no Term");
            row.style.display = 'table-row';
        }
        else {
            cells.forEach(cell => {
                const cellText = cell.textContent.toLocaleLowerCase();
                if (cellText.includes(mot)) {
                    found = true;
                    //console.log("Found", row);
                    //row.style.display = found ? 'table-row' : 'noe';
                    //return;
                }
                row.style.display = found ? 'table-row' : 'none';
            });
        }

    });
}

function deleteEncadreur(id) {
    if (confirm("Voulez-vous supprimer cet encadreur?") && id > 0)
        window.location.href = `./enginePhp/encadreur_crud.php?id=${id}&op=delete`;
}

function editEncadreur(id) {
    console.log("edit", id)
    if (id > 0) {
        console.log("edit", id)
        let xhr = new XMLHttpRequest();
        // Définition de la méthode et de l'URL de la requête
        xhr.open("GET", "./enginePhp/getEncadreur.php?id=" + id, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();
        xhr.onload = (e) => {
            let data = xhr.responseText;
            //console.log(data);
            let d = JSON.parse(data);
            if (d.status == 'success') {
                let encadreur =  d.enc;
                console.log(encadreur)
                
                document.getElementById("id").value = encadreur[0].idencadreur;
                document.getElementById("idLbl").innerHTML = encadreur[0].idencadreur;
                document.getElementById("matricule").value = encadreur[0].matricule;
                document.getElementById("nom").value = encadreur[0].nom_complet;
                document.getElementById("fonction").value = encadreur[0].fonction;
                document.getElementById("dept").value = encadreur[0].departement;
                document.getElementById("op").value = "edit";
                document.getElementById('btn-add-enc').innerHTML = "Modifier";
                showIsjForm2(0);
            }
            else{
                alert("Erreur de récuperation de l'index");
            }
        }
    }
}

// Envoi de la requête
xhr.send();