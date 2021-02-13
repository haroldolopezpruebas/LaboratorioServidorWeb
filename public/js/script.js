// Variable de almacenamiento local
const LocalStorage = window.localStorage;

// Listado de productos existentes en la tienda
let productos = [];

// Variable temporal donde se almacenan los productos del carrito de compras
let productosCart = [];

// Función para obtener todos los elementos guardados en el almacenamiento local
const getAllProductosCart = () => LocalStorage.getItem("miTiendaProductos")


// Función para agregar productos al carrito de compras
const addProductoCart = (producto) => {
    
    const cantidad = productosCart.filter(p => p.id == producto.id).length;

    if(cantidad != 0){
        productosCart.forEach(p => {if(p.id == producto.id) p.cantidad++})
    }else{
        producto.cantidad = 1
        productosCart = [...productosCart,producto];
    }

    LocalStorage.setItem("miTiendaProductos",JSON.stringify(productosCart))

}

// Función para mostrar los productos al carrito de compras
function renderProductosCart() {
    
    let productosTmp = [];

    productosCart.forEach((p)=>{

        productosTmp += `
            <tr>
                <td>${p.id}</td>
                <td>${p.nombre}</td>
                <td><img class="card-cell-img" src="images/productos/producto${p.id}.jpg" alt=""/></td>
                <td>${p.cantidad}</td>
                <td>Q${p.precio}</td>
                <td><button class="btn-delete"><i class="fas fa-trash-alt"></i></button></td>
            </tr>
        `; 
    })

    $("#tabla-productos tbody").html(productosTmp);

    $(".btn-delete").click(function(){
        const id = $($($($(this).parent()).parent()).find("td")[0]).html();
        console.log(id);
        productosCart = productosCart.filter(p => p.id != id)
        renderProductosCart()
        LocalStorage.setItem("miTiendaProductos",JSON.stringify(productosCart))
    })

}

// Función para mostrar alertas
function showAlert(txt) {
    $(".alert-success").html(txt)
    $(".alert-success").css("display","flex");
    $(".alert-success").fadeIn(2000).delay(2000).fadeOut(1000)
}

// Variable temporar para obtener los productos
const allProducts = getAllProductosCart();
// Se obtienen todos los productos almacenados para ser convertidos en JSON
productosCart = allProducts != "null" && allProducts != null ? JSON.parse(getAllProductosCart()) : [];


// Functión de JQuery para esperar hasta que el documento esté listo
$(document).ready(function(){

    let productosTmp = "";

    // Función para abrir el modal donde se muestra el carrito de compras
    function openModal(opc) {
        if(opc){
            $("#modal").show();
            $("body").css("overflow-y","hidden");

            if(productosCart != null){
                renderProductosCart()
                if(productosCart.length == 0)
                    $("#tabla-productos tbody").html("");

            }else{
                $("#tabla-productos tbody").html("");
            }
        }else{
            $("#modal").hide()
            $("body").css("overflow-y","auto")
        }
    }

    // Función para eliminar todos los productos del carrito de compras
    const deleteProducts = () => {
        LocalStorage.clear()
        productosCart = [];
        openModal(false)
    }


    //Cargar productos desde Backend
    $.post("http://localhost/servidorWebLab/TiendaLinea/public/getAllProducts",(data) => {
        productos = JSON.parse(data);

        // Se recorre la variable productos para mostrar los productos disponibles
        productos.forEach((p,index)=>{
            productosTmp += `
                <div class="productos-cell">
                    <div class="nav-link-producto">
                        <div class="productos-cell-div-img">
                            <img class="productos-cell-img" src="images/productos/producto${index+1}.jpg" alt=""/>
                        </div>
                        <div class="productos-cell-desc">
                            <span class="id-producto">${p.id}</span>
                            <b>${p.nombre}</b>
                            <div>Q${p.precio}</div>
                            <button class="btn-add-carrito">
                                <i class="fas fa-cart-plus"></i>&nbsp;
                                Agregar carrito
                            </button>
                        </div>
                    </div>
                </div>
            `;
        })


        // Se muestra en la división todos los productos disponibles
        $("#mostrar-productos").html(productosTmp)

        // Efecto que se muestra al momento que el mouse entra en el producto
        $(".nav-link-producto").mouseenter(function(){
            $($(this).find("div")[0]).addClass("img-effect");
            $($(this).find("div")[1]).addClass("txt-effect");
            $($(this).find("div")[1]).find("button").css("display","block")
        }).mouseleave(function() {
            $($(this).find("div")[0]).removeClass("img-effect")
            $($(this).find("div")[1]).removeClass("txt-effect")
            $($(this).find("div")[1]).find("button").css("display","none")
        })

        // Evento para agregar producto al carrito de compras
        $(".btn-add-carrito").click(function(){
            const productoSelect = productos.find((p) => p.id == $($($(this).parent()).find(".id-producto")).html());
            addProductoCart(productoSelect)
            showAlert("Se agregado con éxito")
        })

        // Evento para abrir el modal para poder visualizar el carrito de compras
        $("#openModal").click(function(){
            openModal(true)
        })

        // Evento para cerrar el modal donde se visualiza el carrito de compras
        $("#modal-close").click(function(){
            openModal(false)
        })

        // Evento para cerrar el modal donde se visualiza el carrito de compras
        $(".modal-wrapper").click(function(){
            openModal(false)
        })

        // Evento para borrar todos los productos agregados al carrito de compras
        $(".btn-erase").click(function(){
            deleteProducts()
        })

        // Evento para mostrar la división donde se encuentra el formulario de pago
        $(".btn-check").click(function(){
            if(productosCart.length != 0)
                $(".pago").show("slow");
            else{
                showAlert("Seleccione productos!")
            }
        })

        // Evento para poder pagar los productos, se borran los productos del
        // carrito de compras
        $(".btn-pagar").click(function(){
            $(".pago").hide("slow");
            deleteProducts()
            showAlert("Ha comprado sus productos!")
        })


        // Evento asignado al documento para que al momento que se presione la 
        // tecla esc se cierre el modal donde se muestra el carrito de compras
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                openModal(false)
            }
        });
    });

});