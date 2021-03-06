carritoDeCompras = 'carrito';
cargarCarrito();
function cargarCarrito()
{
    var finalizar = [],
        descuento = [],
        nombres = [],
        datoStorage = localStorage.getItem(carritoDeCompras),
        finalizarInter = document.querySelector("#tabla ");
        articulos = document.querySelector("#Articulos");
    if (datoStorage !== null)
    {
        finalizar = JSON.parse(datoStorage);
    }
    finalizarInter.innerHTML = '';
    var total =0;
    var descuentos =0;
    var descuento =0;
    var cantidad =0;
    finalizar.forEach(function(x,i){
      cantidad++
    });
    finalizar.forEach(function (x, i)
    {
      var contador = i+1;

        var div = document.createElement("input"),
        articulo = document.createElement('tr'),
        tdArticulo = document.createElement('td'),
        tdPrecio = document.createElement('td');
        tdDescuento = document.createElement('td');
        div.id = "codigo"+contador;
        div.name = "codigo"+contador;
        div.value = x.codigo;
        div.hidden = true;
        total = total + Number(x.costo);
        if (x.descuento=='no-aplica') {
          x.descuento=0;
        }
        descuento = Number(x.descuento)*(cantidad-1)
        if (cantidad>1 && cantidad<=15) {
          descuentos = descuentos + Number(x.descuento)*(cantidad-1)
        }
        if (contador<16) {
          if (cantidad>15) {
            descuentos = descuentos + Number(x.descuento)*(14)
          }
        }
        tdArticulo.innerHTML = "◙ "+ x.nombre;
        tdPrecio.innerHTML = '¢'+Number(x.costo);
        tdDescuento.innerHTML = '¢'+descuento
        tdArticulo.id = 'tdProcesar';
        tdPrecio.id = 'tdProcesar';
        tdDescuento.id = 'tdProcesar'
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
    var lblDescuento = document.createElement('label');
    var txtTotal = document.createElement('label');
    var txtDescuento = document.createElement('label');
    var nombreDelCiente = document.createElement('label');
    var txtnombreDelCliente = document.createElement('input');
    nombreDelCiente.textContent ='Nombre';
    txtnombreDelCliente.name = 'nombreDelCiente';
    txtnombreDelCliente.required = true;
    txtnombreDelCliente.className = 'form form-control';
    var domicilioDelCliente = document.createElement('label');
    var txtdomicilioDelCliente = document.createElement('textarea');
    domicilioDelCliente.textContent ='Dirección exacta';
    txtdomicilioDelCliente.name = 'domicilioDelCiente';
    txtdomicilioDelCliente.required = true;
    txtdomicilioDelCliente.className = 'form form-control';
    var telefonoDelCliente = document.createElement('label');
    var txttelefonoDelCliente = document.createElement('input');
    telefonoDelCliente.textContent ='Teléfono';
    txttelefonoDelCliente.name = 'telefonoDelCliente';
    txttelefonoDelCliente.required = true;
    txttelefonoDelCliente.type = 'number';
    txttelefonoDelCliente.className = 'form form-control';
    finalizarInter.appendChild(nombreDelCiente);
    finalizarInter.appendChild(txtnombreDelCliente);
    finalizarInter.appendChild(domicilioDelCliente);
    finalizarInter.appendChild(txtdomicilioDelCliente);
    finalizarInter.appendChild(telefonoDelCliente);
    finalizarInter.appendChild(txttelefonoDelCliente);
    var br = document.createElement('br');
    var br1 = document.createElement('br');
    var br2 = document.createElement('br');
    lbltotal.textContent = 'Total de la compra: ';
    lblDescuento.textContent = 'Descuento: ';
    txtTotal.textContent = "¢"+(total-descuentos);
    txtDescuento.textContent = "¢"+descuentos;
    txtTotal.id = 'txtTotal';
    txtDescuento.id = 'txtTotal';
    finalizarInter.appendChild(br1);
    finalizarInter.appendChild(lblDescuento);
    finalizarInter.appendChild(txtDescuento);
    finalizarInter.appendChild(br2);
    finalizarInter.appendChild(lbltotal);
    finalizarInter.appendChild(txtTotal);
    finalizarInter.appendChild(br);
    var  btnFinalizar = document.createElement('button');
    var btnSpan = document.createElement('span');
    btnSpan.innerHTML = 'una vez finalizada la compra, debe presentarse al laboratorio';
    btnSpan.className = 'tooltiptext';
    btnFinalizar.type = 'submit';
    btnFinalizar.name = 'FinalizarCompra';
    btnFinalizar.textContent = 'Finalizar Compra';
    btnFinalizar.id = 'borrarCarrito';
    btnFinalizar.className = 'btn btn-primary';
      finalizarInter.appendChild(btnFinalizar);
          btnFinalizar.appendChild(btnSpan);
}
document.querySelector("#borrarCarrito").addEventListener('click', function()
{
  localStorage.clear();
});
