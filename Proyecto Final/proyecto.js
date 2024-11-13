const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart');
});

/*   ------  */

const rowProduct = document.querySelector('.row-product');

// Lista de todos los productos
const productsList = document.querySelector('table');

// Variables de arreglos de productos 
let allProducts = [];

const valorTotal = document.querySelector('.total-pagar');

const countProducts = document.querySelector('#contador-productos')



productsList.addEventListener('click', e => {
    if (e.target.classList.contains('btn-add-cart')) {
        const productCard = e.target.closest('.card');
        const title = productCard.querySelector('.card-title').textContent;
        const size = e.target.textContent.split(' ')[0]; // Extraemos solo la parte del tamaño (ch, M, G)
        const price = e.target.textContent;

        const infoProduct = {
            quantity: 1,
            title: title,
            size: size,
            price: price,
        };

        const exists = allProducts.some(product => product.title === infoProduct.title && product.size === infoProduct.size);

        if (exists) {
            const products = allProducts.map(product => {
                if (product.title === infoProduct.title && product.size === infoProduct.size) {
                    product.quantity++;
                }
                return product;
            });
            allProducts = [...products];
        } else {
            allProducts = [...allProducts, infoProduct];
        }

        showHTML();
    }
});

// Agrega un evento de escucha para el botón de eliminación en cada producto del carrito
rowProduct.addEventListener('click', e => {
    if (e.target.classList.contains('icon-close')) {
        // Obtiene el índice del producto que se eliminará
        const index = Array.from(e.target.closest('.cart-product').parentNode.children).indexOf(e.target.closest('.cart-product'));

        // Elimina el producto del arreglo
        allProducts.splice(index, 1);

        // Actualiza la visualización del carrito
        showHTML();
    }
});





// Función para mostrar HTML
const showHTML = () => {



    /* if (!allProducts.length){
         containerCartProducts.innerHTML = `
         <p class="cart-empty">El carrito esta vacion </p>     `
 
     }*/




    // Limpiar HTML
    rowProduct.innerHTML = '';

    let total = 0;
    let totalOfProducts = 0;

    allProducts.forEach((product, index) => {
        const containerProduct = document.createElement('div');
        containerProduct.classList.add('cart-product');

        containerProduct.innerHTML = `
        <div class="info-cart-product">
            <span class="cantidad-producto-carrito">${product.quantity}</span>
            <p class="titulo-producto-carrito">&emsp;${product.title} (${product.size})</p>
            <span class="precio-producto-carrito">${product.price}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-close">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        `;

        rowProduct.append(containerProduct);

        total = total + parseInt(product.quantity * product.price.slice(4));
        totalOfProducts = totalOfProducts + product.quantity;
    });

    valorTotal.innerText = `$${total}`;
    countProducts.innerText = totalOfProducts;

    // Muestra el carrito de compras
    containerCartProducts.classList.remove('hidden-cart');
};


