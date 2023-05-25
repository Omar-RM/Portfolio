const pos = document.querySelector('#POS');
const cartList = document.querySelector('#sumary');
const subtotal = document.querySelector('#subtotal');
const cartCountInfo = document.querySelector('#cantidad-sumary');
const sumaryTotal = document.querySelector('#total-sumary');
const borrarTodo = document.querySelector("#venta-clear");
const ventaBtn = document.querySelector("#venta-btn");
const countInput = document.querySelector("#cantidad-input");
const orderInput = document.querySelector('#order-input');
var sumaryTotalInput = document.querySelector("#total-sumary-input");
const inputJSON = document.querySelector('#sumary-inputJSON');

eventListeners();
function eventListeners() {
    window.addEventListener("load",
        pos.addEventListener('click', comprarProducto)
    );
    cartList.addEventListener('click', deleteProduct);
    borrarTodo.addEventListener('click', clearAll);
    ventaBtn.addEventListener('click', sendOrder);
}
updateCartInfo();
function updateCartInfo() {
    let cartInfo = findTotal();
    cartCountInfo.textContent = cartInfo.productCount;
    countInput.value=cartInfo.productCount;
    sumaryTotal.textContent = cartInfo.total;
    subtotal.textContent = cartInfo.total;
    sumaryTotalInput.value=cartInfo.total;
   
}

 function sendOrder(){
    displayJSON();
    clearAll();
 }
function displayJSON(){
    inputJSON.value=localStorage.getItem('productos');
}

function comprarProducto(e) {
    let producto ;
    if (e.target.tagName === "BUTTON") {
       producto = e.target.parentElement;
    }
    getProductInfo(producto);
}
function getProductInfo(producto) {
    let productInfo = {
        name: producto.querySelector('.box-item-name').textContent,
        price: producto.querySelector('.box-item-price').textContent
    }
    addSumary(productInfo);
    guardarProducto(productInfo);
}
function addSumary(producto) {
    const cartItem = document.createElement('div');
    cartItem.classList.add('fila-sumary');
    cartItem.innerHTML = `<div class="sumary-qty">1</div>
    <div class="sumary-producto">${producto.name}</div>
    <div class="sumary-precio">${producto.price}</div>
    <button class="sumary-borrar">X</button>
    `;
    cartList.appendChild(cartItem);
}
function guardarProducto(producto) {
    let productos = getProductFromStorage();
    productos.push(producto);
    localStorage.setItem('productos', JSON.stringify(productos));
    updateCartInfo();
}
function getProductFromStorage() {
    return localStorage.getItem('productos') ? JSON.parse(localStorage.getItem('productos')) : [];
}
function findTotal(){
    let productos= getProductFromStorage();
    let total = productos.reduce((acc,producto)=>{
        let price = parseFloat(producto.price.substr(1));
        return acc+=price;
    },0);
    return {
        total: total.toFixed(2),
        productCount: productos.length
    }
}

//Delete product from cart list and localStorage
function deleteProduct(e) {
    let cartItem;
    if (e.target.tagName === "BUTTON") {
        cartItem = e.target.parentElement;
    } else if (e.target.tagName === "I") {
        cartItem = e.target.parentElement.parentElement;
    }
    cartItem.remove();
}

function clearAll(){
    window.localStorage.clear();
   location.reload();

}

//JQuery 
// var sum = 0;
// $('.sumary-precio').each(function()
// {
//     sum += parseFloat($(this).text());
// });
// var cName=document.getElementsByClassName('total-sumary');
// cName[0].innerHTML=sum;
