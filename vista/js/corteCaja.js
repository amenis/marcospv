const generar = ()=>{
  /*   let fecha_in = document.getElementById('fecha_in').value;
    let fecha_end = document.getElementById('fecha_end').value;
    $.post('corteCaja/corte',{fecha_in: fecha_in, fecha_end: fecha_end},(req)=>{
        console.log(req);
    }); */
    print_corte();
    setTimeout(() => {
        window.location.reload();        
    }, 5000);
}

const print_corte = () => {
    let fecha_in = document.getElementById('fecha_in').value;
    let fecha_end = document.getElementById('fecha_end').value;
    $.post('corteCaja/corte',{fecha_in: fecha_in, fecha_end: fecha_end},(req)=>{
        console.log(req);
    });
   
    $('#corte').printPage({
        url: "corte.txt",
        attr: "href",
        message: "Generando vista previa del ticket.."
    });
    $('#corte').click();

}