const articulos = [

    {id: 'niños.php', nombre: 'Vestido navideño dulcesitos' },
    {id: 'niños.php', nombre: 'Vestido navideño pinguinos' },
    {id: 'niños.php', nombre: 'Vestido navideño reno torera' },
    {id: 'niños.php', nombre: 'Vestido navideño reno' },
    {id: 'niños.php', nombre: 'Vestido navideño reno bebe' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous azu' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous bebe' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous con tu' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous bebe (Verde)' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous (Verde)' },
    {id: 'niños.php', nombre: 'Vestido navideño santa clous con tul' },
    {id: 'bebes.php', nombre: 'Vestido ariel bebe' },
    {id: 'bebes.php', nombre: 'Vestido blancanieves bebe' },
    {id: 'bebes.php', nombre: 'Vestido Elsa bebe' },
    {id: 'bebes.php', nombre: 'Vestido Masha bebe' },
    {id: 'bebes.php', nombre: 'Vestido mimin rojo bebe' },
    {id: 'bebes.php', nombre: 'Vestido mimin rosa bebe' },
    {id: 'bebes.php', nombre: 'Vestido unicornio bebe' },
    {id: 'bebes.php', nombre: 'Vestido unicornio bebe' },
    {id: 'bebes.php', nombre: 'Vestido Anna bebe' },
    {id: 'bebes.php', nombre: 'Vestido Aurora bebe' },
    {id: 'bebes.php', nombre: 'Vestido Moana bebe' },
    {id: 'bebes.php', nombre: 'Vestido Moana bebe' },
    {id: 'mujer.php', nombre: 'Camisa barbie' },
    {id: 'mujer.php', nombre: 'Camisa barbie' },
    {id: 'mujer.php', nombre: 'Camisa barbie' },
    {id: 'mujer.php', nombre: 'Cojunto de blusa y pantalon' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Camisa Nezuko' },
    {id: 'mujer.php', nombre: 'Vestido azul' },
    {id: 'mujer.php', nombre: 'Vestido negro lentejuelas' },
    {id: 'hombre.php', nombre: 'Camisa Anya hombre' },
    {id: 'hombre.php', nombre: 'Camisa de caballeros' },
    {id: 'hombre.php', nombre: 'Camisa esqueleto hombre' },
    {id: 'hombre.php', nombre: 'Sudadera de chuky Hombre' },
    {id: 'hombre.php', nombre: 'Camiseta de goku hombre' },
    {id: 'hombre.php', nombre: 'Camisa de goku hombre' },
    {id: 'hombre.php', nombre: 'Camisa homero hombre' },
    {id: 'hombre.php', nombre: 'Camisa de jack hombre' },
    {id: 'hombre.php', nombre: 'Sudadera jack hombre' },
    {id: 'hombre.php', nombre: 'Camiseta onepiece Hombre' },
    {id: 'hombre.php', nombre: 'Camiseta totujas hombre' },
    {id: 'hombre.php', nombre: 'Camisa totujas hombre' },
    



]


const formulario = document.querySelector('#formulario');
const boton = document.querySelector('#boton');
const resultado = document.querySelector('#resultado');

const coverCtnSearch = document.querySelector('#cover-ctn-search');

// Creamos el botón de X
const closeButton = document.createElement('button');
closeButton.innerHTML = `
    
  <svg xmlns="http://www.w3.org/2000/svg" fill="rgb(255, 165, 0)" style="background-color: rgb(248, 210, 206);" viewBox="0 0 24 24" stroke-width="1.5"
    stroke="currentColor" class="icon-close">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>

`;

// Agregamos el botón al elemento `coverCtnSearch`
coverCtnSearch.appendChild(closeButton);

// Escuchamos los clics en el botón
closeButton.addEventListener('click', () => {
  // Ocultamos el elemento `resultado`
  resultado.style.display = 'none';
});


//logica de buscar 
const filtrar = () => {
    resultado.innerHTML = '';

    const texto = formulario.value.toLowerCase();
   

    

    for (let articulo of articulos) {
        let nombre = articulo.nombre.toLowerCase();
        if (nombre.indexOf(texto) !== -1) {
            resultado.innerHTML += `
            
                <li><a href="${articulo.id}">${articulo.nombre}</a></li>
            `;
        }
    }

    if (resultado.innerHTML === '') {
        resultado.innerHTML += `
            <li>Producto no encontrado...</li>
        `;
    }
    coverCtnSearch.addEventListener('click', () => {
        resultado.style.display = 'none';
      });
};

boton.addEventListener('click', filtrar);


//diseño del buscador
boton.addEventListener('click', () => {
    coverCtnSearch.classList.toggle('hidden');
    resultado.style.position = 'fixed';
    resultado.style.top = coverCtnSearch.offsetHeight - resultado.offsetHeight;
    resultado.style.backgroundColor = 'white';
    resultado.style.width = '500px';

    resultado.style.left = '220px';
    resultado.style.display = 'block';
    resultado.style.color = 'black';
    resultado.style.padding = '12px 20px';
    

});

const totalPagar = encodeURIComponent(total); // Para asegurarse de que el total esté correctamente codificado
window.location.href = "./pago.php?total=" + totalPagar;
