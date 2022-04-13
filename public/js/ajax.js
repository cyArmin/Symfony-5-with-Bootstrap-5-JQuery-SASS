const formElement = document.getElementById('abfrage');
formElement.addEventListener('submit', loadDoc);

function loadDoc(e) {
    e.preventDefault(); // form 'event' is blocked
    let url = this.dataset.ajaxUrl;

    if ( document.getElementById("antwort").value != "") {

        const xhttp = new XMLHttpRequest();
        //callback function

        const formData = new FormData(formElement);

        xhttp.onreadystatechange = function () {
            if (this.readyState !== XMLHttpRequest.DONE || this.status !== 200) return;
            //here you can use the data
            const output = JSON.parse(this.responseText);
            document.getElementById("answer").innerHTML = output.compareResult;
            document.getElementById("askedVocab").innerHTML = output.newVocab;
            document.getElementById("antwort").value = "";
            document.getElementById("vergleich").value = output.compare_id;
        }
        //sends a request
        xhttp.open("POST", url, true);
        xhttp.send(formData);
    }

    return false;
}