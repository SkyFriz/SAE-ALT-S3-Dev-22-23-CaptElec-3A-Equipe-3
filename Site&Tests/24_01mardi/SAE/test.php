<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styleTEST.css" />
    </head>
    <body>
        <ul>
            <li><a><i class="fa fa-home"></i></a></li>
            <li><a><i class="fa fa-user-circle-o"></i></a></li>
            <li class="activo"><a><i class="fa fa-plus-square-o"></i></a></li>
            <li><a><i class="fa fa-send-o"></i></a></li>
            <li><a><i class="fa fa-gear"></i></a></li>
            <div class="marcador"></div>
        </ul>
        <script>
            let marcador = document.querySelector('#marcador');
            let list = document.querySelectorAll('ul li');

            function moveIndicator(e){
                marcador.style.left = e.offsetLeft+'px';
                marcador.style.width = e.offsetWidth+'px';
            }
            list.forEach(linl =>{
                link.addEvenListener('mousemove', (e) =>{
                    moverIndicator(e.target);
                })
            })
            function activo(){
                list.forEach((item) =>
                item.classList.remove('activo'));
                this.classList.add('activo');
            }
            list.forEach((item) =>
            item.addEvenListener('mousemove', activo));
        </script>
    </body>
</html>