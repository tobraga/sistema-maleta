var camposDatas = document.getElementsByClassName('data');

for(campo of camposDatas){

    var data = campo.innerText;
    data = data.split('-');
    data = data[2] + '/' + data[1] + '/' + data[0];
    campo.innerText = data;

}
