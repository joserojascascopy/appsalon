<?php 

foreach($alertas as $key => $mensajes) :
    foreach($mensajes as $mensaje) : ?>
        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endforeach;
endforeach;


// Manera incorrecta de hacer jeje no copiar, o sea funciona, pero seguiremos el ejemplo (codigo que esta arriba)

//foreach($alertas as $key => $mensajes) :
    //<div class="alerta echo $key;">
        //foreach($mensajes as $mensaje) :
            //<p>echo $mensaje;</p>
        //endforeach;
    //</div>
//endforeach;

// $alertas es un array de array
// $mensajes es un array, entonces para recorrer los "valores" o cada "alerta y/o mensaje" debemos hacer un doble foreach