carritoDeCompras = 'carrito';
cargarCarrito();
function cargarCarrito()
{
    var finalizar = [],
        datoStorage = localStorage.getItem(carritoDeCompras),
        finalizarInter = document.querySelector("#tabla ");
        articulos = document.querySelector("#Articulos");
    if (datoStorage !== null)
    {
        finalizar = JSON.parse(datoStorage);
    }
    finalizarInter.innerHTML = '';
    var total =0;
    finalizar.forEach(function (x, i)
    {
      var contador = i+1;

        var div = document.createElement("input"),
        articulo = document.createElement('tr'),
        tdArticulo = document.createElement('td'),
        tdPrecio = document.createElement('td');

        div.id = "codigo"+contador;
        div.name = "codigo"+contador;
        div.value = x.codigo;
        div.hidden = true;
        total = total + Number(x.costo);
        tdArticulo.innerHTML = "◙ "+ x.nombre;
        tdPrecio.innerHTML = '¢'+x.costo;
        tdArticulo.id = 'tdProcesar';
        tdPrecio.id = 'tdProcesar';
        articulo.appendChild(tdArticulo);
        articulo.appendChild(tdPrecio);
        articulos.appendChild(articulo);
        finalizarInter.appendChild(div);

    });
    var date = new Date(),
    txtFecha = document.createElement("input");
    txtFecha.id = 'fecha';
    txtFecha.name = 'fecha';
    txtFecha.value = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+':'+date.getSeconds();
    txtFecha.hidden = true;
    finalizarInter.appendChild(txtFecha);
    var brArticulos = document.createElement('br');
    var lbltotal = document.createElement('label');
    var txtTotal = document.createElement('label');
    var br = document.createElement('br');
    var br1 = document.createElement('br');
    var br2 = document.createElement('br');
    lbltotal.textContent = 'Total de la compra: ';
    txtTotal.textContent = "¢"+total;
    txtTotal.id = 'txtTotal';
    finalizarInter.appendChild(br1);
    finalizarInter.appendChild(lbltotal);
    finalizarInter.appendChild(txtTotal);
    finalizarInter.appendChild(br);
    var  btnFinalizar = document.createElement('button');
    var btnSpan = document.createElement('span');
    var link = document.createElement('a');
    btnSpan.innerHTML = 'una vez finalizada la compra, no hay vuelta atrás';
    btnSpan.className = 'tooltiptext';
    btnFinalizar.type = 'submit';
    btnFinalizar.name = 'FinalizarCompra';
    btnFinalizar.textContent = 'Finalizar Compra';
    btnFinalizar.id = 'borrarCarrito';
    btnFinalizar.className = 'btn btn-primary';
    link.textContent = 'Solicitar a domicilio';
    link.href = '/compras/domicilio';
    link.className = 'btn btn-primary';
      finalizarInter.appendChild(btnFinalizar);
      finalizarInter.appendChild(br2);
      finalizarInter.appendChild(link);
          btnFinalizar.appendChild(btnSpan);
}
document.querySelector("#borrarCarrito").addEventListener('click', function()
{
  localStorage.clear();
});
